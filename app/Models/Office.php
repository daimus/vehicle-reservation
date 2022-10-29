<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'type',
        'user_id'
    ];

    public function officer(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
