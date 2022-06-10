<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\WorkspaceUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkspaceUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WorkspaceUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'workspace_id' => \App\Models\Workspace::factory(),
        ];
    }
}
