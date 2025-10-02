<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\View\View;

class PromotionsController extends Controller
{
    public function index(): View
    {
        $activePromotions = Promotion::whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->get();

        return view('promotions.index', ['promotions' => $activePromotions]);
    }
}
