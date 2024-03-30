<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecaptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recapts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_question')->constrained('questions')->onDelete('cascade');
            $table->foreignId('id_schedule')->constrained('schedules')->onDelete('cascade');
            $table->integer('total_responsdent')->nullable();
            $table->string('question1', 4)->nullable();
            $table->string('question2', 4)->nullable();
            $table->string('question3', 4)->nullable();
            $table->string('question4', 4)->nullable();
            $table->string('question5', 4)->nullable();
            $table->string('question6', 4)->nullable();
            $table->string('question7', 4)->nullable();
            $table->string('question8', 4)->nullable();
            $table->string('question9', 4)->nullable();
            $table->string('question10', 4)->nullable();
            $table->string('question11', 4)->nullable();
            $table->string('question12', 4)->nullable();
            $table->string('question13', 4)->nullable();
            $table->string('question14', 4)->nullable();
            $table->string('question15', 4)->nullable();
            $table->string('question16', 4)->nullable();
            $table->string('question17', 4)->nullable();
            $table->string('question18', 4)->nullable();
            $table->string('question19', 4)->nullable();
            $table->string('question20', 4)->nullable();
            $table->string('question21', 4)->nullable();
            $table->string('question22', 4)->nullable();
            $table->string('question23', 4)->nullable();
            $table->string('question24', 4)->nullable();
            $table->string('question25', 4)->nullable();
            $table->string('question26', 4)->nullable();
            $table->string('question27', 4)->nullable();
            $table->string('question28', 4)->nullable();
            $table->string('question29', 4)->nullable();
            $table->string('question30', 4)->nullable();
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
        Schema::dropIfExists('recapts');
    }
}
