<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Reception;

class ReceptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $reception_data = [
            [
                "CustNo" => "00001",
                "ClinicID" => "24083",
                "VisitDate" => "2023/2/24",
                "VisitOrderIndex" => 0,
                "VisitReason" => "８種混合ワクチン",
                "EntryTime" => "2023/02/24 09:33:00",
                "TakeTime" => 15,
                "Status" => 1,
                "NewPatientNo" => "01-0001",
            ],
            [
                "CustNo" => "00001",
                "ClinicID" => "24083",
                "VisitDate" => "2023/2/27",
                "VisitOrderIndex" => 3,
                "VisitReason" => "８種混合ワクチン",
                "EntryTime" => "2023/02/24 09:33:00",
                "TakeTime" => 15,
                "Status" => 1,
                "NewPatientNo" => "01-0001",
            ],
            [
                "CustNo" => "00002",
                "ClinicID" => "37843",
                "VisitDate" => "2023/2/27",
                "VisitOrderIndex" => 1,
                "VisitReason" => "８種混合ワクチン",
                "EntryTime" => "2023/02/24 09:33:00",
                "TakeTime" => 15,
                "Status" => 1,
                "NewPatientNo" => "01-0001",
            ],
            [
                "CustNo" => "00002",
                "ClinicID" => "37843",
                "VisitDate" => "2023/2/27",
                "VisitOrderIndex" => 3,
                "VisitReason" => "８種混合ワクチン",
                "EntryTime" => "2023/02/24 09:33:00",
                "TakeTime" => 15,
                "Status" => 1,
                "NewPatientNo" => "01-0001",
            ],
            [
                "CustNo" => "00003",
                "ClinicID" => "30279",
                "VisitDate" => "2023/2/24",
                "VisitOrderIndex" => 0,
                "VisitReason" => "８種混合ワクチン",
                "EntryTime" => "2023/02/24 09:33:00",
                "TakeTime" => 15,
                "Status" => 1,
                "NewPatientNo" => "01-0001",
            ],

        ];

        Reception::truncate();

        foreach ($reception_data as $key => $item) {
            # code...
            $reception = new Reception;
            $reception->CustNo = $item["CustNo"];
            $reception->ClinicID = $item["ClinicID"];
            $reception->VisitDate = $item["VisitDate"];
            $reception->VisitOrderIndex = $item["VisitOrderIndex"];
            $reception->VisitReason = $item["VisitReason"];
            $reception->EntryTime = $item["EntryTime"];
            $reception->TakeTime = $item["TakeTime"];
            $reception->Status = $item["Status"];
            $reception->NewPatientNo = $item["NewPatientNo"];
            $reception->save();

        }
    }
}
