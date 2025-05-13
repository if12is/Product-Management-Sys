<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default product images directory if it doesn't exist
        if (!Storage::disk('public')->exists('products')) {
            Storage::disk('public')->makeDirectory('products');
        }

        // Check if there are any images in the storage public products folder
        $hasStorageImages = count(Storage::disk('public')->files('products')) > 0;

        // If no images in storage, copy images from public/products folder if they exist
        if (!$hasStorageImages) {
            $publicProductsPath = public_path('products');

            if (file_exists($publicProductsPath) && is_dir($publicProductsPath)) {
                $publicProductImages = glob($publicProductsPath . '/*.*');

                foreach ($publicProductImages as $image) {
                    $filename = basename($image);
                    $imageContent = file_get_contents($image);
                    Storage::disk('public')->put('products/' . $filename, $imageContent);
                }

                $this->command->info('Product images copied from public folder to storage.');
            } else {
                // Create a default product image if no public folder exists
                if (!Storage::disk('public')->exists('products/default-product.png')) {
                    // Try to get default image from public folder
                    $defaultImage = file_get_contents(base_path('public/default-product.png'));
                    if ($defaultImage) {
                        Storage::disk('public')->put('products/default-product.png', $defaultImage);
                    } else {
                        // Fallback: Create a simple image if the file doesn't exist
                        $img = imagecreatetruecolor(100, 100);
                        $bgColor = imagecolorallocate($img, 200, 200, 200);
                        imagefill($img, 0, 0, $bgColor);

                        // Create in-memory data
                        ob_start();
                        imagejpeg($img);
                        $imageData = ob_get_clean();
                        imagedestroy($img);

                        Storage::disk('public')->put('products/default-product.png', $imageData);
                    }
                    $this->command->info('Default product image created.');
                }
            }
        }

        // Create 50 random products
        Product::factory()->count(50)->create();

        // Create 30 active products
        Product::factory()->count(30)->active()->create();

        // Create 20 inactive products
        Product::factory()->count(20)->inactive()->create();

        $this->command->info('100 products created successfully.');
    }
}
