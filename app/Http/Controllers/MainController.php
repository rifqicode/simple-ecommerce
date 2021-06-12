<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class MainController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $firstCategory = Category::first()->id ?? 0;

        return view('dashboard', compact('category', 'firstCategory'));
    }

    public function getProduct(Request $request, $category)
    {
        if ($request->ajax()) {
            $product = Item::where([
                'category_id' => $category
            ])->get();

            $html = view('list-product', compact('product'))->render();
            return response()->json([
                'html' => $html
            ]);
        }

        abort(404);
    }
}
