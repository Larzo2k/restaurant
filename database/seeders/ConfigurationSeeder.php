<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Configuration::create([
            'id' => Str::uuid()->toString(),
            'name' => 'Super Kjaras JUAN XXIII',
            'logotipo' => '',
            'favicon' => '',
            'image_login' => '',
        ]);
    }
}