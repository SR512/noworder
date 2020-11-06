<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('caption')->nullable();
            $table->string('image')->nullable();
            $table->unsignedDouble('price')->nullable();
            $table->string('discount')->default('No');
            $table->string('discountprice')->nullable();
            $table->text('description')->nullable();
            $table->integer('isMultiMedia')->default(0);
            $table->integer('status')->default(0);
            $table->foreign('user_id')->references('id')->on('admins')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('items');
    }
}
