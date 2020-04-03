<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGuru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama_guru');
            $table->string('nip_guru');
            $table->enum('jk_guru', ['L', 'P']);	
            $table->string('no_guru', 15);	
            $table->text('alamat_guru');	
            $table->string('kecamatan_guru');
            $table->string('kota_guru');
            $table->string('foto_guru');
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
        Schema::dropIfExists('table_guru');
    }
}
