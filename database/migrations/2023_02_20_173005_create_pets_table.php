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
        Schema::create('pckpetlists', function (Blueprint $table) {
            $table->id();
            $table->string('ClinicID', 10);                                         //病院ID　ゼロパディング数字5桁（00000)
            $table->string('CustNo', 10);                                           //顧客番号
            $table->string('KarteNo', 10);                                          //カルテ番号　XXXXX-XXもしくはXXXXXX-XX形式
            $table->string('PetNo', 3);                                   //ペットの枝番　01～99　注：現状２桁だが３桁を確保
            $table->string('PetName', 100);                                         //ペット名
            $table->string('PetName_furigana', 100)->nullable()->default('');       //ペット名のふりがな
            $table->string('PetKind', 15)->nullable();                              //動物種類　犬、猫、うさぎ　など
            $table->string('PetBreed', 80)->nullable();                             //動物品種
            $table->date('PetBirthday')->nullable();                                //生年月日　yyyy-mm-dd、yyyy-mm-dd、yyyy　など
            $table->tinyInteger('PetDeathType')->nullable()->default(0);            //死亡情報　0=生存、1=死亡、2=失踪、3=譲渡
            $table->date('PetDeathDate')->nullable();                               //死亡日　Nullもしくは日付形式yyyy-mm-dd
            $table->string('PetSex', 10)->nullable()->default('M');                 //性別：　M、F、C、S、不明
            $table->boolean('PetValid')->nullable()->default(true);                 //有効 = True / 無効 = False　無効時は表示、検索が行われない
            $table->string('VacInfo', 500)->nullable()->default('');                //予防などの情報
            $table->string('Memo', 500)->nullable()->default('');                   //メモ情報
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pckpetlists');
    }
};
