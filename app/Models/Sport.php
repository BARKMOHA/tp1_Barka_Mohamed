<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


#[Fillable(['name'])]

class Sport extends Model
{
    use HasFactory;
    /**
     * prompt: comment definir relation many to many entre deux table qui ont un table de piveot dans l'eloquant laravel
     */

    public function equipment() 
    {
        return $this->belongsToMany(
            Equipment::class,
            'equipment_sport',
            'sport_id',
            'equipment_id'
        );    
    }

    public function setup() 
    {
        return 'Sport';
    }
}
