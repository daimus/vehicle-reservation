<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'office_id',
        'head_user_id',
        'admin_user_id'
    ];

    public function head(){
        return $this->hasOne(User::class, 'id', 'head_user_id');
    }

    public function admin(){
        return $this->hasOne(User::class, 'id', 'admin_user_id');
    }

    public function office(){
        return $this->hasOne(Office::class, 'id', 'office_id');
    }
}
