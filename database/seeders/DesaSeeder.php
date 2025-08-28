<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csv = new CsvtoArray();
        $resourceFiles = File::allFiles(__DIR__ . '/csv/villages');
        $now = Carbon::now()->format('Y-m-d H:i:s');

        foreach ($resourceFiles as $file) {
            $header = ['id', 'kecamatan_id', 'nama', 'lat', 'long'];
            $data = $csv->csv_to_array($file->getRealPath(), $header, ',');

            if (!$data) {
                continue;
            }

            $data = array_map(function ($arr) use ($now) {
                return [
                    'id' => $arr['id'],
                    'kecamatan_id' => $arr['kecamatan_id'],
                    'nama' => $arr['nama'],
                    'coordinate' => json_encode(['lat' => $arr['lat'], 'long' => $arr['long']]),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }, $data);

            $collection = collect($data);
            foreach ($collection->chunk(50) as $chunk) {
                DB::connection('mysql')->table('desa')->insert($chunk->toArray());
            }
        }
    }
}
