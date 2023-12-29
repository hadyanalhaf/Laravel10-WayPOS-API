<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DatabaseMigrateInOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wayposapi:migrate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run migration in ordered steps';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Ordered migration steps
        $migrations = [
            'database/migrations/2023_07_22_053534_create_categories_table.php',
            'database/migrations/2023_07_22_055520_create_units_table.php',
            'database/migrations/2023_07_22_051426_create_partners_table.php',
            'database/migrations/2023_07_22_051945_create_branches_table.php',
            'database/migrations/2014_10_12_000000_create_users_table.php',
            'database/migrations/2023_07_22_060817_create_materials_table.php',
            'database/migrations/2023_07_22_055622_create_products_table.php',
            'database/migrations/2023_07_22_061644_branch_categories_table.php',
            'database/migrations/2023_07_22_062130_branch_products_table.php',
            'database/migrations/2023_07_22_064431_create_unit_conversions_table.php',
            'database/migrations/2023_07_22_065955_create_material_stock_logs_table.php',
            'database/migrations/2023_07_22_071601_create_material_sales_table.php',
            'database/migrations/2023_07_22_071954_create_material_sales_details_table.php',
            'database/migrations/2023_07_22_072718_create_sales_table.php',
            'database/migrations/2023_07_22_072919_create_sales_details_table.php',
            'database/migrations/2023_07_22_080852_create_balances_table.php',
            'database/migrations/2014_10_12_100000_create_password_resets_table.php', // Password reset token
            'database/migrations/2019_08_19_000000_create_failed_jobs_table.php', // Jobs
            'database/migrations/2019_12_14_000001_create_personal_access_tokens_table.php', // Access token sanctum
            'database/migrations/2018_08_08_100000_create_telescope_entries_table.php', // Telescope
        ];

        // Reset Database
        $this->call('db:wipe', ['--force' => true]);

        // Run Ordered Migrations
        foreach ($migrations as $migration) {
            $this->call('migrate', [
                '--path' => $migration,
            ]);
        }

        // Seed Database
        $this->call('db:seed');

        // Return
        return Command::SUCCESS;
    }
}
