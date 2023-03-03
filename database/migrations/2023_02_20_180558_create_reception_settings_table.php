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
        Schema::create('pckreceptionsettings', function (Blueprint $table) {
            $table->id();
            $table->string('PeaksUserNo', 10);                                  //ピークス内のユーザー番号 (000000)
            $table->string('ClinicID', 10);                                     //病院ID　ゼロパディング数字5桁（000000)　　ログイン用
            $table->string('ClinicName', 100);                                  //病院名
            $table->date('Time1EnableDate');                                    //Time1の時間帯で受付を行う場合の日付が入る
            $table->tinyInteger('RunningColumn1')->nullable()->default(1);      //同時に診察できる獣医師数または診察室数
            $table->time('StartTime1')->nullable()->default("09:30");           //1番目の予約開始時間
            $table->time('EndTime1')->nullable()->default("11:30");             //1番目の予約開始時間
            $table->date('Time2EnableDate');                                    //Time2の時間帯で受付を行う場合の日付が入る
            $table->tinyInteger('RunningColumn2')->nullable()->default(1);      //同時に診察できる獣医師数または診察室数
            $table->time('StartTime2')->nullable()->default("16:30");           //2番目の予約開始時間
            $table->time('EndTime2')->nullable()->default("19:30");             //2番目の予約開始時間
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pckreceptionsettings');
    }
};
