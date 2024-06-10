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
        Schema::create('vendor_task_assigns', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable();
            $table->string('service')->nullable();
            $table->string('assign_date')->nullable();
            $table->string('deadeline')->nullable();
            $table->string('task_details')->nullable();
            $table->string('task_file')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('is_deleted')->default(1);
            $table->integer('venror_id')->nullable();

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
        Schema::dropIfExists('vendor_task_assigns');
    }
};
