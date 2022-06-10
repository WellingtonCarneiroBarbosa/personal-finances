<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email'    => 'admin@admin.com',
                'password' => \Hash::make('admin'),
            ]);

        $this->call(ExpenseSeeder::class);
        $this->call(ExpenseCategorySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WorkspaceSeeder::class);
        $this->call(WorkspaceUserSeeder::class);
    }
}
