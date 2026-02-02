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
    return view('categories.create', compact('data'));
}


}
