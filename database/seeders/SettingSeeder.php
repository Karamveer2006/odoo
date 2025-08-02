<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::create(['key' => 'max_visible_radius_km', 'value' => '5']);
        Setting::create(['key' => 'auto_hide_flag_threshold', 'value' => '3']);
    }
}
