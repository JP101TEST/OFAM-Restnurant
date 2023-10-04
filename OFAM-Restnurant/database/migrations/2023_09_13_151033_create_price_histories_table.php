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
        Schema::create('price_histories', function (Blueprint $table) {
            $table->integer('price_history_id')->length(255);
            $table->primary('price_history_id');
            $table->integer('price')->length(11);
            $table->integer('menu_id');

            $table->foreign('menu_id')
                ->references('menu_id')
                ->on('menus');

            $table->date('date_start');
            $table->date('date_end')->nullable();
            /*สำหรับ insert test
            INSERT INTO `price_histories`(
            `price_history_id`,
            `price`,
            `date_start`,
            `date_end`
            )
            VALUES(
            1,
            15,
            CURRENT_TIMESTAMP,
            null
            )

            อัพเดต
            UPDATE `price_histories`
            SET `date_end` = DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 5 DAY)
            WHERE `price_history_id` = 1;
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
        Schema::dropIfExists('price_histories');
    }
};
