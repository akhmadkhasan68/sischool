<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableConfSekolah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('npsn_sekolah', 100);
            $table->string('nama_sekolah', 100);
            $table->enum('jenjang_sekolah', ['SD', 'SMP', 'SMA']);
            $table->text('alamat_sekolah');
            $table->string('kota_sekolah', 100);
            $table->string('telepon_sekolah', 15);
            $table->string('email_sekolah', 50);
            $table->string('fax_sekolah', 50);
            $table->string('web_sekolah', 50);
            $table->enum('tipe_sekolah', ['NEGERI', 'SWASTA']);
            $table->string('logo_sekolah', 100);
            $table->enum('status_ppdb', ['1', '0']);
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
        Schema::dropIfExists('table_conf_sekolah');
    }
}
