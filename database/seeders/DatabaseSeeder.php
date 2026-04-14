<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        // User::factory(10)->create();

        $admin =  User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ]);
        User::factory()->create([
            'name' => 'eslam',
            'email' => 'eslam@gmail.com'
        ]);
        Post::factory(50)->create([
            'user_id' => $admin->id,
        ]);
    }
}
