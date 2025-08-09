<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Hotel;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run(): void
    {
        $hotel = Hotel::first();

        Room::create([
            'hotel_id' => $hotel->id,
            'name' => '和室8畳',
            'capacity' => 4,
            'price' => 12000,
        ]);
    }
}
