<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class DashboardController extends Controller
{
    public function index()
    {
        $productsCount = Product::all()->count();
        $categoriesCount = Category::all()->count();
        $subCategoriesCount = SubCategory::all()->count();
        $carouselsCount = Carousel::all()->count();

        $products = Product::all()->take(5);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $carousels = Carousel::all();

        return view('home', compact('productsCount', 'categoriesCount', 'subCategoriesCount', 'products', 'categories', 'subcategories', 'carousels', 'carouselsCount'));
    }
}
