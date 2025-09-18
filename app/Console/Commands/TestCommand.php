<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Prism\Prism\Prism;
use Prism\Prism\Enums\Provider;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {  
        $response = Prism::text()->using(Provider::Gemini, 'gemini-2.0-flash')->withPrompt('How would you explain the difference between a cat and a dog?')->asText();
        $this->info('Response: ' . $response);
    }
}
