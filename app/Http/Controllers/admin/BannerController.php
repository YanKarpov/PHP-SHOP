<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::ordered()->paginate(10);
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        $types = Banner::getTypes();
        return view('admin.banners.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'link_url' => 'nullable|url',
            'target' => 'nullable|in:_self,_blank',
            'position' => 'nullable|integer',
            'type' => 'required|in:main,sidebar,footer',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date'
        ]);

        // Загрузка изображения
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public');
            $validated['image_url'] = Storage::url($imagePath);
        }

        Banner::create($validated);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Баннер успешно создан');
    }

    public function show(Banner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    public function edit(Banner $banner)
    {
        $types = Banner::getTypes();
        return view('admin.banners.edit', compact('banner', 'types'));
    }

    public function update(Request $request, Banner $banner)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'alt_text' => 'nullable|string|max:255',
            'link_url' => 'nullable|url',
            'target' => 'nullable|in:_self,_blank',
            'position' => 'nullable|integer',
            'type' => 'required|in:main,sidebar,footer',
            'is_active' => 'boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after:start_date'
        ]);

        // Обновление изображения
        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($banner->image_url) {
                $oldImage = str_replace('/storage/', '', $banner->image_url);
                Storage::disk('public')->delete($oldImage);
            }

            $imagePath = $request->file('image')->store('banners', 'public');
            $validated['image_url'] = Storage::url($imagePath);
        }

        $banner->update($validated);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Баннер успешно обновлен');
    }

    public function destroy(Banner $banner)
    {
        // Удаляем изображение
        if ($banner->image_url) {
            $imagePath = str_replace('/storage/', '', $banner->image_url);
            Storage::disk('public')->delete($imagePath);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Баннер успешно удален');
    }
}