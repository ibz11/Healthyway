<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class RecommendationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
        {
        $json = file_get_contents(database_path('seeders/recommendations.json'));
        // Decode JSON data
        $data = json_decode($json);

        // Insert data into the database
        foreach ($data as $item) {
        DB::table('recommendations')->insert([
            'fear_level' => $item->fear_level,
            'avoidance_level' => $item->avoidance_level,
            'Recommendation' => $item->Recommendation,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        }


    }
}

//php artisan db:seed --class=RecommendationsTableSeeder