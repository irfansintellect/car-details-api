<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seting = new Setting;
        $seting->company_name = "Smart Intellect";
        $seting->logo_white = "";
        $seting->logo_black = "";
        $seting->save();
    }
}
