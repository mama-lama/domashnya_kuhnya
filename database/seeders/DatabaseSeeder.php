<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use App\Models\MenuItem;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(CategorySeeder::class);

        // 1. Seed Admin User
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('admin123'),
            ]
        );

        // 2. Seed Settings
        $settings = [
            // General info
            ['key' => 'site_title', 'value' => 'Домашняя кухня', 'group' => 'general'],
            ['key' => 'phone', 'value' => '+7 (920) 223-80-60', 'group' => 'general'],
            ['key' => 'phone_raw', 'value' => '+79202238060', 'group' => 'general'],
            ['key' => 'address', 'value' => 'ул. Сенновские Выселки, 12, д. Князево', 'group' => 'general'],
            ['key' => 'working_hours', 'value' => 'Круглосуточно', 'group' => 'general'],

            // Hero section
            ['key' => 'hero_tag', 'value' => 'Уютная остановка для всей семьи', 'group' => 'hero'],
            ['key' => 'hero_title', 'value' => 'Домашняя кухня, сад и спокойный отдых у дороги', 'group' => 'hero'],
            ['key' => 'hero_description', 'value' => 'Мы рады видеть наших посетителей! Здесь можно вкусно поесть, отдохнуть с дороги и провести время в приятной, по-домашнему уютной обстановке.', 'group' => 'hero'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 3. Seed Menu Items
        $this->call(NewMenuSeeder::class);

        // 4. Seed Reviews
        $reviews = [
            [
                'name' => 'Анна',
                'city' => 'Ростов-на-Дону',
                'text' => 'Очень уютное место. Пообедали всей семьёй, детям понравился сад, а нам — спокойная атмосфера и вкусная домашняя еда.',
                'rating' => 5,
            ],
            [
                'name' => 'Игорь',
                'city' => 'Воронеж',
                'text' => 'Удобно заехать по пути. Всё аккуратно, подача быстрая, суп и жаркое действительно как дома. Хорошее место для остановки.',
                'rating' => 5,
            ],
            [
                'name' => 'Марина',
                'city' => 'Краснодар',
                'text' => 'Особенно понравилась веранда и территория с цветами. Очень спокойно, красиво и приятно выпить чай после долгой дороги.',
                'rating' => 5,
            ],
            [
                'name' => 'Светлана',
                'city' => 'Липецк',
                'text' => 'Останавливались на ночь, всё было спокойно и удобно. На утро позавтракали и поехали дальше отдохнувшими.',
                'rating' => 5,
            ],
            [
                'name' => 'Павел',
                'city' => 'Белгород',
                'text' => 'Хорошее место для семейного обеда. Чисто, спокойно, без суеты. Видно, что здесь стараются сделать отдых приятным.',
                'rating' => 5,
            ],
            [
                'name' => 'Елена',
                'city' => 'Тула',
                'text' => 'Праздновали семейное событие в небольшом кругу. Получилось тепло, красиво и по-настоящему по-домашнему.',
                'rating' => 5,
            ],
        ];

        foreach ($reviews as $review) {
            Review::updateOrCreate(
                ['name' => $review['name'], 'text' => $review['text']],
                $review
            );
        }
    }
}
