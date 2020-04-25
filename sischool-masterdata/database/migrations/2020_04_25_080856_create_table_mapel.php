<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMapel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_mapel', function (Blueprint $table) {
            $table->id();
            $table->string('kode_mapel', 100);
            $table->string('nama_mapel', 100);
            $table->enum('kelompok_mapel', ['UMUM', 'PENJURUSAN'])->nullable();
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
        Schema::dropIfExists('table_mapel');
    }
}
