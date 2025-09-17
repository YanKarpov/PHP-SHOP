<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = Menu::with('children')
            ->whereNull('parent_id')
            ->orderBy('order')
            ->get();
            
        return view('menu', compact('menuItems'));
    }
}