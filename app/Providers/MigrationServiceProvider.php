<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class MigrationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMigrations();
    }

    private function registerMigrations(): void
    {
        $this->getBaseMigrationsPaths()->each(function ($basePath) {
            $this->getMigrationsPathsChild($basePath)->each(function ($path) use ($basePath) {
                $this->loadMigrationsFrom($basePath . DIRECTORY_SEPARATOR . $path);
            });
        });
    }

    protected function getBaseMigrationsPaths(): Collection
    {
        return collect(config('custom_migrations.base_paths'))->map(function ($baseMigrationPath) {
            return base_path($baseMigrationPath);
        });
    }

    protected function getMigrationsPathsChild(string $basePath): Collection
    {
        return collect(scandir($basePath))->filter(function ($path) {
            return !in_array($path, config('custom_migrations.ignore_paths'));
        });
    }
}
