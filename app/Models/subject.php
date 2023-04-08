<?php

namespace App\Models;

use App\Models\Level;
use App\Models\Learning;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',

    ];

    public function levels()
    {
        return $this->belongsToMany(
            Level::class,
            'level_subject',
            'subject_id',
            'level_id'

        );
    }

    public function learnings()
    {

        return $this->hasMany(Learning::class);
    }
}