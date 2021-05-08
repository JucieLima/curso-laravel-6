<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    /**
     * CategoryController constructor.
     * @param $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index($slug)
    {
        $category = $this->category->whereSlug($slug)->first();
        return view('store/category', compact('category'));
    }
}
