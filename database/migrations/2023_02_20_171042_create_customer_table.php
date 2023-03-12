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
        Schema::create('pckcustlists', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('DBNo')->nullable()->default(0);                                    //データベースの番号：1〜10
            $table->string('ClinicID', 10);                       //病院ID　ゼロパディング数字5桁（00000)
            $table->string('CustNo', 10);                         //顧客番号
            $table->string('CustFamilyName', 100)->default('0');            //顧客姓　データがない場合はNullではなく文字数ゼロが入る
            $table->string('CustName', 100)->default('0');                  //顧客姓ふりがな　データがない場合はNullではなく文字数ゼロが入る
            $table->string('CustFamilyName_furigana', 100)->default('0');   //顧客名　データがない場合はNullではなく文字数ゼロが入る
            $table->string('CustName_furigana', 100)->default('0');         //顧客名ふりがな　データがない場合はNullではなく文字数ゼロが入る
            $table->string('Address', 100)->nullable()->default('0');       //住所　データがない場合はNullではなく文字数ゼロが入る
            $table->string('Tel1')->nullable()->default('');                //ハイフンありの電話番号を暗号化した番号1（画面表示用）
            $table->string('Tel2')->nullable()->default('');                //ハイフンありの電話番号を暗号化した番号2（画面表示用）
            $table->string('Tel3')->nullable()->default('');                //ハイフンありの電話番号を暗号化した番号3（画面表示用）
            $table->string('Tel4')->nullable()->default('');                //ハイフンありの電話番号を暗号化した番号4（画面表示用）
            $table->string('Tel5')->nullable()->default('');                //ハイフンありの電話番号を暗号化した番号5（画面表示用）
            $table->string('Tel6')->nullable()->default('');                //ハイフンありの電話番号を暗号化した番号6（画面表示用）
            $table->string('Tel7')->nullable()->default('');                //ハイフンありの電話番号を暗号化した番号7（画面表示用）
            $table->string('Tel8')->nullable()->default('');                //ハイフンありの電話番号を暗号化した番号8（画面表示用）
            $table->string('Tel1Num')->nullable()->default('');             //ハイフン無しの電話番号を暗号化した番号1（検索用）
            $table->string('Tel2Num')->nullable()->default('');             //ハイフン無しの電話番号を暗号化した番号2（検索用）
            $table->string('Tel3Num')->nullable()->default('');             //ハイフン無しの電話番号を暗号化した番号3（検索用）
            $table->string('Tel4Num')->nullable()->default('');             //ハイフン無しの電話番号を暗号化した番号4（検索用）
            $table->string('Tel5Num')->nullable()->default('');             //ハイフン無しの電話番号を暗号化した番号5（検索用）
            $table->string('Tel6Num')->nullable()->default('');             //ハイフン無しの電話番号を暗号化した番号6（検索用）
            $table->string('Tel7Num')->nullable()->default('');             //ハイフン無しの電話番号を暗号化した番号7（検索用）
            $table->string('Tel8Num')->nullable()->default('');             //ハイフン無しの電話番号を暗号化した番号8（検索用）
            $table->string('Tel1Last4')->nullable()->default('');           //電話番号の末尾4桁を暗号化した番号1（検索用）
            $table->string('Tel2Last4')->nullable()->default('');           //電話番号の末尾4桁を暗号化した番号2（検索用）
            $table->string('Tel3Last4')->nullable()->default('');           //電話番号の末尾4桁を暗号化した番号3（検索用）
            $table->string('Tel4Last4')->nullable()->default('');           //電話番号の末尾4桁を暗号化した番号4（検索用）
            $table->string('Tel5Last4')->nullable()->default('');           //電話番号の末尾4桁を暗号化した番号5（検索用）
            $table->string('Tel6Last4')->nullable()->default('');           //電話番号の末尾4桁を暗号化した番号6（検索用）
            $table->string('Tel7Last4')->nullable()->default('');           //電話番号の末尾4桁を暗号化した番号7（検索用）
            $table->string('Tel8Last4')->nullable()->default('');           //電話番号の末尾4桁を暗号化した番号8（検索用）
            $table->string('email')->unique();                        //メールアドレス
            $table->string('Kubun', 10)->nullable()->default('null');       //区分
            $table->date('LastCommingDate')->nullable();                    //最終来院日
            $table->date('NextDate')->nullable();                           //次回来院予定日
            $table->string('NextReason', 200)->nullable()->default(''); //次回来院理由
            $table->boolean('CustValid')->nullable()->default(true);        //有効 = True / 無効 = False　無効時は表示、検索が行われない
            $table->boolean('Replace')->nullable()->default(false);         //一括更新中に追加されたデータはTrue。　一括更新が終了したらFalse
            $table->string('EditID')->nullable();                           //個別で更新された際に送られてきたEditIDを保管。　重複してUpdateさせないため
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pckcustlists');
    }
};
