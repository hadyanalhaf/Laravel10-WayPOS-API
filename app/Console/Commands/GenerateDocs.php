<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateDocs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wayposapi:docs-generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is command for generate API Documentation';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->call('l5-swagger:generate');
    }
}
