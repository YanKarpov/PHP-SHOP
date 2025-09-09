<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::with('children')->whereNull('parent_id')->orderBy('position')->get();

        return view('menu.index', compact('menuItems'));
    }
}