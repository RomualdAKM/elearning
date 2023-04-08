<?php

namespace App\Models;

use App\Models\quiz;
use App\Models\Learning;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class chapter extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'description',
        'file',
        'url',
        'learning_id',

    ];

    public function learning()
    {
        return $this->belongsTo(Learning::class);
    }

    public function quizzes()
    {
        return $this->hasMany(quiz::class);
    }
}