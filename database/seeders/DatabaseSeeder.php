<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// <--- GANTI YANG INI
use App\Models\Post;
use App\Models\Category;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // User::create([
        //     'name' => 'tes',
        //     'email' => 'user@example.com',
        //     'password' => bcrypt('123')
        // ]);
        //  User::create([
        //     'name' => 'Denji',
        //     'email' => 'usdfsr@example.com',
        //     'password' => bcrypt('123')
        // ]);

        User::factory(3)->create();


         Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);
            Category::create([  
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);

        Post::factory(20)->create();
    }
}
