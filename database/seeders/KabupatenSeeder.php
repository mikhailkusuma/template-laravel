<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Csv = new CsvtoArray();
        $file = __DIR__ . '/csv/cities.csv';
        $header = ['id', 'provinsi_id', 'nama', 'lat', 'long'];
        $data = $Csv->csv_to_array($file, $header, ',');

        $now = Carbon::now()->format('Y-m-d H:i:s'); // Timestamp tetap untuk semua data

        $data = array_map(function ($arr) use ($now) {
            return [
                'id' => $arr['id'],
                'provinsi_id' => $arr['provinsi_id'],
                'nama' => $arr['nama'],
                'coordinate' => json_encode(['lat' => $arr['lat'], 'long' => $arr['long']]),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $data);

        $collection = collect($data);
        foreach ($collection->chunk(50) as $chunk) {
            DB::connection('mysql')->table('kabupaten')->insert($chunk->toArray());
        }
    }
}
