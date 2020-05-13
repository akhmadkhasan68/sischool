<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSiswaOrtu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_siswa_ortu', function (Blueprint $table) {
            $table->id();
            $table->string('siswa_nis');
            $table->string('nama_ortu', 100);
            $table->enum('jk_ortu', ['L', 'P']);
            $table->string('no_ortu', 15);	
            $table->text('alamat_ortu');	
            $table->string('kota_ortu');
            $table->string('pendidikan_ortu');
            $table->string('pekerjaan_ortu');
            $table->string('gaji_ortu');
            $table->enum('status_hubungan', ['Ayah', 'Ibu', 'Wali']);
            $table->foreignId('id_user');
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
        Schema::dropIfExists('table_siswa_ortu');
    }
}
