<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKelasAjar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_kelas_ajar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mapel_guru_id');	
            $table->foreignId('kelas_id');	
            $table->foreign('mapel_guru_id')->references('id')->on('table_mapel_guru');
            $table->foreign('kelas_id')->references('id')->on('table_kelas');
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
        Schema::dropIfExists('table_kelas_ajar');
    }
}
