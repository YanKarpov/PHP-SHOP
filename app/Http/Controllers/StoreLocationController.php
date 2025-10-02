\
<?php

namespace App\Http\Controllers;

use App\StoreLocation;
use Illuminate\Http\Request;

class StoreLocationController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string)$request->get('q', ''));
        $query = StoreLocation::query()->where('is_active', true);

        if ($q !== '') {
            $query->where(function($qq) use ($q) {
                $qq->where('name', 'like', "%$q%")
                   ->orWhere('city', 'like', "%$q%")
                   ->orWhere('address', 'like', "%$q%")
                   ->orWhere('phone', 'like', "%$q%");
            });
        }

        $locations = $query->orderBy('city')->orderBy('name')->get();
        return view('contacts.index', compact('locations','q'));
    }

    public function show(StoreLocation $location)
    {
        abort_unless($location->is_active, 404);
        return view('contacts.show', compact('location'));
    }

    public function json()
    {
        $items = StoreLocation::where('is_active', true)->orderBy('city')->orderBy('name')->get();
        return response()->json($items);
    }
}
