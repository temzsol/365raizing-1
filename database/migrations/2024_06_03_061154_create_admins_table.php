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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('fname')->nullable();
            $table->string('empmob')->nullable();
            $table->string('empmail')->nullable();
            $table->string('aadhar_no')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('create_date')->nullable();
            $table->string('doj')->nullable();
            $table->string('total_leave')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('admins');
    }
};
