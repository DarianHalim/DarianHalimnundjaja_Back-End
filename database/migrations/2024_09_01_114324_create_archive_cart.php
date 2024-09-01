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
        Schema::create('archive_cart', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('string1');
            $table->string('string2');
            $table->string('string3');
            $table->string('string4');
            $table->string('string5');
            $table->string('string6');
            $table->string('string7');
            $table->string('string8');
            $table->string('string9');
            $table->string('string10');
            $table->string('string11');
            $table->string('string12');
            $table->string('string13');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('archive_cart');
    }
};
