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
        Schema::create('staff_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('t_title')->nullable();
            $table->string('deadline')->nullable();
            $table->string('t_file')->nullable();
            $table->string('t_detail')->nullable();
            $table->string('assign_date')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('personal_id')->nullable();
            $table->integer('emp_id')->nullable();
            $table->tinyInteger('is_deleted')->default(1);
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
        Schema::dropIfExists('staff_tasks');
    }
};
