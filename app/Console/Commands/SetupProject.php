<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:project';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up the project with all necessary components';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up the project...');

        // Run migrations
        $this->info('Running migrations...');
        $this->call('migrate:fresh');

        // Set up storage directories
        $this->info('Setting up storage directories...');
        $this->call('setup:storage-directories');

        // Copy sample images
        $this->info('Copying sample images...');
        $this->call('setup:sample-images');

        // Run seeders
        $this->info('Seeding the database...');
        $this->call('db:seed');

        $this->info('Project setup completed successfully!');
        $this->info('You can now access the admin panel at /admin/login');
        $this->info('Default admin credentials:');
        $this->info('Email: admin@example.com');
        $this->info('Password: password');
    }
}
