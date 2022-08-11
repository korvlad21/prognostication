<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times', function (Blueprint $table) {
			$table->id();
             $table->foreignId('user_id');
            $table->string('name');
            $table->integer('kolvo');
            $table->double('y1');
            $table->double('y2');
            $table->double('y3');
            $table->double('y4');
            $table->double('y5')->nullable();
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
        Schema::dropIfExists('times');
    }
}
