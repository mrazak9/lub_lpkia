<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_schedule')->constrained('schedules')->onDelete('cascade');
            $table->foreignId('id_student')->constrained('students')->onDelete('cascade');
            $table->foreignId('id_question')->constrained('questions')->onDelete('cascade');
            $table->string('question1', 3)->nullable();
            $table->string('question2', 3)->nullable();
            $table->string('question3', 3)->nullable();
            $table->string('question4', 3)->nullable();
            $table->string('question5', 3)->nullable();
            $table->string('question6', 3)->nullable();
            $table->string('question7', 3)->nullable();
            $table->string('question8', 3)->nullable();
            $table->string('question9', 3)->nullable();
            $table->string('question10', 3)->nullable();
            $table->string('question11', 3)->nullable();
            $table->string('question12', 3)->nullable();
            $table->string('question13', 3)->nullable();
            $table->string('question14', 3)->nullable();
            $table->string('question15', 3)->nullable();
            $table->string('question16', 3)->nullable();
            $table->string('question17', 3)->nullable();
            $table->string('question18', 3)->nullable();
            $table->string('question19', 3)->nullable();
            $table->string('question20', 3)->nullable();
            $table->string('question21', 3)->nullable();
            $table->string('question22', 3)->nullable();
            $table->string('question23', 3)->nullable();
            $table->string('question24', 3)->nullable();
            $table->string('question25', 3)->nullable();
            $table->string('question26', 3)->nullable();
            $table->string('question27', 3)->nullable();
            $table->string('question28', 3)->nullable();
            $table->string('question29', 3)->nullable();
            $table->string('question30', 3)->nullable();
            $table->text('comment1')->nullable();
            $table->text('comment2')->nullable();
            $table->text('comment3')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responses');
    }
}
