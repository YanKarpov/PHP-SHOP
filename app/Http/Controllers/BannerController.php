<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function getActiveBanners()
    {
        $banners = Banner::active()
            ->ordered()
            ->get();

        return response()->json([
            'success' => true,
            'banners' => $banners
        ]);
    }

    public function showHomepage()
    {
        $banners = Banner::active()
            ->ordered()
            ->limit(3) // Показываем 3 активных баннера
            ->get();

        return view('home', compact('banners'));
    }
}