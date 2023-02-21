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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('cust_no', 10)->unique();
            $table->string('family_name', 100)->default('0');
            $table->string('name', 100)->default('0');
            $table->string('family_name_furigana', 100)->default('0');
            $table->string('name_furigana', 100)->default('0');
            $table->string('address', 100)->nullable()->default('0');
            $table->string('email')->unique();
            $table->string('kind', 10)->nullable()->default('null');
            $table->foreign('last_recept_id')->references('id')->on('receptions')->onDelete('cascade');
            $table->foreign('next_recept_id')->references('id')->on('receptions')->onDelete('cascade');
            $table->boolean('cust_valid')->nullable()->default(true);
            $table->boolean('replace')->nullable()->default(false);
            $table->string('edit_id', 100)->nullable()->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
