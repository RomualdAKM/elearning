<?php

namespace App\Models;

use App\Models\quiz;
use App\Models\learning;
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
        return $this->belongsTo(learning::class);
    }

    public function quizzes()
    {
        return $this->hasMany(quiz::class);
    }
}
