<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('father')->unsigned()->nullable();
            $table->string('name');
            $table->string('path')->nullable();
            $table->string('description')->nullable();
            $table->string('icon_l')->default('fa-circle-o');
            $table->string('icon_r')->nullable()->default('fa-angle-left');
            $table->smallInteger('order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('father')->references('id')->on('options');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}
