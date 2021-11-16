<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizzesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_type_id');
            $table->foreign('quiz_type_id')->references('id')->on('quiz_types');
            $table->string('title', 250);
            $table->text('description')->nullable();
            $table->dateTime('active_from');
            $table->dateTime('active_to');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('is_publish')->default(0);
            $table->tinyInteger('is_evaluate')->default(0);
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('quizzes');
    }
}
