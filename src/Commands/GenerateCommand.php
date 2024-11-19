<?php

declare(strict_types=1);

namespace GrabauDev\SchemaObjects\Commands;

use Illuminate\Console\Command;

class GenerateCommand extends Command {
    protected $signature = 'schema-objects:generate';
    protected $description = 'Generate schema objects';

    public function handle(): void {
        $this->line('Generating schema objects...');
    }
}