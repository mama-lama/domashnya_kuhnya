<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['slug' => 'first', 'name' => 'Первые блюда', 'sort_order' => 10],
            ['slug' => 'salad', 'name' => 'Салаты', 'sort_order' => 20],
            ['slug' => 'second', 'name' => 'Вторые блюда', 'sort_order' => 30],
            ['slug' => 'order', 'name' => 'Блюда под заказ', 'sort_order' => 40],
            ['slug' => 'side', 'name' => 'Гарниры', 'sort_order' => 50],
            ['slug' => 'drinks', 'name' => 'Напитки', 'sort_order' => 60],
            ['slug' => 'bakery', 'name' => 'Выпечка', 'sort_order' => 70],
            ['slug' => 'bread', 'name' => 'Хлеб', 'sort_order' => 80],
            ['slug' => 'extra', 'name' => 'Дополнительно', 'sort_order' => 90],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
