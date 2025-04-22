<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Project;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create user Zaki
        $zaki = User::factory()->create([
            'name' => 'zaki',
            'email' => 'zaki@example.com',
        ]);

        // Give Zaki 2 clients
        Client::factory(2)->create([
            'freelancer_id' => $zaki->id,
        ]);

        // Create user Haziq
        $haziq = User::factory()->create([
            'name' => 'haziq',
            'email' => 'haziq@example.com',
        ]);

        // Give Haziq 5 clients
        Client::factory(5)->create([
            'freelancer_id' => $haziq->id,
        ]);


        $this->call([UserSeeder::class, ClientSeeder::class, ProjectSeeder::class]);
    }
}
