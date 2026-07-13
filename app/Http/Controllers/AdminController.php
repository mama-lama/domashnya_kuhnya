<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\MenuItem;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\MenuPdfService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Dashboard Stats
    public function dashboard()
    {
        $menuCount = MenuItem::count();
        $reviewCount = Review::count();
        $activeReviewCount = Review::where('is_active', true)->count();
        $latestReviews = Review::latest()->take(3)->get();

        return view('admin.dashboard', compact('menuCount', 'reviewCount', 'activeReviewCount', 'latestReviews'));
    }

    // Settings Editor
    public function settings()
    {
        $settings = Setting::all()->groupBy('group');
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'settings' => ['required', 'array'],
        ]);

        foreach ($data['settings'] as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        return back()->with('success', 'Настройки успешно обновлены!');
    }

    // Menu Items CRUD
    public function menuIndex()
    {
        $menuItems = MenuItem::latest()->get();
        return view('admin.menu.index', compact('menuItems'));
    }

    public function menuCreate()
    {
        return view('admin.menu.edit');
    }

    public function menuStore(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'ingredients' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'weight' => ['nullable', 'string', 'max:50'],
            'category' => ['required', 'string', 'max:50'],
            'tag' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'max:2048'], // Max 2MB image
            'image_url' => ['nullable', 'url', 'max:2048'], // Fallback url input
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('menu', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        MenuItem::create($validated);

        return redirect()->route('admin.menu.index')->with('success', 'Блюдо успешно добавлено!');
    }

    public function menuEdit(MenuItem $menuItem)
    {
        return view('admin.menu.edit', compact('menuItem'));
    }

    public function menuUpdate(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'ingredients' => ['nullable', 'string'],
            'price' => ['required', 'integer', 'min:0'],
            'weight' => ['nullable', 'string', 'max:50'],
            'category' => ['required', 'string', 'max:50'],
            'tag' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'max:2048'],
            'image_url' => ['nullable', 'string', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if it was uploaded locally
            if ($menuItem->image_url && str_starts_with($menuItem->image_url, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $menuItem->image_url));
            }
            $path = $request->file('image')->store('menu', 'public');
            $validated['image_url'] = '/storage/' . $path;
        }

        $menuItem->update($validated);

        return redirect()->route('admin.menu.index')->with('success', 'Блюдо успешно обновлено!');
    }

    public function menuDestroy(MenuItem $menuItem)
    {
        if ($menuItem->image_url && str_starts_with($menuItem->image_url, '/storage/')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $menuItem->image_url));
        }

        $menuItem->delete();
        return redirect()->route('admin.menu.index')->with('success', 'Блюдо успешно удалено!');
    }

    public function generateMenuPdf(MenuPdfService $service)
    {
        // Run Artisan command in the background to avoid web server timeouts
        if (substr(php_uname(), 0, 7) == "Windows") {
            pclose(popen("start /B php artisan menu:generate-pdf", "r"));
        } else {
            exec("php artisan menu:generate-pdf > /dev/null &");
        }

        return redirect()->back()->with('success', 'Генерация PDF меню запущена в фоновом режиме. Пожалуйста, подождите 5-10 секунд и скачайте файл.');
    }

    public function previewMenu(MenuPdfService $service)
    {
        $data = $service->getMenuData();
        return view('pdf.menu', $data);
    }

    // Reviews CRUD & Moderation
    public function reviewsIndex()
    {
        $reviews = Review::latest()->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    public function reviewsCreate()
    {
        return view('admin.reviews.edit');
    }

    public function reviewsStore(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        Review::create($validated);
        return redirect()->route('admin.reviews.index')->with('success', 'Отзыв успешно добавлен!');
    }

    public function reviewsEdit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    public function reviewsUpdate(Request $request, Review $review)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'is_active' => ['boolean'],
        ]);

        $validated['is_active'] = $request->has('is_active');

        $review->update($validated);
        return redirect()->route('admin.reviews.index')->with('success', 'Отзыв успешно обновлен!');
    }

    public function reviewsToggleActive(Review $review)
    {
        $review->update(['is_active' => !$review->is_active]);
        return back()->with('success', 'Статус публикации отзыва изменен!');
    }

    public function reviewsDestroy(Review $review)
    {
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Отзыв успешно удален!');
    }
}
