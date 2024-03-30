<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuestionIdToResponseStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('response_statuses', function (Blueprint $table) {
            $table->foreignId('id_question')->constrained('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('response_statuses', function (Blueprint $table) {
            $table->dropForeign(['id_question']);
            $table->dropColumn('id_question');
        });
    }
}
