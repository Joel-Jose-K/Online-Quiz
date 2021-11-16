<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizParticipantAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_participant_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_participant_id');
            $table->foreign('quiz_participant_id')->references('id')->on('quiz_participants');
            $table->unsignedBigInteger('quiz_question_id');
            $table->foreign('quiz_question_id')->references('id')->on('quiz_questions');
            $table->unsignedBigInteger('question_answer_option_id');
            $table->foreign('question_answer_option_id')->references('id')->on('question_answer_options');
            $table->string('answer_score', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_participant_answers');
    }
}
