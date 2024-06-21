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
        Schema::create('login_details', function (Blueprint $table) {
            $table->id();
            $table->string('uemail')->nullable();
            $table->string('ip')->nullable();
            $table->string('login_time')->nullable();
            $table->string('logout_time')->nullable();
            $table->string('login_date')->nullable();
            $table->tinyInteger('current_status')->default(0);
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
        Schema::dropIfExists('login_details');
    }
};
