<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crée 10 utilisateurs
        $users = User::factory(10)->create();

        // Pour chaque utilisateur, crée 5 posts avec des données variées
        $users->each(function ($user) {
            Post::factory(5)->create([
                'user_id' => $user->id, // Assigne le user_id au post
            ]);
        });

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
