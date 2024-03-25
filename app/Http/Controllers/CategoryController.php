<?php

namespace App\Http\Controllers;

use App\Models\Carts;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index($title,$name=null)
    {
        $id = Auth::id();
        $carts = Carts::find($id);
//        dd($carts);
        $categories = Category::take(5)->get();
        $category = Category::where('title', $title)->first();
        $product = Products::find($name);
        if (!$name){
            if ($category) {
                // Retrieve products for the found category
                $products = Products::where('category_id', $category->id)->paginate(20);
            } else {
                // If the category does not exist, set products to an empty collection
                $products = collect();
            }

            return view('homepage.store',compact('categories','title','products','carts'));
        }
//        dd($product);
        return view('homepage.product',compact('categories','title','product','carts'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
