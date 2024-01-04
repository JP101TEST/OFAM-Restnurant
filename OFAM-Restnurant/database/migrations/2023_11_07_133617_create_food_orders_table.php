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
        Schema::create('food_orders', function (Blueprint $table) {
            $table->string('food_order_id')->length(255);
            $table->primary('food_order_id');
            $table->integer('table_id');
            $table->foreign('table_id')
                ->references('table_id')
                ->on('tables');
            $table->integer('menu_id');
            $table->foreign('menu_id')
                ->references('menu_id')
                ->on('menus');
            $table->integer('food_amount')->length(255);
            $table->enum('food_order_status', ['สั่ง', 'กำลังปรุง', 'เสริฟแล้ว', 'รอชำระเงิน', 'ชำระเงินเรียบร้อย']);
            $table->date('date_order');
            /*
            SELECT f1.table_id,f1.food_order_status
            FROM food_orders AS f1
            WHERE food_order_status BETWEEN 1 AND 4
            AND food_order_status = (
                SELECT MIN(food_order_status)
                FROM food_orders AS f2
                WHERE f1.table_id = f2.table_id
                AND f2.food_order_status BETWEEN 1 AND 4
            )
            */

            /*
            SELECT t.*, f1.table_id, f1.food_order_status
            FROM tables AS t
            LEFT JOIN food_orders AS f1 ON t.table_id = f1.table_id
            AND f1.food_order_status BETWEEN 1 AND 4
            AND f1.food_order_status = (
                SELECT MIN(food_order_status)
                FROM food_orders AS f2
                WHERE f1.table_id = f2.table_id
                AND f2.food_order_status BETWEEN 1 AND 4
            );
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_orders');
    }
};
