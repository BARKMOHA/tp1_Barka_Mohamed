<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipment;
use App\Models\Review;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\EquipmentResource;
use OpenApi\Attributes as OA;
class EquipmentController extends Controller
{
     /**
     * prompt: comment regler l'errer de generation de docmentation swagger et regler erreur de path OA
     */
    #[OA\Get(
        path: '/api/equipments',
        summary: 'Obtenir tous les équipements',
        tags: ['Equipment'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Liste des équipements avec pagination'
            )
        ]
    )]
    public function index()
    {
        return EquipmentResource::collection(
            Equipment::paginate(20)
        );
    }

    #[OA\Get(
        path: '/api/equipments/{equipment}/popularity',
        summary: 'Calculer popularite d un equipement ',
        tags: ['Equipment'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'afficher la popularite d equipement'
            )
        ]
    )]
    public function popularity(Equipment $equipment){
        $nbRentals = $equipment->rentals->count();
          /**
     * prompt: comment utiliser les requetes query dans laravel pour calculer la popularite d'un equipemnt parexemple en tenant compte des critiques sur celui ci
     */
        $averageRating = \App\Models\Review::whereHas('rental', function ($query) use($equipment) {
            $query->where('equipment_id', $equipment->id);
    
        })->avg('rating')??0;
        $popularity = ($nbRentals * 0.6)+($averageRating*0.4);

        return response()->json([
            'equipment_id'=>$equipment->id,
            'number_of_rentals'=> $nbRentals,
            'average_rating'=>round($averageRating,2),
            'popularity'=>round($popularity, 2),
        ], 200);

    }

         
    
    /**
     * prompt: comment utiliser les requetes query dans laravel pour calculer la moyenne des locations d'un equipemnt parexemple en permettant dajouter un filtre selon date min et max
     * 
     * 
    */
    #[OA\Get(
        path: '/api/equipments/{equipment}/average-price',
        summary: 'Calcule de la moyenne prix d equipement ',
        tags: ['Equipment'],
        responses: [
            new OA\Response(
                response: 200,
                description: 'afficher la moyenne'),
                new OA\Response(
                response: 422, 
                description: 'Erreur de validation')
 
                
        ]
    )]
    public function averagePrice(Request $request, Equipment $equipment){
        $validator = Validator::make($request->all(), [
            'minDate'=>'nullable|date_format:Y-m-d',
            'maxDate'=>'nullable|date_format:Y-m-d',

        ]);

        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],422);
        }
        if(
            $request->filled('minDate')&&
            $request->filled('maxDate')&&
            $request->minDate >= $request->maxDate){
            return response()->json([
                'message'=>'minDate doit etre inferieur a maxDate'
            ],422);
            }   
        $query = $equipment->rentals();
        if($request->filled('minDate')){
            $query->whereDate('startDate', '>=', $request->minDate);
        }
        if($request->filled('maxDate')){
            $query->whereDate('startDate', '<=', $request->maxDate);
        }

        $averagePrice= $query->avg('totalPrice')??0;
        
        return response()->json([
            'equipment_id'=>$equipment->id,
            'average_price'=>round($averagePrice,2),
        ],200);
    }
}
