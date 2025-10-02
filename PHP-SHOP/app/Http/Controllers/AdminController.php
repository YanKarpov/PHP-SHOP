<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{

public function categories()
{
$categories = Category::paginate(10);
return view('admin.categories.index', compact('categories'));
}


public function createCategory()
{
return view('admin.categories.create');
}


public function storeCategory(Request $request)
{
$request->validate([
'name' => 'required|string|max:255',
]);

Category::create($request->all());

return redirect()->route('admin.categories.index')->with('success', 'Категория добавлена');
}


public function editCategory($id)
{
$category = Category::findOrFail($id);
return view('admin.categories.edit', compact('category'));
}

// Обновление категории
public function updateCategory(Request $request, $id)
{
$request->validate([
'name' => 'required|string|max:255',
]);

$category = Category::findOrFail($id);
$category->update($request->all());

return redirect()->route('admin.categories.index')->with('success', 'Категория обновлена');
}


public function destroyCategory($id)
{
$category = Category::findOrFail($id);
$category->delete();

return redirect()->route('admin.categories.index')->with('success', 'Категория удалена');
}
}
