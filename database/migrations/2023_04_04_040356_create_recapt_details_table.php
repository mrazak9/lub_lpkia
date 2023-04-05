<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecaptDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recapt_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recapt_id')->constrained('recapts')->onDelete('cascade');
            $table->foreignId('question_detail_id')->constrained('question_details')->onDelete('cascade');
            $table->integer('value')->default(0);
            
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
        Schema::dropIfExists('recapt_details');
    }
}
