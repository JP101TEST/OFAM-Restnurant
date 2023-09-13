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
        Schema::create('tables', function (Blueprint $table) {
            $table->integer('table_id')->length(255);
            $table->string('table_name')->length(255);
            $table->integer('tables_password')->length(6);
            $table->enum('tables_status', ['ยกเลิกการใช้งาน','ว่าง', 'ไม่ว่าง']);

            //Define primary key
            $table->primary('table_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
    }
};
