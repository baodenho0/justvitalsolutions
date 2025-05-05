<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CopySampleImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:sample-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy sample images to storage directories';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // First, ensure the directories exist
        $this->call('setup:storage-directories');

        // Sample images mapping (source => destination)
        $sampleImages = [
            // About Us images
            public_path('img/home1.jpg') => storage_path('app/public/about-us/about-banner.jpg'),

            // Team member images
            public_path('img/team1.jpg') => storage_path('app/public/team/team1.jpg'),
            public_path('img/team2.jpg') => storage_path('app/public/team/team2.jpg'),
            public_path('img/team3.jpg') => storage_path('app/public/team/team3.jpg'),
            public_path('img/team4.jpg') => storage_path('app/public/team/team4.jpg'),

            // Services images
            public_path('img/home2.jpg') => storage_path('app/public/services/services-banner.jpg'),
            public_path('img/work1.jpg') => storage_path('app/public/services/web-dev.jpg'),
            public_path('img/work2.jpg') => storage_path('app/public/services/mobile-dev.jpg'),
            public_path('img/work3.jpg') => storage_path('app/public/services/ui-design.jpg'),
            public_path('img/work4.jpg') => storage_path('app/public/services/digital-marketing.jpg'),
            public_path('img/work5.jpg') => storage_path('app/public/services/branding.jpg'),
            public_path('img/work6.jpg') => storage_path('app/public/services/consulting.jpg'),

            // Contact images
            public_path('img/home3.jpg') => storage_path('app/public/contact/contact-banner.jpg'),
        ];

        foreach ($sampleImages as $source => $destination) {
            if (File::exists($source)) {
                File::copy($source, $destination);
                $this->info("Copied: {$source} to {$destination}");
            } else {
                $this->warn("Source file not found: {$source}");

                // Create a placeholder image if source doesn't exist
                $this->createPlaceholderImage($destination);
            }
        }

        $this->info('Sample images copied successfully.');
    }

    /**
     * Create a placeholder image if the source image doesn't exist.
     *
     * @param string $destination
     * @return void
     */
    protected function createPlaceholderImage($destination)
    {
        // Create a simple placeholder image
        $width = 800;
        $height = 600;
        $image = imagecreatetruecolor($width, $height);

        // Fill with a light gray color
        $bgColor = imagecolorallocate($image, 240, 240, 240);
        imagefill($image, 0, 0, $bgColor);

        // Add text
        $textColor = imagecolorallocate($image, 100, 100, 100);
        $text = 'Placeholder Image';
        $font = 5; // Built-in font

        // Center the text
        $textWidth = imagefontwidth($font) * strlen($text);
        $textHeight = imagefontheight($font);
        $x = ($width - $textWidth) / 2;
        $y = ($height - $textHeight) / 2;

        imagestring($image, $font, $x, $y, $text, $textColor);

        // Ensure the directory exists
        $directory = dirname($destination);
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        // Save the image
        imagejpeg($image, $destination, 90);
        imagedestroy($image);

        $this->info("Created placeholder image at: {$destination}");
    }
}
