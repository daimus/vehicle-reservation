<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'vehicle_id',
        'note',
        'created_by'
    ];

    public function vehicle(){
        return $this->hasOne(Vehicle::class, 'id', 'vehicle_id');
    }

    public function approvals(){
        return $this->hasMany(Approval::class, 'reservation_id', 'id');
    }

    public function trip(){
        return $this->belongsTo(Trip::class, 'id', 'reservation_id');
    }
}
