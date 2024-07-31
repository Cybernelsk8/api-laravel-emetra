<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TypeSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'test',
            'email' => 'test@example.com',
            'password' => bcrypt('123456789'),
            'type_id' => 1,
        ]);

        User::factory(10)->create();

        $this->call([
            SubjectSeeder::class,
            GradeSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
