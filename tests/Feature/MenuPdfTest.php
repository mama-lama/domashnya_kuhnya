<?php

namespace Tests\Feature;

use App\Models\MenuItem;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuPdfTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_can_trigger_menu_pdf_generation(): void
    {
        $admin = User::factory()->create();

        $response = $this
            ->actingAs($admin)
            ->post(route('admin.menu.pdf'));

        $response->assertRedirect();
        $response->assertSessionHas('success');
    }

    public function test_artisan_command_generates_menu_pdf(): void
    {
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

    public function test_guest_cannot_generate_menu_pdf(): void
    {
        $this->post(route('admin.menu.pdf'))
            ->assertRedirect(route('login'));
    }
}
