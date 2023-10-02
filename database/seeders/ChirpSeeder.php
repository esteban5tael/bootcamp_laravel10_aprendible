<?php

namespace Database\Seeders;

use App\Models\Chirp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChirpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 1; $i <= 5; $i++) {
            Chirp::create([
                'user_id' => 1,
                'message' => 'Chirp: 0' . $i,
            ]);
        }

        for ($i = 6; $i <= 10; $i++) {
            Chirp::create([
                'user_id' => 2,
                'message' => 'Chirp: 0' . $i,
            ]);
        }
    }
}
