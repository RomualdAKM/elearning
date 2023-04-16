<?php

namespace App\Models;

use App\Models\level;
use App\Models\Learning;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'level_id'

    ];



    public function learnings()
    {

        return $this->hasMany(Learning::class);
    }

    public function level(){

        return $this->belongsTo(level::class);
    }
}
