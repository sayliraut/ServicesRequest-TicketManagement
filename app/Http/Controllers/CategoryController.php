<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class CategoryController extends Controller
{
public function index()
{
    return view('categories.index');
    }

public function loadAjax()
{
    return response()->json(
        Category::select('id', 'name', 'is_active')
            ->latest('id')
            ->get()
    );
}

public function create()
{
    return view('categories.form');
}

public function edit(Category $category)
{
    return view('categories.form', compact('category'));
}
protected function rules(?Category $category = null): array
{
    $uniqueRule = 'unique:categories,name';
    if ($category) {
        $uniqueRule .= ',' . $category->id;
    }

    return [
        'name' => ['required','string','min:2','max:100',$uniqueRule],
        'is_active' => ['nullable','boolean'],
    ];
}

public function update(Request $request, Category $category)
{
    $validated = $request->validate($this->rules($category));
    $validated['is_active'] = $request->has('is_active') ? 1 : 0;
    $category->update($validated);

    return $this->respondWithJson(true, 'Category updated successfully!', $request);
}

public function store(Request $request)
{
    $validated = $request->validate($this->rules());
    $validated['is_active'] = $request->has('is_active') ? 1 : 0;
    Category::create($validated);

    return $this->respondWithJson(true, 'Category created successfully!', $request, 201);
}

public function destroy(Request $request, Category $category)
{
    $category->delete();
    return $this->respondWithJson(true, 'Category deleted successfully!', $request);
}

public function toggle(Request $request, Category $category)
{
    $category->update(['is_active' => !$category->is_active]);
    
    return response()->json([
        'success' => true, 
        'message' => 'Category status updated', 
        'is_active' => $category->is_active
    ]);
}
}
