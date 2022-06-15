<?php

namespace Database\Seeders;

use App\Models\Expense\Expense;
use App\Models\Expense\ExpenseCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ApplicationLocalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('app.env') === 'local') {
            $user = User::factory()
                            ->create([
                                'name'     => 'User Example',
                                'email'    => 'user@example.com',
                                'password' => Hash::make('password'),
                            ]);

            $workspace = $user->currentWorkspace;

            ExpenseCategory::factory()
                            ->for($workspace, 'workspace')
                            ->count(5)
                            ->create()
                            ->each(function ($category) use ($workspace) {
                                $category->expenses()->saveMany(Expense::factory()->for($workspace, 'workspace')->count(5)->make());
                            });
        }
    }
}
