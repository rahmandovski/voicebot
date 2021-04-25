<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntegrasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrasi', function (Blueprint $table) {
            $table->bigIncrement('id');
            $table->string('path_audio');
            $table->string('script');
            $table->string('model');
            $table->string('konteks1');
            $table->string('konteks2');
            $table->string('konteks3');
            $table->string('konteks4'); 
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
        Schema::dropIfExists('integrasi');
    }
}
