<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin')->delete();
        DB::table('admin')->insert([
            'name' => "管理者",
            'email' => 'proLove0212@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
