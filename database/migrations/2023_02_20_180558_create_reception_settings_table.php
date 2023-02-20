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
        Schema::create('reception_settings', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('time1_enable_date');
            $table->tinyInteger('running_column1')->nullable()->default(1);
            $table->time('start_time1')->nullable()->default("09:30");
            $table->time('end_time1')->nullable()->default("11:30");
            $table->date('time2_enable_date');
            $table->tinyInteger('running_column2')->nullable()->default(1);
            $table->time('start_time2')->nullable()->default("16:30");
            $table->time('end_time2')->nullable()->default("19:30");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reception_settings');
    }
};
