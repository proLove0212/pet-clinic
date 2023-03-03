<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ReceptionSetting;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        $user_data = [
            [
                "PeaksUserNo" => "002408",
                "ClinicID" => "24083",
                "ClinicName" => "Clinic 1",
                "TelNo" => "03-821-9031",
                "TelNum" => "038219031",
                "MailAddress" => "kaneda804@gmail.com",
                "Password" => Hash::make("password"),
                "PasswordExpiry" => Carbon::now()->addDays(3),
                "Memo" => ""
            ],
            [
                "PeaksUserNo" => "003027",
                "ClinicID" => "30279",
                "ClinicName" => "Clinic 2",
                "TelNo" => "03-534-9031",
                "TelNum" => "035349031",
                "MailAddress" => "ohno521@gmail.com",
                "Password" => Hash::make("password"),
                "PasswordExpiry" => Carbon::now()->addDays(3),
                "Memo" => ""
            ],
            [
                "PeaksUserNo" => "003784",
                "ClinicID" => "37843",
                "ClinicName" => "Clinic 3",
                "TelNo" => "03-754-9031",
                "TelNum" => "037549031",
                "MailAddress" => "blight1115.dev@gmail.com",
                "Password" => Hash::make("password"),
                "PasswordExpiry" => Carbon::now()->addDays(3),
                "Memo" => ""
            ]

        ];

        User::truncate();

        foreach ($user_data as $key => $item) {
            # code...
            $user = new User;
            $user->PeaksUserNo = $item["PeaksUserNo"];
            $user->ClinicID = $item["ClinicID"];
            $user->ClinicName = $item["ClinicName"];
            $user->TelNo = $item["TelNo"];
            $user->TelNum = $item["TelNum"];
            $user->MailAddress = $item["MailAddress"];
            $user->Password = $item["Password"];
            $user->PasswordExpiry = $item["PasswordExpiry"];
            $user->Memo = $item["Memo"];
            $user->save();

            $rcp_setting = new ReceptionSetting;
            $rcp_setting->PeaksUserNo = $item["PeaksUserNo"];
            $rcp_setting->ClinicID = $item["ClinicID"];
            $rcp_setting->ClinicName = $item["ClinicName"];
            $rcp_setting->Time1EnableDate = "2023/03/03";
            $rcp_setting->RunningColumn1 = 1;
            $rcp_setting->StartTime1 = "09:00";
            $rcp_setting->EndTime1 = "12:00";
            $rcp_setting->Time2EnableDate = "2023/03/03";
            $rcp_setting->RunningColumn2 = 1;
            $rcp_setting->StartTime2 = "15:00";
            $rcp_setting->EndTime2 = "17:00";
            $rcp_setting->save();
        }
    }
}
