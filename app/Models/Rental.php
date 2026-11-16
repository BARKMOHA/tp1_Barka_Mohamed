<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


#[Fillable(['startDate','endDate','totalPrice','userId', 'equipment_id'])]
class Rental extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'rentalId');
    }

}
