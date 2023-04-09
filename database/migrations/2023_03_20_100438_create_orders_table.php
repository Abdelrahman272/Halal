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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('coupon_id')->nullable()->constrained()->onDelete('set null');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->decimal('total')->default(0);
            $table->decimal('discount')->default(0);
            $table->string('status')->default('new');
            $table->string('payment_method')->default('cash_on_delivery');
            $table->string('payment_status')->default('pending');
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
        Schema::dropIfExists('orders');
    }
};
