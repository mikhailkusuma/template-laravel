<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = new CsvtoArray();
        $file = __DIR__ . '/csv/provinces.csv';
        $header = ['id', 'nama', 'lat', 'long'];
        $data = $csv->csv_to_array($file, $header, ',');

        $now = Carbon::now()->format('Y-m-d H:i:s');

        $data = array_map(function ($arr) use ($now) {
            return [
                'id' => $arr['id'],
                'nama' => $arr['nama'],
                'coordinate' => json_encode(['lat' => $arr['lat'], 'long' => $arr['long']]),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $data);

        DB::connection('mysql')->table('provinsi')->insert($data);
    }
}
