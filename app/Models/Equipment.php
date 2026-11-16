<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;


#[Fillable(['name','description','daily_price','category_id'])]
class Equipment extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class, 'equipment_id');
    }

    public function sports()
    {
        return $this->belongsToMany(
            Sport::class,
            'equipment_sport',
            'equipment_id',
            'sport_id'
        );    
    }
}

