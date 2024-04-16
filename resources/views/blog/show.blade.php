@extends('homepage')
@section('content')

    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{url('/')}}">Home</a></li>
{{--                        <li>All Categories</li>--}}
                        <li class="active"><a href="{{url('/blog')}}">Blogs</a></li>
                        <li class="active">{{$blog->title}}</li>
                    </ul>

                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            @can('update-blog',$blog)
            <form action="{{route('blog.destroy',$blog->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <a class="btn btn-info" href="{{route('blog.edit',$blog->id)}}"> Edit</a>
                <button type="submit" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger">Delete</button>
            </form>
            @endcan
            <!-- row -->
            <div class="row">
                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- store products -->
                    <div  class="row">
                        <!-- product -->
                        <div class="col-md-12 col-xs-8">
                                <div class="product">
                                    <div class="product-img">
                                        <img style="height: 350px" src="{{ asset('uploads/' . $blog->image) }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h2 class="product-category">Publisher:  {{ $user['name']}} </br>   Date: {{$blog->created_at}}</h2>
                                        <h1 class="product-category">Title:  {{ $blog->title}}</h1>
                                        <p  class="product-name">{{$blog->content}}</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->


    <style>
        /*.product-name {*/
        /*    display: -webkit-box;*/
        /*    -webkit-line-clamp: 7;*/
        /*    -webkit-box-orient: vertical;*/
        /*    overflow: hidden;*/
        /*    text-overflow: ellipsis;*/
        /*}*/
        /*.product-category {*/
        /*    display: -webkit-box;*/
        /*    -webkit-line-clamp: 2;*/
        /*    -webkit-box-orient: vertical;*/
        /*    overflow: hidden;*/
        /*    text-overflow: ellipsis;*/
        /*}*/
    </style>
@endsection
