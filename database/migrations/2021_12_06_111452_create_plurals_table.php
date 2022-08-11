<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePluralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plurals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('name');
            $table->integer('kolvo');
            $table->double('x1_1');
            $table->double('x1_2');
            $table->double('x1_3');
            $table->double('x1_4');
            $table->double('x1_5');
            $table->double('x1_6')->nullable();
            $table->double('x1_7')->nullable();
            $table->double('x1_8')->nullable();
            $table->double('x1_9')->nullable();
            $table->double('x1_10')->nullable();
            $table->double('x1_11')->nullable();
            $table->double('x1_12')->nullable();
            $table->double('x1_13')->nullable();
            $table->double('x1_14')->nullable();
            $table->double('x1_15')->nullable();
            $table->double('x1_16')->nullable();
            $table->double('x1_17')->nullable();
            $table->double('x1_18')->nullable();
            $table->double('x1_19')->nullable();
            $table->double('x1_20')->nullable();
            $table->double('x2_1');
            $table->double('x2_2');
            $table->double('x2_3');
            $table->double('x2_4');
            $table->double('x2_5');
            $table->double('x2_6')->nullable();
            $table->double('x2_7')->nullable();
            $table->double('x2_8')->nullable();
            $table->double('x2_9')->nullable();
            $table->double('x2_10')->nullable();
            $table->double('x2_11')->nullable();
            $table->double('x2_12')->nullable();
            $table->double('x2_13')->nullable();
            $table->double('x2_14')->nullable();
            $table->double('x2_15')->nullable();
            $table->double('x2_16')->nullable();
            $table->double('x2_17')->nullable();
            $table->double('x2_18')->nullable();
            $table->double('x2_19')->nullable();
            $table->double('x2_20')->nullable();
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
        Schema::dropIfExists('plurals');
    }
}
