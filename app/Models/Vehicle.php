<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $table = 'vehicles';
    protected $fillable = [
        'brand',
        'model',
        'vehicle_no',
        'type',
        'ownership',
        'pool_id',
        'is_available'
    ];

    protected $casts = [
        'is_available' => 'boolean'
    ];

    public function pool(){
        return $this->hasOne(Pool::class, 'id', 'pool_id');
    }

    public function office(){
        return $this->hasOneThrough(Office::class, Pool::class, 'id',  'id', 'id', 'office_id');
    }
}
