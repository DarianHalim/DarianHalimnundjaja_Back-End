<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saved_carts', function (Blueprint $table) {
            $table->id();
            $table->string('order_number');
            $table->string('user');
            $table->string('alamat_pengiriman')->default('insert address'); // Default value
            $table->string('kode_pos')->default('11111'); // Default value
           
            $table->string('barang');
            $table->integer('quantity');

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
        Schema::dropIfExists('saved_carts');
    }
};
