<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        return $this->call([
            TargetAudienceSeeder::class,
            TopicSeeder::class,
            UserSeeder::class,
        ]);
    }
}
