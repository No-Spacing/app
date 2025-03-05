<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
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

        
    }
}
