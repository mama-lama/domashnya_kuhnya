<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_dish_with_new_category(): void
    {
        $this->seed(CategorySeeder::class);
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->post(route('admin.menu.store'), [
            'name' => 'Наполеон',
            'price' => 150,
            'category' => ['__new'],
            'new_category' => 'Десерты',
        ]);

        $response->assertRedirect(route('admin.menu.index'));

        $category = Category::where('name', 'Десерты')->first();
        $this->assertNotNull($category);
        $this->assertSame('deserty', $category->slug);

        $this->assertDatabaseHas('menu_items', [
            'name' => 'Наполеон',
            'category' => 'deserty',
        ]);
    }

    public function test_existing_category_does_not_create_new_one(): void
    {
        $this->seed(CategorySeeder::class);
        $admin = User::factory()->create();
        $initialCount = Category::count();

        $response = $this->actingAs($admin)->post(route('admin.menu.store'), [
            'name' => 'Борщ',
            'price' => 200,
            'category' => ['first'],
        ]);

        $response->assertRedirect(route('admin.menu.index'));
        $this->assertSame($initialCount, Category::count());
        $this->assertDatabaseHas('menu_items', [
            'name' => 'Борщ',
            'category' => 'first',
        ]);
    }

    public function test_new_category_name_is_required_when_new_option_selected(): void
    {
        $this->seed(CategorySeeder::class);
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->post(route('admin.menu.store'), [
            'name' => 'Наполеон',
            'price' => 150,
            'category' => ['__new'],
        ]);

        $response->assertSessionHasErrors('new_category');
        $this->assertDatabaseMissing('menu_items', ['name' => 'Наполеон']);
    }
}
