<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('productId')->constrained('products');
            $table->foreignId('customerId')->constrained('users');
            $table->integer('payment');
            $table->integer('quantity')->default(1);
            $table->integer('ongkos_kirim')->default(0);
            $table->integer('payment_status')->default(1);
            $table->string('shipping_status')->default('belum dikirim');
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
        Schema::dropIfExists('carts');
    }
}
