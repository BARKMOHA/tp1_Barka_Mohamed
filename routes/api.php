<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// tout les equipements
Route::get('/equipments', [EquipmentController::class, 'index']);
// location d'un utilisateur
Route::get('/users/{user}/rentals', [UserController::class, 'rentals']);
// indice de popularite
Route::get('/equipments/{equipment}/popularity', [EquipmentController::class, 'popularity']);
// creer un utilisateur
Route::post('/users', [UserController::class, 'store']);
// mise a jour d'un utilisateur
Route::put('/users/{user}', [UserController::class, 'update']);
// supprimer review
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);
// calcul moyen de location d'equipement
Route::get('/equipments/{equipment}/average-price', [EquipmentController::class, 'averagePrice']);