<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfLevel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_level', function (Blueprint $table) {
            $table->id();
            $table->string('level', 50);
            $table->string('jenjang', 50);
            $table->bigInteger('urutan');
            $table->bigInteger('sem_genap');
            $table->bigInteger('sem_ganjil');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conf_level');
    }
}
