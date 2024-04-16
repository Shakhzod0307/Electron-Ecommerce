<?php

namespace App\Http\Controllers;

use App\Events\BlogCreated;
use App\Jobs\UploadBigFile;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
//        $blogs = Blog::all();
//        Cache::pull('blogs');
//        Cache::flush();
//        $blogs = Cache::remember('blogs',600,function (){
//            return Blog::paginate(20);
//        });
        return view('blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $this->validate($request,[
//            'title'=>'required',
//            'content'=>'required',
//        ]);
//        dd($request->all());
        $blog = new Blog();
        $path = $request->file('image')->store('temp');
        $file = $request->file('image');
        $fileName = $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);
        $blog->user_id = Auth::id();
        $blog->title = $request->title;
        $blog->image = $fileName;
        $blog->content = $request->desc;
        $blog->save();
        return redirect()->to('/blog')->with('success','Blog Created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $user = User::find($blog->user_id);
//        $product = Blog::find($id);
//        dd($user);
        return view('blog.show',compact('blog','user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        Gate::authorize('update-blog', $blog);
        return view('blog.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        Gate::authorize('update-blog',$blog);
        if ($request->file('image')){
//            $path = $request->file('image')->store('temp');
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $blog->image = $fileName;
        }
        $blog->title = $request->title;
        $blog->content = $request->desc;
        $blog->save();
        BlogCreated::dispatch($blog);
        UploadBigFile::dispatch($blog)
            ->delay(now()->addMinutes(10));;

        return redirect()->back()->with('success','Blog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        Gate::authorize('update-blog',$blog);
//        dd($blog);
        $blog->delete();
        return redirect()->to('blog')->with('success','Blog deleted successfully!');

    }
}
