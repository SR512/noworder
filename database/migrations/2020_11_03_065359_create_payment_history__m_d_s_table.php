<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoryMDSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_history__m_d_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('frontuser_id');
            $table->unsignedBigInteger('order_id');
            $table->string('payment_id');
            $table->string('currency');
            $table->string('created');
            $table->string('status');
            $table->string('amount');
            $table->timestamps();

            $table->foreign('frontuser_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_history__m_d_s');
    }
}
