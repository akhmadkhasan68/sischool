<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kelas');
            $table->string('nama_kelas');
            $table->string('tingkat_kelas');
            $table->string('jurusan_kelas');
            $table->integer('wali_kelas');
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
        Schema::dropIfExists('table_kelas');
    }
}
