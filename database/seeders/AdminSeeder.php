<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::truncate();

        $admin =  new Admin;
        $admin->name = "管理者";
        $admin->email = 'proLove0212@gmail.com';
        $admin->password = Hash::make('password');
        $admin->save();
    }
}
