<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Category;
use App\Models\MenuItem;
use App\Models\Review;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        $rawMenuItems = MenuItem::all();
        $menuItems = $this->groupMenuItems($rawMenuItems);

        $categories = Category::orderBy('sort_order')
            ->get()
            ->filter(fn (Category $category) => $rawMenuItems->contains(
                fn (MenuItem $item) => in_array($category->slug, $item->categorySlugs(), true)
            ))
            ->values();
        $reviews = Review::where('is_active', true)->get();
        $roomImages = collect(File::exists(public_path('images/rooms')) ? File::files(public_path('images/rooms')) : [])
            ->map(fn ($file) => asset('images/rooms/' . $file->getFilename()))
            ->values();

        return view('landing', compact('settings', 'menuItems', 'categories', 'reviews', 'roomImages'));
    }

    private function groupMenuItems($items)
    {
        $grouped = [];
        foreach ($items as $item) {
            $key = $item->name . '_' . implode(',', $item->categorySlugs());
            if (!isset($grouped[$key])) {
                $grouped[$key] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'description' => $item->description,
                    'ingredients' => $item->ingredients,
                    'tag' => $item->tag,
                    'image_url' => $item->image_url,
                    'category_slugs' => $item->categorySlugs(),
                    'price' => $item->price,
                    'weight' => $item->weight,
                    'has_multiple_portions' => false,
                    'min_price' => $item->price,
                    'portions' => [
                        ['weight' => $item->weight, 'price' => $item->price],
                    ],
                ];
            } else {
                $grouped[$key]['has_multiple_portions'] = true;
                $grouped[$key]['portions'][] = [
                    'weight' => $item->weight,
                    'price' => $item->price,
                ];
                if ($item->price < $grouped[$key]['min_price']) {
                    $grouped[$key]['min_price'] = $item->price;
                }
            }
        }

        return collect(array_values($grouped))->map(function ($data) {
            $obj = (object) $data;
            $obj->categorySlugs = fn() => $data['category_slugs'];
            if ($data['has_multiple_portions']) {
                $obj->display_price = 'от ' . $data['min_price'] . ' ₽';
                $obj->display_weight = implode(' • ', array_map(fn($p) => $p['weight'] . ' (' . $p['price'] . ' ₽)', $data['portions']));
            } else {
                $obj->display_price = $data['price'] . ' ₽';
                $obj->display_weight = $data['weight'];
            }
            return $obj;
        });
    }
}
