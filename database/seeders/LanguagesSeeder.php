<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\LanguageLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LanguageLevel::create(['name' => 'No']);
        LanguageLevel::create(['name' => 'Basic']);
        LanguageLevel::create(['name' => 'Communicative']);
        LanguageLevel::create(['name' => 'Advanced']);
        $languages = [
            [
                'name'=> 'English',
            ],
            [
                'name'=> 'Polish',
            ]
        ];

        foreach ($languages as $language) {
           Language::create($language);
        }
    }
}
