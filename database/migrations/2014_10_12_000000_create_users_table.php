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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_no', 10)->unique();
            $table->string('clinic_id', 6)->unique();
            $table->string('clinic_name', 100);
            $table->string('tel_no_new', 13);
            $table->string('tel_num_new', 13);
            $table->string('tel_no_old', 13)->nullable()->default(null);
            $table->string('tel_num_old', 13)->nullable()->default(null);
            $table->string('email')->unique();
            $table->string('password');
            $table->date('password_expired_at');
            $table->dateTime('login_at')->nullable();
            $table->date('license_at')->nullable();
            $table->boolean('patient_reg_opt')->nullable()->default(false);
            $table->boolean('reception_opt')->nullable()->default(false);
            $table->boolean('reserve_opt')->nullable()->default(false);
            $table->boolean('opt1')->nullable()->default(false);
            $table->boolean('opt2')->nullable()->default(false);
            $table->tinyInteger('db_no')->nullable()->default(0);
            $table->boolean('maintainance_lock')->nullable()->default(false);
            $table->string('memo')->nullable();
            $table->tinyInteger('cust_status')->nullable()->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
