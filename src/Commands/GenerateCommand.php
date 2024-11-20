<?php

declare(strict_types=1);

namespace GrabauDev\SchemaObjects\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\Http;

class GenerateCommand extends Command implements PromptsForMissingInput
{
    protected $signature = 'schema-objects:generate {url}';
    protected $description = 'Generate schema objects';

    public function handle(): void
    {
        /** @var string $url */
        $url = $this->argument('url');

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            $this->error('Invalid URL provided. Please enter a valid URL starting with http:// or https://.');
            return;
        }

        $this->line('Running introspection on: ' . $url);

        $schema = Http::post($url, [
            'query' => '
                query {
                __schema {
                        types {
                            name
                            fields {
                                name
                                type {
                                    name
                                }
                            }
                        }
                    }
                }
            ',
        ]);
    }

    /**
     * @return array<string, array<string>>
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'url' => ['Which schema url do you want to inspect?', 'https://'],
        ];
    }
}
