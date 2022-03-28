<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultSatisfactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_satisfactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('satisfactions_id')->constrained();
            $table->foreignId('item_evaluations_id')->constrained();
            $table->bigInteger('score')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('result_satisfactions');
    }
}
