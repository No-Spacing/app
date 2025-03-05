<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    
        $faker = Faker::create();
        
        DB::table('admins')->insert([
            'username' => 'admin@email.com',
            'password' => hash::make('Admin123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('video_tables')->insert([
            'video_url' => '/assets/VideoFiles/Sunflower.mp4'
        ]);
        DB::table('video_tables')->insert([
            'video_url' => '/assets/VideoFiles/Chemical.mp4'
        ]);
        
        foreach (range(1, 20) as $index)  {
            DB::table('products')->insert([
                'name' => $faker->city,
                'category' => 'Category '. $faker->numberBetween($min = 1, $max = 4),
                'description'=> $faker->paragraph($nb = 1),
                'date_time' => date("Y-m-d\TH:i"),
            ]);
        }

    }
}
