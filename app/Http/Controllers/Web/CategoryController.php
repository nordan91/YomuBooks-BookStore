<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Book;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::with('books.images')->where('slug', $slug)->firstOrFail();
        return view('web.category.show', compact('category'));
    }
}
