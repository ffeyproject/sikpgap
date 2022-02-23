<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_complaints', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaints_id')->constrained();
            $table->foreignId('defects_id')->constrained();
            $table->date('target_waktu');
            $table->string('hasil_penelusuran');
            $table->string('tindakan');
            $table->date('tgl_verifikasi');
            $table->string('hasil_verifikasi');
            $table->bigInteger('penyelidik');
            $table->foreignId('user_id')->constrained();
            $table->rememberToken();
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
        Schema::dropIfExists('result_complaints');
    }
}