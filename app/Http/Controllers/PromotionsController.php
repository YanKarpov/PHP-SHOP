<?php



namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\View\View;

class PromotionsController extends Controller
{
    /**
     * Показываем страницу с действующими акциями.
     *
     * @return View
     */
    public function index(): View
    {
        // Извлекаем действующие акции
        $activePromotions = Promotion::whereDate('start_date', '<=', now())
                                     ->whereDate('end_date', '>=', now())
                                     ->get();
        
        return view('promotions.index', ['promotions' => $activePromotions]);
    }
}

