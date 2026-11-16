<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;



#[Fillable(['rating','comment','userId', 'rentalId'])]
class Review extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
    public function rental()
    {
        return $this->belongsTo(Rental::class, 'rentalId');
    }
}
