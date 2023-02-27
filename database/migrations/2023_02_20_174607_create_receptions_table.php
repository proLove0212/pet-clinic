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
            $table->string('ClinicID', 10);                                 //病院ID　ゼロパディング数字5桁（00000)
            $table->string('CustNo', 10);                                   //顧客番号
            $table->date('VisitDate');                                      //来院日　日付形式yyyy-mm-dd
            $table->tinyInteger('VisitOrderIndex')->nullable()->default(0); //受付順番号 ClinicID内でVisitDate順に１から採番
            $table->string('VisitReason', 200)->nullable()->default(null);  //来院理由
            $table->dateTime('EntryTime')->nullable();                      //受付登録時間（yyyy-mm-dd hh:mm:ss)
            $table->tinyInteger('TakeTime')->nullable()->default(0);        //診察にかかる予想時間
            $table->tinyInteger('Status')->nullable()->default(0);          //1=順番受付中　2=診察開始　3=帰院　0=キャンセル
            $table->string('NewPatientNo', 10);                             //XX-XXXのように数字5桁が入る
            $table->date('RegistDone')->nullable();                         //PCKのDBに登録された時間（yyyy-mm-dd hh:mm:ss)
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
