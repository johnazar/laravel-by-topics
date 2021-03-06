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
            'email'=>'test@test.com',
            'password'=>Hash::make('Pass$word')
        ]);
        \App\Models\Channel::factory(10)->create();
        \App\Models\Post::factory(10)->create();
        \App\Models\File::factory(10)->create();
    }
}
