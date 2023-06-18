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
        Schema::create('logistic', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_number');
            $table->string('tracking_number')->unique();
            $table->unsignedBigInteger('order_id');
            $table->string('sender_name');
            $table->string('recipient_name');
            $table->date('shipment_date');
            $table->integer('duration_in_days');
            $table->string('status')->default('pending');
            $table->text('description')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('logistic');
    }
};
