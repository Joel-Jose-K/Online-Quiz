<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    // protected $appends = ['name'];

    protected $table = 'quizzes';

    protected $fillable = ['quiz_type_id', 'title', 'description', 'active_from', 'active_to', 'status', 'is_publish', 'is_evaluate', 'created_by'];

    public function quiztype()
    {
        return $this->belongsTo(QuizType::class,'quiz_type_id');
    }
}
