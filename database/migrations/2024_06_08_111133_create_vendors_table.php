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
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
             $table->string('fname')->nullable();
             $table->string('mname')->nullable();
             $table->string('lname')->nullable();
             $table->string('vemail')->nullable();
             $table->string('vcont')->nullable();
             $table->string('vbrand')->nullable();
             $table->string('vcomp')->nullable();
             $table->string('vservice')->nullable();
             $table->string('vgstin')->nullable();
             $table->string('vstreet')->nullable();
             $table->string('vcity')->nullable();
             $table->string('vcode')->nullable();
             $table->string('vcountry')->nullable();
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
        Schema::dropIfExists('vendors');
    }
};
