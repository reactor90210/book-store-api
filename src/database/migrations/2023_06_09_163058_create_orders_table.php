<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('status',['pending', 'confirmed', 'processing', 'completed'])->default('pending');
            $table->enum('delivery_method',['nova_poshta', 'meest', 'ukr_poshta'])->default('nova_poshta');
            $table->enum('payment_method',['visa', 'mastercard', 'am_express', 'cash'])->default('visa');
            $table->timestamps();
            $table->index('user_id');
            $table->index('status');
            $table->index('delivery_method');
            $table->index('payment_method');

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
        Schema::dropIfExists('orders');
    }
}
