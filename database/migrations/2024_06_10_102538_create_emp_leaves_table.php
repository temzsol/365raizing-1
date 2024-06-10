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
        Schema::create('emp_leaves', function (Blueprint $table) {
            $table->id();
            $table->string('emp_id')->nullable();
            $table->string('l_title')->nullable();
            $table->string('l_date')->nullable();
            $table->string('l_desc')->nullable();
            $table->string('l_status')->nullable();
            $table->string('to_date')->nullable();
            $table->string('no_days')->nullable();
            $table->string('type')->nullable();
            $table->string('leave_remaining')->nullable();
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('emp_leaves');
    }
};
