<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_users', function (Blueprint $table) {
            $table->integer('option_id')->index('fk_option_users_option1_idx')->unsigned();
            $table->integer('user_id')->index('fk_option_users_user1_idx')->unsigned();

            $table->foreign('option_id')->references('id')->on('options');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('option_users');
    }
}
