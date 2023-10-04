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
        Schema::create('menus', function (Blueprint $table) {
            /*
            SELECT
            m.*,
            mc.menu_category_name
            FROM
            `menus` AS m
            INNER JOIN `menu_categories` AS mc
            ON
            m.menu_category_id = mc.menu_category_id
            WHERE
            1
            ORDER BY
            `menu_id` ASC;
            */
            $table->integer('menu_id')->length(255);
            $table->primary('menu_id');
            $table->string('menu_name')->length(255);
            $table->string('menu_image')->length(255);
            $table->enum('menu_status', ['ยกเลิกให้บริการ','พร้อมให้บริการ', 'หมด']);
            // Add a foreign key column that references the menu_category_id in the menu_categories table
            $table->integer('menu_category_id'); // Assuming it's an integer field

            // Define the foreign key constraint
            $table->foreign('menu_category_id')
                ->references('menu_category_id')
                ->on('menu_categories'); // You can specify the onDelete behavior you want
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
