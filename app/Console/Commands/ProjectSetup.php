<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProjectSetup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wayposapi:install';

    /**
     * The console This command is for setting up your waypos API project.
     *
     * @var string
     */
    protected $description = 'This command is for setting up your WayPOS API project';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Project installer title
        $this->info("=============================================");
        $this->info(" -- WAYPOS API INSTALLER --");
        $this->info("=============================================");

        // Create .env files
        $this->call('wayposapi:create-env');

        // Wait 5 seconds
        $this->info('Preparing to install...');
        sleep(5);
        $this->newLine();

        // Clearing cache
        $this->call('optimize:clear');
        sleep(1);

        // Run API Docs Generate
        $this->info('Generating API Documentation...');
        sleep(1);
        $this->call('wayposapi:docs-generate');

        // Generate key
        $this->info('Generating a key...');
        sleep(1);
        $this->call('key:generate');

        // Run migrations
        $run = true;
        $trial = 0;
        $this->info('Migrating database...');
        sleep(1);
        while ($run) {
            try {
                $trial++;
                $this->call('wayposapi:migrate');
                $run = false;
            } catch (\Throwable $e) {
                if ($trial <= 5) {
                    $this->info('Retry Migrating database...');
                } else {
                    $this->newLine();
                    $this->error($e->getMessage());
                    $this->newLine();
                    $this->comment("Try to run 'php artisan wayposapi:migrate'");
                    $run = false;
                    die;
                }
            }
        }

        // Project install success
        $this->newLine();
        $this->newLine();
        $this->info("=============================================");
        $this->info(" -- WAYPOS API INSTALLED SUCCESSFULLY --");
        $this->info("=============================================");

        // Return
        return Command::SUCCESS;
    }
}
