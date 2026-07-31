<?php

namespace Tests\Feature;

use App\Models\MenuItem;
use App\Models\Setting;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuPdfTest extends TestCase
{
    use RefreshDatabase;

    public function test_artisan_command_generates_menu_pdf(): void
    {
        $this->seed(CategorySeeder::class);

        Setting::create([
            'key' => 'site_title',
            'value' => 'Домашняя кухня',
            'group' => 'general',
        ]);

        MenuItem::create([
            'name' => 'Борщ',
            'description' => 'Домашний борщ со сметаной.',
            'ingredients' => 'говядина, свекла, капуста',
            'price' => 200,
            'weight' => '500 г',
            'category' => 'first',
            'image_url' => '/images/menu/borch.png',
        ]);

        $outputPath = public_path('menu.pdf');
        if (file_exists($outputPath)) {
            @unlink($outputPath);
        }

        $this->artisan('menu:generate-pdf')
            ->assertSuccessful();

        $this->assertFileExists($outputPath);
        $this->assertStringStartsWith('%PDF-', file_get_contents($outputPath));

        @unlink($outputPath);
    }
}
