<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis_siswa', 100);
            $table->string('nisn_siswa', 100);
            $table->string('nama_siswa', 100);
            $table->foreignId('kelas_id');	
            $table->foreign('kelas_id')->references('id')->on('table_kelas');
            $table->enum('agama_siswa', ['Islam','Kristen Katolik','Kristen Protestan','Hindu','Budha']);
            $table->enum('jk_siswa', ['L', 'P']);
            $table->string('no_siswa', 15);	
            $table->text('alamat_siswa');	
            $table->string('kota_siswa');
            $table->string('tempat_lahir_siswa');
            $table->date('tgl_lahir_siswa');
            $table->string('foto_siswa');
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
        Schema::dropIfExists('table_siswa');
    }
}
