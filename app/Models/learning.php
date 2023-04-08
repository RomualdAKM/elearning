<?php

namespace App\Models;


use App\Models\Chapter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class learning extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subject_id'
    ];



    public function chapters()
    {

        return $this->hasMany(Chapter::class);
    }
}