<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class CategoryController extends Controller
{
    public function index(){
        $data['title'] = 'categories';
        return view('categories.index', compact('data'));
    }

public function loadAjax()
{
    return response()->json(Category::select('id', 'name', 'is_active')->orderBy('id', 'desc')->get()
    );
}

public function create(){
    $data['title'] = 'Create Category';
    return view('categories.form', compact('data'));
}
public function edit(Category $category)
{
    $data['title'] = 'Edit Category';
    return view('categories.form', compact('data', 'category'));
}
public function update(Request $request, Category $category)
{
    try {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:100|unique:categories,name,' . $category->id,
            'is_active' => 'nullable|boolean'
        ]);

        $category->name = $validated['name'];
        $category->is_active = $request->has('is_active') ? 1 : 0;
        $category->save();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Category updated successfully!'], 200);
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    } catch (\Illuminate\Validation\ValidationException $e) {
        if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => 'Validation failed', 'errors' => $e->errors()], 422);
        }
        return back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
        return back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
    }
}
public function store(Request $request){
    try {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:100|unique:categories,name',
            'is_active' => 'nullable|boolean'
        ]);

        $validated['is_active'] = $request->has('is_active') ? 1 : 0;

        Category::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Category created successfully!'
            ], 201);
        }

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    } catch (\Illuminate\Validation\ValidationException $e) {
        if (request()->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }
        return back()->withErrors($e->errors())->withInput();
    } catch (\Exception $e) {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
        return back()->with('error', 'An error occurred: ' . $e->getMessage())->withInput();
    }
}

public function destroy(Request $request, Category $category)
{
    try {
        $category->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Category deleted successfully!'], 200);
        }

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    } catch (\Exception $e) {
        if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
        return back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}

public function toggle(Request $request, Category $category)
{
    try {
        $category->is_active = !$category->is_active;
        $category->save();

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Category status updated', 'is_active' => $category->is_active], 200);
        }

        return redirect()->route('categories.index')->with('success', 'Category status updated');
    } catch (\Exception $e) {
        if ($request->expectsJson()) {
            return response()->json(['success' => false, 'message' => 'An error occurred: ' . $e->getMessage()], 500);
        }
        return back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}


}
