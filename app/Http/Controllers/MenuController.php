<?php
// app/Http/Controllers/MenuController.php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function getMenu()
    {
        $menuItems = MenuItem::with(['children' => function($query) {
            $query->active()->orderBy('sort_order');
        }])
        ->rootItems()
        ->orderBy('sort_order')
        ->get();

        return view('menu.main', compact('menuItems'));
    }

    public function getMenuData()
    {
        $menuItems = MenuItem::with(['children' => function($query) {
            $query->active()->orderBy('sort_order');
        }])
        ->rootItems()
        ->orderBy('sort_order')
        ->get();

        return response()->json($menuItems);
    }
}