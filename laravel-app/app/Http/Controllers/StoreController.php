<?php
// app/Http/Controllers/StoreController.php

namespace App\Http\Controllers;

use App\Models\Store;

class StoreController extends Controller
{
	public function index()
	{
		$stores = Store::query()
			->where('is_active', true)
			->orderBy('city')
			->orderBy('name')
			->get();

		return view('stores.index', compact('stores'));
	}
}
