<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set up the admin dashboard by running migrations and seeding the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up admin dashboard...');

        $this->info('Running migrations...');
        Artisan::call('migrate', ['--force' => true]);
        $this->info(Artisan::output());

        $this->info('Seeding database...');
        Artisan::call('db:seed', ['--class' => 'AdminUserSeeder', '--force' => true]);
        $this->info(Artisan::output());

        $this->info('Admin dashboard setup complete!');
        $this->info('You can now log in with:');
        $this->info('Email: admin@example.com');
        $this->info('Password: password');
    }
}
