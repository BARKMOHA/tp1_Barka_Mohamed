<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['firstName','lastName', 'email', 'phone'])]
//#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    public $timestamps = false;

    /**
     * prompt: comment definir relation one to many d,un table qui possede un cle etranger d,un autre dans laravel
     */
    public function rentals() 
    {
        return $this->hasMany(Rental::class, 'userId');
    }

    public function reviews() 
    {
        return $this->hasMany(Review::class, 'userId');
    }
}
