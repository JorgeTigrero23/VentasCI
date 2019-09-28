<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('client_type_id')->unsigned();
            $table->integer('document_type_id')->unsigned();
            $table->string('document_number', 12);
            $table->string('phone', 15);
            $table->string('mail');
            $table->string('address');
            $table->timestamps();
            $table->softDeletes();

            // Relationship
            $table->foreign('client_type_id')
                ->references('id')
                ->on('client_types')
                ->onDelete('cascade');
            
            $table->foreign('document_type_id')
                ->references('id')
                ->on('document_types')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
