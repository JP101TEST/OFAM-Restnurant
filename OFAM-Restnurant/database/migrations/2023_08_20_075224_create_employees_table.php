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
        Schema::create('employees', function (Blueprint $table) {
            $table->string('employees_id')->length(255);
            $table->string('employees_password')->length(255);
            $table->string('first_name')->length(255);
            $table->string('last_name')->length(255);
            $table->string('house_number')->length(255)->nullable();
            $table->string('road')->length(255);
            $table->string('sub_district')->length(255);
            $table->string('district')->length(255);
            $table->string('province')->length(255);
            $table->integer('postal_code')->length(5);
            $table->string('employees_picture')->length(255);
            $table->integer('employees_phone')->length(10);
            $table->enum('management_lavel', ['employee', 'admin']);
            $table->timestamps();
            //Define primary key
            $table->primary('employees_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
