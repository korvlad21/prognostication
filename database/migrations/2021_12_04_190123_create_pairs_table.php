<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name');
            $table->integer('kolvo');
            $table->double('x1');
            $table->double('x2');
            $table->double('x3');
            $table->double('x4');
            $table->double('x5');
            $table->double('x6')->nullable();
            $table->double('x7')->nullable();
            $table->double('x8')->nullable();
            $table->double('x9')->nullable();
            $table->double('x10')->nullable();
            $table->double('x11')->nullable();
            $table->double('x12')->nullable();
            $table->double('x13')->nullable();
            $table->double('x14')->nullable();
            $table->double('x15')->nullable();
            $table->double('x16')->nullable();
            $table->double('x17')->nullable();
            $table->double('x18')->nullable();
            $table->double('x19')->nullable();
            $table->double('x20')->nullable();
            $table->double('y1');
            $table->double('y2');
            $table->double('y3');
            $table->double('y4');
            $table->double('y5');
            $table->double('y6')->nullable();
            $table->double('y7')->nullable();
            $table->double('y8')->nullable();
            $table->double('y9')->nullable();
            $table->double('y10')->nullable();
            $table->double('y11')->nullable();
            $table->double('y12')->nullable();
            $table->double('y13')->nullable();
            $table->double('y14')->nullable();
            $table->double('y15')->nullable();
            $table->double('y16')->nullable();
            $table->double('y17')->nullable();
            $table->double('y18')->nullable();
            $table->double('y19')->nullable();
            $table->double('y20')->nullable();
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
        Schema::dropIfExists('pairs');
    }
}
