<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('buyers_id')->constrained();
            $table->bigInteger('no_urut');
            $table->string('nomer_keluhan');
            $table->date('tgl_keluhan');
            $table->string('nama_marketing');
            $table->string('no_wo');
            $table->string('no_sc');
            $table->string('nama_motif');
            $table->string('cw_qty');
            $table->string('jenis');
            $table->string('masalah');
            $table->string('solusi');
            $table->date('tgl_proses')->nullable();
            $table->string('status')->default('open');
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
        Schema::dropIfExists('complaints');
    }
}