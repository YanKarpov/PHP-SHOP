<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionAdminController extends Controller
{
    // Показ всех акций
    public function index()
    {
        $promotions = Promotion::all();
        return view('promotions.index', compact('promotions'));
    }

    // Форма создания новой акции
    public function create()
    {
        return view('promotions.create');
    }


    // Сохранение новой акции
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        Promotion::create($request->all());
        return redirect()->route('admin.promotions.index');
    }

    // Показ одной акции
    public function show(Promotion $promotion)
    {
        return view('promotions.show', compact('promotion'));
    }

    // Форма редактирования акции
    public function edit(Promotion $promotion)
    {
        return view('promotions.edit', compact('promotion'));
    }

    // Обновление акции
    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'title' => 'required|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $promotion->update($request->all());
        return redirect()->route('admin.promotions.index');
    }

    // Удаление акции
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('admin.promotions.index');
    }
}
