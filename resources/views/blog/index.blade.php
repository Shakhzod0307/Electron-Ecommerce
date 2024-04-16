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
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif
    <!-- SECTION -->
    <div class="section">

        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- STORE -->

                <div id="store" class="col-md-12">
                    <!-- store products -->
                    <div  class="row">
                        <!-- product -->
                        @foreach($blogs as $product)
                            <div class="col-md-4 col-xs-4">
                                <div class="product">
                                    <div class="product-img">
                                        <img style="height:250px" src="{{ asset('uploads/' . $product->image) }}" alt="">
                                    </div>
                                    <div style="height: 200px" class="product-body">
                                        <h2 class="product-category">{{$product->title}}</h2>
                                        <p  class="product-name"><a href="{{url('blog/'.$product->id)}}">{{$product->content}}</a></p>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="store-filter clearfix">
                        @if($blogs->count()>0) {{ $blogs->links('pagination::bootstrap-5') }}@endif
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->


    <style>
        .product-name {
            display: -webkit-box;
            -webkit-line-clamp: 7;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .product-category {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
@endsection
