<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        $classes = [
            // Geo Location Indonesia
            ProvinsiSeeder::class,
            KabupatenSeeder::class,
            KecamatanSeeder::class,
            DesaSeeder::class,

            // Report
            ReportCategoriesSeeder::class,
            ReportStatusesSeeder::class,
            ReportSourcesSeeder::class,
            GovernmentsSeeder::class,

            // Dummy Report
            // QueueReportSeeder::class
        ];

        foreach ($classes as $class) $this->call($class);
    }
}
