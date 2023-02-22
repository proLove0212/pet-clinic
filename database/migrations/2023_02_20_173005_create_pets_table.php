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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('cust_id')->unsigned();
            $table->string('karte_no', 10);
            $table->string('pet_no', 3)->unique();
            $table->string('name', 100);
            $table->string('name_furigana', 100)->nullable()->default('');
            $table->string('kind', 15)->nullable();
            $table->string('breed', 80)->nullable();
            $table->date('birthday')->nullable();
            $table->tinyInteger('death_type')->nullable()->default(0);
            $table->date('death_date')->nullable();
            $table->string('sex', 5)->nullable()->default('M');
            $table->boolean('is_valid')->nullable()->default(true);
            $table->string('vacc_info', 500)->nullable()->default('');
            $table->string('memo', 500)->nullable()->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};
