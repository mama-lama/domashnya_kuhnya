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
            ['key' => 'site_title', 'value' => 'Домашняя кухня у дороги', 'group' => 'general'],
            ['key' => 'phone', 'value' => '+7 (999) 123-45-67', 'group' => 'general'],
            ['key' => 'phone_raw', 'value' => '+79991234567', 'group' => 'general'],
            ['key' => 'address', 'value' => 'ул. Сенновские Выселки, 12, д. Князево', 'group' => 'general'],
            ['key' => 'working_hours', 'value' => 'Ежедневно с 08:00 до 22:00', 'group' => 'general'],

            // Hero section
            ['key' => 'hero_tag', 'value' => 'Уютная остановка для всей семьи', 'group' => 'hero'],
            ['key' => 'hero_title', 'value' => 'Домашняя кухня, сад и спокойный отдых у дороги', 'group' => 'hero'],
            ['key' => 'hero_description', 'value' => 'Уютное придорожное кафе с тёплой домашней атмосферой, зелёным садом, фонтаном, верандой, комнатами под съём и возможностью провести семейное торжество. Заезжайте отдохнуть, вкусно поесть и перевести дух в дороге.', 'group' => 'hero'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // 3. Seed Menu Items
        $menuItems = [
            [
                'name' => 'Борщ со сметаной',
                'description' => 'Насыщенный домашний борщ с мягким вкусом, свежей зеленью и ложкой сметаны.',
                'ingredients' => 'свекла, капуста, картофель, говядина, сметана, зелень, специи',
                'price' => 220,
                'weight' => '300 г',
                'category' => 'first',
                'tag' => 'Сытный обед',
                'image_url' => 'https://images.unsplash.com/photo-1547592180-85f173990554?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Куриный суп',
                'description' => 'Лёгкий ароматный суп с курицей, овощами и домашним теплом в каждой ложке.',
                'ingredients' => 'куриный бульон, куриное филе, вермишель, картофель, морковь, лук, свежая зелень',
                'price' => 180,
                'weight' => '300 г',
                'category' => 'first',
                'tag' => 'Лёгкий',
                'image_url' => 'https://images.unsplash.com/photo-1544025162-d76694265947?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Солянка домашняя',
                'description' => 'Яркий насыщенный вкус, мягкая кислинка и плотный бульон для хорошего обеда.',
                'ingredients' => 'копченое мясо, ветчина, соленые огурцы, маслины, лимон, томатный соус, лук, специи',
                'price' => 250,
                'weight' => '300 г',
                'category' => 'first',
                'tag' => 'Домашний вкус',
                'image_url' => 'https://images.unsplash.com/photo-1476718406336-bb5a9690ee2a?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Жаркое по-домашнему',
                'description' => 'Мягкое мясо, картофель и ароматные овощи в густом домашнем соусе.',
                'ingredients' => 'свинина, картофель, репчатый лук, морковь, чеснок, специи, зелень',
                'price' => 340,
                'weight' => '350 г',
                'category' => 'second',
                'tag' => 'Горячее',
                'image_url' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Пельмени',
                'description' => 'Подаются горячими, со сливочным маслом и нежной сметаной по желанию.',
                'ingredients' => 'фарш свино-говяжий, пшеничная мука, лук репчатый, сливочное масло, соль, специи, сметана',
                'price' => 290,
                'weight' => '280 г',
                'category' => 'second',
                'tag' => 'Классика',
                'image_url' => 'https://images.unsplash.com/photo-1604329760661-e71dc83f8f26?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Салат овощной',
                'description' => 'Свежие сезонные овощи, зелень и лёгкая заправка для свежего вкуса.',
                'ingredients' => 'свежие томаты, огурцы, болгарский перец, укроп, петрушка, оливковое масло, соль',
                'price' => 170,
                'weight' => '220 г',
                'category' => 'salad',
                'tag' => 'Свежесть',
                'image_url' => 'https://images.unsplash.com/photo-1546793665-c74683f339c1?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Блины с начинкой',
                'description' => 'Тонкие румяные блины с начинкой на выбор: творог, мясо или яблоко.',
                'ingredients' => 'молоко, мука пшеничная, яйцо куриное, начинка (домашний творог, мясной фарш, яблоки с корицей)',
                'price' => 210,
                'weight' => '250 г',
                'category' => 'bakery',
                'tag' => 'Выпечка',
                'image_url' => 'https://images.unsplash.com/photo-1488477181946-6428a0291777?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Чай',
                'description' => 'Чёрный или травяной чай, который особенно приятно пить на веранде после дороги.',
                'ingredients' => 'чайный лист (черный, зеленый или травяной сбор), очищенная вода, лимон по вкусу',
                'price' => 90,
                'weight' => '300 мл',
                'category' => 'drinks',
                'tag' => 'Тёплый напиток',
                'image_url' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Кофе',
                'description' => 'Классический бодрящий кофе для тех, кто продолжает путь и хочет сделать паузу со вкусом.',
                'ingredients' => 'свежемолотые кофейные зерна арабика, очищенная вода, сахар по желанию',
                'price' => 130,
                'weight' => '250 мл',
                'category' => 'drinks',
                'tag' => 'Бодрящий',
                'image_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=900&q=80',
            ],
            [
                'name' => 'Картофельное пюре',
                'description' => 'Нежное домашнее пюре со сливочным вкусом — отличный гарнир к горячим блюдам.',
                'ingredients' => 'картофель отборный, молоко коровье, масло сливочное, соль',
                'price' => 140,
                'weight' => '180 г',
                'category' => 'side',
                'tag' => 'Гарнир',
                'image_url' => 'https://images.unsplash.com/photo-1515003197210-e0cd71810b5f?auto=format&fit=crop&w=900&q=80',
            ],
        ];

        foreach ($menuItems as $item) {
            MenuItem::updateOrCreate(['name' => $item['name']], $item);
        }

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
