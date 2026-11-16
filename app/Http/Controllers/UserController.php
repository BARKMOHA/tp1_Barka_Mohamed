<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Http\Resources\RentalResource;
use App\Http\Resources\UserResource;
class UserController extends Controller
{
    #[OA\Get(
        path: '/api/users/{user}/rentals',
        summary: 'Obtenir les locations d’un utilisateur',
        tags: ['User'],
        parameters: [
            new OA\Parameter(
                name: 'user',
                
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Liste des locations de l’utilisateur'
            ),
            new OA\Response(
                response: 404,
                description: 'Utilisateur introuvable'
            )
        ]
    )]
    public function rentals(User $user){
        return RentalResource::collection($user->rentals);
    }

    #[OA\Post(
        path: '/api/users',
        summary: 'Créer un utilisateur',
        tags: ['User'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['firstName', 'lastName', 'email', 'phone'],
               
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Utilisateur créé'),
            new OA\Response(response: 422, description: 'Erreur de validation')
        ]
    )]
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:users,email',
            'phone' => 'required|string|max:12',
        ]);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],422);
        }
    
        $user = User::create($validator->validated());

        return response()->json([
            'message'=>'Utilisateur créé avec succes',
            'data'=> new UserResource($user)
        ],201);
    }
    #[OA\Put(
        path: '/api/users/{user}',
        summary: 'Mettre à jour complètement un utilisateur',
        tags: ['User'],
        parameters: [
            new OA\Parameter(
                name: 'user',
                in: 'path',
                required: true,
                schema: new OA\Schema(type: 'integer')
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['firstName', 'lastName', 'email', 'phone'],
                
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Utilisateur mis à jour'),
            new OA\Response(response: 422, description: 'Erreur de validation')
        ]
    )]
    public function update(Request $request, User $user){
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:12',
        ]);
        if($validator->fails()){
            return response()->json([
                'errors'=>$validator->errors()
            ],422);
        }
    
        $user -> update($validator->validated());

        return response()->json([
            'message'=>'Utilisateur mis a jour avec succes',
            'data'=> new UserResource($user)
        ],200);
    }
}
