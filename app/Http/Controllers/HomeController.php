<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Carts;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('home');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        $carts = Carts::find($id);
//        dd($carts);
        $categories = Category::take(5)->get();
        return view('homepage.newproducts',compact('categories','carts'));
    }
    public function store(Request $request)
    {
        $authuser = Auth::user();
        $messageText = $request->input('message');
        $message = [
            'text' => $messageText,
            'user' => $authuser['name'],
            'time' => Carbon::now()->toTimeString(), // Format the time as needed
        ];

        MessageSent::dispatch($message);
        return response()->json(['success' => true, 'message' => 'Message sent successfully']);
    }
}
