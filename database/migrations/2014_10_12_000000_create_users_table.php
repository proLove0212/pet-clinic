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
        Schema::create('pckusers', function (Blueprint $table) {
            $table->id();
            $table->string('PeaksUserNo', 10)->unique();                    //ピークス内のユーザー番号 (000000)
            $table->string('ClinicID', 6)->unique();                        //病院ID　ゼロパディング数字5桁（000000)　　ログイン用
            $table->string('ClinicName', 100);                              //病院名
            $table->string('TelNo', 13);                                    //現在の電話番号（ハイフンあり）　画面表示用
            $table->string('TelNum', 13);                                   //現在の電話番号（ハイフン無し）　検索用
            $table->string('TelNo_2', 13)->nullable()->default(null);       //転居する前の電話番号（ハイフンあり）　画面表示用
            $table->string('TelNum_2', 13)->nullable()->default(null);      //転居する前の電話番号（ハイフン無し）　検索用
            $table->string('MailAddress')->unique();                        //メールアドレス
            $table->string('Password');                                     //不可逆暗号化
            $table->date('PasswordExpiry');                                 //仮パスワードの有効期限　yyyy-mm-dd　通常有効期限は発行後3日間
            $table->dateTime('LoginDateTime')->nullable();                  //Userがログインした日時　yyyy-mm-dd hh:mm:ss
            $table->date('License')->nullable();                            //ライセンスの期限日　yyyy-mm-dd
            $table->boolean('PatientRegOpt')->nullable()->default(false);   //診察券オプション
            $table->boolean('ReceptionOpt')->nullable()->default(false);    //順番予約オプション
            $table->boolean('ReserveOpt')->nullable()->default(false);      //予約オプション
            $table->boolean('Option1')->nullable()->default(false);         //オプション1 （予備）
            $table->boolean('Option2')->nullable()->default(false);         //オプション2 （予備）
            $table->tinyInteger('DBNo')->nullable()->default(0);            //データベースの番号：1〜10
            $table->boolean('MaintenanceLock')->nullable()->default(false); //メンテナンス中は顧客リストペットリストへのデータ書き込みをロックする
            $table->string('Memo')->nullable();                             //メモ情報
            $table->tinyInteger('CustStatus')->nullable()->default(1);      //サービスの利用状況　0：システム利用停止　1：新規(仮パスワード発行状態)　 2：パスワード再発行(仮パスワード発行状態)　 5：通常利用　
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pckusers');
    }
};
