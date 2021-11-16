<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizType extends Model
{
    use HasFactory;

    protected $table = 'quiz_types';

    protected $fillable = ['name', 'unique_name'];

    public function quiz()
    {
        return $this->hasMany(Quiz::class);
    }
}
