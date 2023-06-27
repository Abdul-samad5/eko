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
        Schema::create('deliveryemails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('client_email');
            $table->string('pickup_no');
            $table->string('delivery_package');
            $table->string('box_no');
            $table->string('box_size');
            $table->string('extrabox_no');
            $table->string('extra_box');
            $table->string('distance_km');
            $table->string('dimensional_w');
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
        Schema::dropIfExists('deliveryemails');
    }
};
