<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\VenueAdmin\Models\MuhurthamDates;
use Carbon\Carbon;

class MuhurthamDateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = public_path('import_excel/muhurtham_dates_25.csv'); // CSV file path
        $handle = fopen($filePath, "r");

        $i = 0;
        while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if($i > 0){
                MuhurthamDates::firstOrCreate([
                    'muhurtham_date' => Carbon::createFromFormat('d-m-Y', $row[0])->format('Y-m-d'),
                    'muhurtham_year' => Carbon::createFromFormat('d-m-Y', $row[0])->format('Y'),
                    'muhurtham_month' => Carbon::createFromFormat('d-m-Y', $row[0])->format('m'),
                    'muhurtham_type' => $row[1],
                ]);
            }
            $i++;
        }

        fclose($handle);
    }
}
