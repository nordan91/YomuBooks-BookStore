<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->take(5)->get();
        $categories = Category::latest()->take(5)->get();
        $books = Book::latest()->take(5)->get();

        return view('web.home', compact('sliders', 'categories', 'books'));
    }
}
