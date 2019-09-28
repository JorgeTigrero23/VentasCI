<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date', 15);
            $table->string('voucher_number');
            $table->string('serie');
            $table->decimal('subtotal', 11, 2);
            $table->decimal('igv', 11, 2);
            $table->decimal('discount', 11, 2);
            $table->decimal('total', 11, 2);
            $table->integer('voucher_type_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            // Relationship
            $table->foreign('voucher_type_id')
                ->references('id')
                ->on('voucher_types')
                ->onDelete('cascade');
            
            $table->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('sales');
    }
}
