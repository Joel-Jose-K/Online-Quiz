<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionAnswerOption extends Model
{
    use HasFactory;

    protected $table = 'question_answer_options';

    protected $fillable = ['question_id', 'answer_option'];

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
