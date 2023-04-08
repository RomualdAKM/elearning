<?php

namespace App\Models;


use App\Models\book;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function users(){

        return $this->hasMany(User::class);
    }

    public function books(){

        return $this->hasMany(book::class);
    }
}
