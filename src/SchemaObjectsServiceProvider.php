<?php

declare(strict_types=1);

namespace GrabauDev\SchemaObjects;

use GrabauDev\SchemaObjects\Commands\GenerateCommand;
use Illuminate\Support\ServiceProvider;

class SchemaObjectsServiceProvider extends ServiceProvider {
    public function register(): void {

    }

    public function boot(): void {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateCommand::class
            ]);
        }
    }
}