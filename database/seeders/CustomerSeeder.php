<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use Str;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $cust_data = [
            [
                "ClinicID" => "24083",
                "CustNo" => "00001",
                "CustFamilyName" => "新宿",
                "CustName" => "一郎",
                "CustFamilyName_furigana" => "しんじゅく",
                "CustName_furigana" => "いちろう",
                "Address" => "新宿区北新宿12-12",
                "MailAddress" => "customer1@gmail.com",
                "Tel" => "03-0000-0001/090-0000-0002",
                "Kubun" => "",
                "LastCommingDate" => "2021/02/04",
                "NextDate" => "",
                "NextReason" => ""
            ],
            [
                "ClinicID" => "24083",
                "CustNo" => "00002",
                "CustFamilyName" => "新宿",
                "CustName" => "一郎",
                "CustFamilyName_furigana" => "しんじゅく",
                "CustName_furigana" => "いちろう",
                "Address" => "新宿区北新宿12-12",
                "MailAddress" => "customer2@gmail.com",
                "Tel" => "03-0000-0001/090-0000-0002",
                "Kubun" => "",
                "LastCommingDate" => "2021/02/04",
                "NextDate" => "",
                "NextReason" => ""
            ],
            [
                "ClinicID" => "24083",
                "CustNo" => "00003",
                "CustFamilyName" => "新宿",
                "CustName" => "一郎",
                "CustFamilyName_furigana" => "しんじゅく",
                "CustName_furigana" => "いちろう",
                "Address" => "新宿区北新宿12-12",
                "MailAddress" => "customer3@gmail.com",
                "Tel" => "03-0000-0001/090-0000-0002",
                "Kubun" => "",
                "LastCommingDate" => "2021/02/04",
                "NextDate" => "",
                "NextReason" => ""
            ],
            [
                "ClinicID" => "30279",
                "CustNo" => "00004",
                "CustFamilyName" => "新宿",
                "CustName" => "一郎",
                "CustFamilyName_furigana" => "しんじゅく",
                "CustName_furigana" => "いちろう",
                "Address" => "新宿区北新宿12-12",
                "MailAddress" => "customer4@gmail.com",
                "Tel" => "03-0000-0001/090-0000-0002",
                "Kubun" => "",
                "LastCommingDate" => "2021/02/04",
                "NextDate" => "",
                "NextReason" => ""
            ],
            [
                "ClinicID" => "30279",
                "CustNo" => "00005",
                "CustFamilyName" => "新宿",
                "CustName" => "一郎",
                "CustFamilyName_furigana" => "しんじゅく",
                "CustName_furigana" => "いちろう",
                "Address" => "新宿区北新宿12-12",
                "MailAddress" => "customer5@gmail.com",
                "Tel" => "03-0000-0001/090-0000-0002",
                "Kubun" => "",
                "LastCommingDate" => "2021/02/04",
                "NextDate" => "",
                "NextReason" => ""
            ],
            [
                "ClinicID" => "30279",
                "CustNo" => "00006",
                "CustFamilyName" => "新宿",
                "CustName" => "一郎",
                "CustFamilyName_furigana" => "しんじゅく",
                "CustName_furigana" => "いちろう",
                "Address" => "新宿区北新宿12-12",
                "MailAddress" => "customer6@gmail.com",
                "Tel" => "03-0000-0001/090-0000-0002",
                "Kubun" => "",
                "LastCommingDate" => "2021/02/04",
                "NextDate" => "",
                "NextReason" => ""
            ]
        ];

        Customer::truncate();

        foreach ($cust_data as $key => $item) {
            # code...
            $customer = new Customer;
            $customer->ClinicID = $item["ClinicID"];
            $customer->CustNo = $item["CustNo"];
            $customer->CustFamilyName = $item["CustFamilyName"];
            $customer->CustName = $item["CustName"];
            $customer->CustFamilyName_furigana = $item["CustFamilyName_furigana"];
            $customer->CustName_furigana = $item["CustName_furigana"];
            $customer->Address = $item["Address"];

            $tels = explode("/", $item["Tel"]);
            foreach ($tels as $tel) {
                $index = array_search($tel, array_keys($tels));
                if($index == 0){
                    $customer->Tel1 = $tel;
                    $customer->Tel1Num = Str::replace('-', '', $tel);
                    $customer->Tel1Last4 = explode("-", $tel)[2];
                }
                if($index == 1){
                    $customer->Tel2 = $tel;
                    $customer->Tel2Num = Str::replace('-', '', $tel);
                    $customer->Tel2Last4 = explode("-", $tel)[2];
                }
                if($index == 2){
                    $customer->Tel3 = $tel;
                    $customer->Tel3Num = Str::replace('-', '', $tel);
                    $customer->Tel3Last4 = explode("-", $tel)[2];
                }
                if($index == 3){
                    $customer->Tel4 = $tel;
                    $customer->Tel4Num = Str::replace('-', '', $tel);
                    $customer->Tel4Last4 = explode("-", $tel)[2];
                }
                if($index == 4){
                    $customer->Tel5 = $tel;
                    $customer->Tel5Num = Str::replace('-', '', $tel);
                    $customer->Tel5Last4 = explode("-", $tel)[2];
                }
                if($index == 5){
                    $customer->Tel6 = $tel;
                    $customer->Tel6Num = Str::replace('-', '', $tel);
                    $customer->Tel6Last4 = explode("-", $tel)[2];
                }
                if($index == 6){
                    $customer->Tel7 = $tel;
                    $customer->Tel7Num = Str::replace('-', '', $tel);
                    $customer->Tel7Last4 = explode("-", $tel)[2];
                }
                if($index == 7){
                    $customer->Tel8 = $tel;
                    $customer->Tel8Num = Str::replace('-', '', $tel);
                    $customer->Tel8Last4 = explode("-", $tel)[2];
                }

            }

            $customer->MailAddress = $item['MailAddress'];
            $customer->Kubun = $item['Kubun'];
            $customer->LastCommingDate = $item['LastCommingDate'];
            $customer->NextDate = $item['NextDate'];
            $customer->NextReason = $item['NextReason'];
            $customer->save();

        }
    }
}
