<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsAnswersTable extends Migration
{
    public function up()
    {
        Schema::create('exams_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('attempt_id');
            $table->unsignedBigInteger('question_id');
            $table->unsignedBigInteger('answer_id');
            $table->foreign('attempt_id')->references('id')->on('exams_answers')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('exams_answers')->onDelete('cascade');
            $table->foreign('answer_id')->references('id')->on('exams_answers')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('exams_answers');
    }
}