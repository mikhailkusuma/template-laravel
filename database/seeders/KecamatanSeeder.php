<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = new CsvtoArray();
        $file = __DIR__ . '/csv/districts.csv';
        $header = ['id', 'kabupaten_id', 'nama', 'lat', 'long'];
        $data = $csv->csv_to_array($file, $header, ',');

        $now = Carbon::now()->format('Y-m-d H:i:s');

        $data = array_map(function ($arr) use ($now) {
            return [
                'id' => $arr['id'],
                'kabupaten_id' => $arr['kabupaten_id'],
                'nama' => $arr['nama'],
                'coordinate' => json_encode(['lat' => $arr['lat'], 'long' => $arr['long']]),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $data);

        $collection = collect($data);
        foreach ($collection->chunk(50) as $chunk) {
            DB::connection('mysql')->table('kecamatan')->insert($chunk->toArray());
        }
    }
}
