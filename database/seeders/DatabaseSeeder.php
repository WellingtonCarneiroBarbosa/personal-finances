<?php

namespace Database\Seeders;

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
        if (config('app.env') === 'local') {
            \App\Models\User::factory()
                ->count(1)
                ->create([
                    'name'     => 'User Example',
                    'email'    => 'user@example.com',
                    'password' => Hash::make('password'),
                ]);
        }
    }
}
