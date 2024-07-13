<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Candidate;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([LanguagesSeeder::class]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin1@admin.com',
        ]);

        Candidate::factory()->count(50)->create();
    }
}
