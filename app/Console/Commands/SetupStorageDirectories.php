<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SetupStorageDirectories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:storage-directories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create storage directories for uploaded files';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $directories = [
            'public/about-us',
            'public/services',
            'public/contact',
            'public/team',
        ];

        foreach ($directories as $directory) {
            $path = storage_path('app/' . $directory);

            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
                $this->info("Created directory: {$path}");
            } else {
                $this->comment("Directory already exists: {$path}");
            }
        }

        $this->info('Storage directories created successfully.');

        // Create symbolic link if it doesn't exist
        if (!file_exists(public_path('storage'))) {
            $this->call('storage:link');
        }
    }
}
