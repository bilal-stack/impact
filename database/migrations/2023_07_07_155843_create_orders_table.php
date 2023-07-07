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
            $table->uuid('order_number')->unique();
            $table->unsignedBigInteger('user_id');
            $table->string('phone');
            $table->string('email');
            $table->string('address');
            $table->string('country');
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
            $table->unsignedBigInteger('coupon_id')->nullable();
            $table->decimal('discount', 65,2)->default(0);
            $table->decimal('amount', 65,2);
            $table->decimal('final_amount', 65,2);
            $table->longText('notes')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
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
