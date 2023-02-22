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
        Schema::create('receptions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('cust_id')->unsigned();
            $table->date('visit_at')->nullable();
            $table->tinyInteger('visit_order');
            $table->string('visit_reason', 100)->nullable()->default(null);
            $table->dateTime('entry_at')->nullable();
            $table->tinyInteger('take_time')->nullable()->default(0);
            $table->tinyInteger('status')->nullable()->default(0);
            $table->string('patient_no', 100);
            $table->boolean('regist_done')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receptions');
    }
};
