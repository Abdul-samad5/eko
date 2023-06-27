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
        Schema::create('paidsurveys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('marketsurvey_id');
            $table->string('product_no');
            $table->string('product_name');
            $table->longText('description');
            $table->string('location');
            $table->string('product_image')->nullable();
            $table->string('payment_mode');
            $table->string('payment_id');
            $table->string('total_price');
            $table->bigInteger('status');
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
        Schema::dropIfExists('paidsurveys');
    }
};
