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
        Schema::create('bill_lists', function (Blueprint $table) {
            $table->integer('bill_id')->length(255);
            $table->primary('bill_id');
            $table->string('employees_id')->length(255);
            $table->foreign('employees_id')
                ->references('employees_id')
                ->on('employees');
            $table->json('food_order_id');
            $table->integer('promotion_id')->length(255)->nullable();;
            $table->foreign('promotion_id')
                ->references('promotion_id')
                ->on('promotions');
            $table->integer('discount_thad_day')->length(255)->nullable();;
            $table->integer('total_price')->length(255);
            $table->string('customer_name')->length(255);
            $table->string('restaurant_id')->length(255);
            $table->foreign('restaurant_id')
                ->references('restaurant_id')
                ->on('restaurant_infos');
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
        Schema::dropIfExists('bill_lists');
    }
};
