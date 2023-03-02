<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Pet;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pet_data = [
            [
                "CustNo" => "00001",
                "ClinicID" => "24083",
                "KarteNo" => "00001-01",
                "PetNo" => "01",
                "PetName" => "小太郎",
                "PetName_furigana" => "こたろう",
                "PetKind" => "犬",
                "PetBreed" => "柴犬",
                "PetBirthday" => "2019/01/01",
                "PetDeathType" => 0,
                "PetSex" => "M",
                "VacInfo" => "８種混合ワクチン	2021/08/21	2021/08/21,狂犬病	2021/04/16	",
                "Memo" => ""
            ],

        ];

        Pet::truncate();

        foreach ($pet_data as $key => $item) {
            # code...
            $pet = new Pet;
            $pet->CustNo = $item["CustNo"];
            $pet->ClinicID = $item["ClinicID"];
            $pet->KarteNo = $item["KarteNo"];
            $pet->PetNo = $item["PetNo"];
            $pet->PetName = $item["PetName"];
            $pet->PetName_furigana = $item["PetName_furigana"];
            $pet->PetKind = $item["PetKind"];
            $pet->PetBreed = $item["PetBreed"];
            $pet->PetBirthday = $item["PetBirthday"];
            $pet->PetDeathType = $item["PetDeathType"];
            $pet->PetSex = $item["PetSex"];
            $pet->VacInfo = $item["VacInfo"];
            $pet->Memo = $item["Memo"];
            $pet->save();

        }
    }
}
