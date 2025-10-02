\
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreLocation;
use Illuminate\Http\Request;

class StoreLocationAdminController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string)$request->get('q', ''));
        $query = StoreLocation::query();

        if ($q !== '') {
            $query->where(function($qq) use ($q) {
                $qq->where('name', 'like', "%$q%")
                   ->orWhere('city', 'like', "%$q%")
                   ->orWhere('address', 'like', "%$q%")
                   ->orWhere('phone', 'like', "%$q%")
                   ->orWhere('email', 'like', "%$q%");
            });
        }

        $locations = $query->orderBy('id','desc')->paginate(20);
        return view('admin.contacts.index', compact('locations','q'));
    }

    public function create()
    {
        return view('admin.contacts.form', ['location' => new StoreLocation()]);
    }

    protected function sanitize(Request $request): array
    {
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'city'=>'nullable|string|max:255',
            'address'=>'required|string|max:255',
            'phone'=>'nullable|string|max:255',
            'email'=>'nullable|email|max:255',
            'lat'=>'nullable|numeric',
            'lng'=>'nullable|numeric',
            'is_active'=>'nullable|boolean',
            'hours_json'=>'nullable|string',
        ]);

        $hours = null;
        if (!empty($data['hours_json'])) {
            try { $hours = json_decode($data['hours_json'], true, 512, JSON_THROW_ON_ERROR); }
            catch (\Throwable $e) { $hours = null; }
        }
        $data['hours'] = $hours;
        $data['is_active'] = (bool)($data['is_active'] ?? false);
        unset($data['hours_json']);
        return $data;
    }

    public function store(Request $request)
    {
        $data = $this->sanitize($request);
        StoreLocation::create($data);
        return redirect()->route('admin.contacts.index')->with('ok','Точка добавлена');
    }

    public function edit(StoreLocation $location)
    {
        return view('admin.contacts.form', compact('location'));
    }

    public function update(Request $request, StoreLocation $location)
    {
        $data = $this->sanitize($request);
        $location->update($data);
        return redirect()->route('admin.contacts.index')->with('ok','Точка обновлена');
    }

    public function destroy(StoreLocation $location)
    {
        $location->delete();
        return redirect()->route('admin.contacts.index')->with('ok','Точка удалена');
    }
}
