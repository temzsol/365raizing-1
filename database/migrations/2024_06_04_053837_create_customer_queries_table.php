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
        Schema::create('customer_queries', function (Blueprint $table) {
            $table->id();
            $table->string('created_by')->nullable();
            $table->string('leadtype')->nullable();
            $table->string('ct_name')->nullable();
            $table->string('ct_mail')->nullable();
            $table->string('ct_mob')->nullable();
            $table->string('ct_phone')->nullable();
            $table->string('reference_through')->nullable();
            $table->string('profession')->nullable();
            $table->string('nationality')->nullable();
            $table->string('address')->nullable();
            $table->string('query_brand')->nullable();
            $table->string('query_division')->nullable();
            $table->string('query_emp')->nullable();
            $table->string('ct_passport')->nullable();
            $table->string('query_details')->nullable();
            $table->string('query_date')->nullable();
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
        Schema::dropIfExists('customer_queries');
    }
};
