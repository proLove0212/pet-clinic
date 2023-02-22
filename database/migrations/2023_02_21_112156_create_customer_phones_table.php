<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customer_phones', function (Blueprint $table) {
            $table->id();
            $table->integer('cust_id')->unsigned();
            $table->string('tel', 100)->nullable()->default('null');
            $table->string('tel_num', 100)->nullable()->default('null');
            $table->string('tel_last4', 100)->nullable()->default('null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_phones');
    }
};
