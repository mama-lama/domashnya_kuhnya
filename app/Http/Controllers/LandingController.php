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
        $menuItems = MenuItem::all();
        $categories = Category::orderBy('sort_order')
            ->get()
            ->filter(fn (Category $category) => $menuItems->contains(
                fn (MenuItem $item) => in_array($category->slug, $item->categorySlugs(), true)
            ))
            ->values();
        $reviews = Review::where('is_active', true)->get();
        $roomImages = collect(File::exists(public_path('images/rooms')) ? File::files(public_path('images/rooms')) : [])
            ->map(fn ($file) => asset('images/rooms/' . $file->getFilename()))
            ->values();

        return view('landing', compact('settings', 'menuItems', 'categories', 'reviews', 'roomImages'));
    }
}
