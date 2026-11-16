<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

#[OA\Get(
    path: '/api/reviews/{review}',
    summary: 'Suppression de critique',
    tags: ['Review'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'review supprime',
           
        )
    ]
)]
class ReviewController extends Controller
{
    public function destroy(Review $review)
    {
        $review->delete();

        return response()->json([
            'message' => 'Critique supprimée avec succès'
        ], 200);

    }   
}
