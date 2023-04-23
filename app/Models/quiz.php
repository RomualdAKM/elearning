<?php

namespace App\Models;

use App\Models\chapter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'option1',
        'option2',
        'option3',
        'response',
        'chapter_id',
    ];

    public function chapter()
    {
        return $this->belongsTo(chapter::class);
    }
}
