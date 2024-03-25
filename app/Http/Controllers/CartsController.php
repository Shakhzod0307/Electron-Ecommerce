<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Carts;
use App\Models\Category;
use App\Models\Orders;
use App\Models\Products;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $user = Auth::id();
        $authuser = Auth::user();
        $cart = new Carts();
        $product = Products::find($id);
        $category = Category::find($product->category_id);
        if ($product->discounted_price){
            $price = $product->discounted_price;
        }else{
            $price = $product->price;
        }
//        dd($username);
        $cart->user_id = $user;
        $cart->product_name = $product->title;
        $cart->product_category = $category->title;
        $cart->product_price = $price * $request->quantity;
        $cart->product_brand = $product->brand;
        $cart->product_color = $request->color;
        $cart->product_image = $product->images;
        $cart->product_size = $product->size;
        $cart->product_quantity = $request->quantity;
        $cart->product_description = $product->description;
        $cart->save();

//        dd($product->discunted_price * $request->quantity);

        return back()->with('message','Product added to Your Carts successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function checkout()
    {
        $user = Auth::id();
        $carts = Carts::where('user_id',$user)->get();

//        dd($carts);
        return view('homepage.checkout',compact('carts'));
    }

    public function myOrders()
    {
        $user = Auth::id();
        $orders = Orders::where('user_id',$user)->get();
//        foreach ($orderss as $orders){
//            dd($orders);
//        }

        return view('homepage.orders',compact('orders'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function orders_store(Request $request)
    {
        $user = Auth::id();
        $carts = Carts::where('user_id',$user)->get()->toarray();
        $selling = 0;
        $updatedCarts = [];
        foreach ($carts as $cartItem) {
             $cartItem['quantity'] = $request->quantity;
             $updatedCarts[] = $cartItem;

        }
//        dd($updatedCarts[0],$selling);

//        $order_pro = json_encode($carts);
        $order = new Orders();
        $order->user_id = $user;
        $order->f_name = $request->f_name;
        $order->l_name = $request->l_name;
        $order->email = $request->email;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->country = $request->country;
        $order->z_code = $request->z_code;
        $order->phone = $request->phone;
        $order->products = json_encode($updatedCarts);
        $order->total_price = $request->total_price;
        $order->order_note = $request->order_note;
        $order->save();
        DB::table('carts')->where('user_id',$user)->delete();

        return back()->with('success','Your orders received successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function wishlist($id)
    {
        $user_id = Auth::id();
        $product_id = $id;
        $wishlist = new Wishlist();
        $wishlist->user_id = $user_id;
        $wishlist->product_id = $product_id;
        $wishlist->save();
        return back()->with('message','Product added to Wishlist successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function delete_wishlist($id)
    {
//        dd($id);
        Db::table('wishlists')->where('product_id',$id)->delete();
        return back()->with('message','Product deleted from Wishlist successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function show_carts()
    {
        $user_id = Auth::id();
        $products = DB::table('carts')->where('user_id',$user_id)->get();
        return view('homepage.cart',compact('products'));
    }
    public function show_wishlist()
    {

        $user_id = Auth::id();
        $productIds = [];

        $wishlists = DB::table('wishlists')->where('user_id', $user_id)->get('product_id');

        foreach ($wishlists as $wishlist) {
            $productIds[] = $wishlist->product_id;
        }
        $products = DB::table('products')->whereIn('id', $productIds)->get();
//        dd(gettype($products));
        return view('homepage.wishlist', compact('products'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Carts::destroy($id);
        return back()->with('delete','Product deleted from Your Carts successfully!');
    }
}
