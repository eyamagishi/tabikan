<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        Hotel::create([
            'name' => '旅館はなやま',
            'address' => '京都府京都市中京区',
            'description' => '風情ある温泉旅館です。',
        ]);
    }
}
