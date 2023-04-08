<?php

namespace App\Models;

use App\Models\level;
use App\Models\category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class book extends Model
{
    use HasFactory;

    protected $guaded = [];

    public function level(){

        return $this->belongsTo(level::class);
    }

    public function category() {

        return $this->belongsTo(category::class);
        
    }
}
