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
            $table->foreignId('id_response')->constrained('responses')->onDelete('cascade');
            $table->foreignId('id_schedule')->constrained('schedules')->onDelete('cascade');
            $table->integer('total_responsdent')->nullable();
           
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
