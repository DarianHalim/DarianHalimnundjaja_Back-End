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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); // This creates an auto-incrementing primary key
            $table->unsignedBigInteger('cart_id'); // Foreign key reference to the carts table
            $table->integer('invoiceNo');
            $table->string('alamat_pengiriman'); // Alamat Pengiriman
            $table->string('kode_pos', 5); // Kode Pos - Corrected type and size
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
