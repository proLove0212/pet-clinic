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
        Schema::create('pckreasonsettings', function (Blueprint $table) {
            $table->id();
            $table->string('PeaksUserNo', 10);                                      //ピークス内のユーザー番号 (000000)
            $table->string('ClinicID', 10);                                         //病院ID　ゼロパディング数字5桁（000000)　　ログイン用
            $table->string('VisitReason', 20)->nullable()->default('');             //来院理由
            $table->tinyInteger('VisitReasonDispOrder')->nullable()->default(1);    //来院理由の表示順
            $table->tinyInteger('TakeTime')->nullable()->default(20);               //来院理由別に一人当たりに必要な時間を設定（単位：分）
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pckreasonsettings');
    }
};
