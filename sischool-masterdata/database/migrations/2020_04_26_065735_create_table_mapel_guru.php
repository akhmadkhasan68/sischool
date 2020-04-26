<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMapelGuru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_mapel_guru', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id');	
            $table->foreignId('mapel_id');	
            $table->integer('kkm');
            $table->foreign('guru_id')->references('id')->on('table_guru');
            $table->foreign('mapel_id')->references('id')->on('table_mapel');
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
        Schema::dropIfExists('table_mapel_guru');
    }
}
