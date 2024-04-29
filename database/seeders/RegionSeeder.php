<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $jsonPath = database_path('seeders/json/region_kato.json');
        if (File::exists($jsonPath)) {
            $jsonData = File::get($jsonPath);
            \Log::info("Raw JSON data:", [$jsonData]);  // Добавьте эту строку для логирования

            $regions = json_decode($jsonData, true);
            if (is_null($regions)) {
                \Log::error('JSON decoding error:', [
                    'error' => json_last_error_msg(),
                    'path' => $jsonPath
                ]);
                return;
            }

            foreach ($regions as $region) {
                DB::table('regions')->insert([
                    'te' => $region['te'],
                    'ab' => $region['ab'],
                    'cd' => $region['cd'],
                    'ef' => $region['ef'],
                    'hij' => $region['hij'],
                    'k' => $region['k'],
                    'kaz_name' => $region['kaz_name'],
                    'rus_name' => $region['rus_name'],
                    'nn' => $region['nn'],
                ]);
            }
        } else {
            echo "JSON file does not exist.";
        }
    }
}
