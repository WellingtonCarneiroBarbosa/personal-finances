<?php

namespace Database\Seeders;

use App\Models\WorkspaceUser;
use Illuminate\Database\Seeder;

class WorkspaceUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkspaceUser::factory()
            ->count(5)
            ->create();
    }
}
