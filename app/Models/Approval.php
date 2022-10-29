<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;
    protected $fillable = [
        'reservation_id',
        'level',
        'user_id',
        'is_approved'
    ];

    protected $casts = [
        'is_approved' => 'boolean'
    ];

    public function reservation(){
        return $this->belongsTo(Reservation::class, 'reservation_id', 'id');
    }

    public function vehicle(){
        return $this->hasOneThrough(Vehicle::class, Reservation::class, 'id', 'id', 'reservation_id', 'vehicle_id');
    }
}
