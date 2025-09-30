<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    // Список новостей
    public function index()
    {
        $news = News::where('is_published', true)->latest()->paginate(5);
        return view('news.index', compact('news'));
    }

    // Просмотр одной новости
    public function show($id)
    {
        $item = News::findOrFail($id);
        return view('news.show', compact('item'));
    }

    // Форма добавления
    public function create()
    {
        return view('news.create');
    }

    // Сохранение новой новости
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
            
        }

        News::create($data);

        return redirect()->route('news.index')->with('success', 'Новость добавлена!');
    }

    // Форма редактирования
    public function edit($id)
    {
        $news = News::findOrFail($id);
        return view('news.edit', compact('news'));
    }

    // Обновление новости
    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Удалим старое изображение, если есть
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);

        return redirect()->route('news.index')->with('success', 'Новость обновлена!');
    }

    // Удаление новости
    public function destroy($id)
    {
        $news = News::findOrFail($id);

        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'Новость удалена!');
    }
}
