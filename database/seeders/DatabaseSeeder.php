<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $now = now();

        DB::table('listing_types')->insert([
            ['id' => 1, 'type_name' => 'internship', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'type_name' => 'job', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'type_name' => 'freelance', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
