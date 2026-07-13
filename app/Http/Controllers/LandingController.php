<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\MenuItem;
use App\Models\Review;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        $menuItems = MenuItem::all();
        $reviews = Review::where('is_active', true)->get();

        return view('landing', compact('settings', 'menuItems', 'reviews'));
    }
}
