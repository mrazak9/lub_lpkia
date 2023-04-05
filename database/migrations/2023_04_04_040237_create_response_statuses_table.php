<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponseStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('response_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_response')->constrained('responses')->onDelete('cascade');
            $table->foreignId('id_student')->constrained('students')->onDelete('cascade');
            $table->boolean('is_response')->default(false);
            
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
        Schema::dropIfExists('response_statuses');
    }
}
