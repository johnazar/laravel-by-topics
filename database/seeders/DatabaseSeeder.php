<?php

namespace Database\Seeders;

use App\Models\Channel;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'password'=>Hash::make('password')
        ]);
        \App\Models\Channel::factory(20)->create();
        \App\Models\Post::factory(20)->create();
    }
}
