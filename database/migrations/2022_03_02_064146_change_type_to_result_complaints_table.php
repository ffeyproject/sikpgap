<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeToResultComplaintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('result_complaints', function (Blueprint $table) {
            $table->longText('hasil_penelusuran')->change();
            $table->longText('tindakan')->change();
            $table->longText('hasil_verifikasi')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('result_complaints', function (Blueprint $table) {
            //
        });
    }
}