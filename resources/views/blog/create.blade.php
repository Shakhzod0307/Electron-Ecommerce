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
                        <li class="active">Create Blog</li>
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
                <div id="store" class="col-md-9">
                    <!-- store products -->
                    <form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
                        @method('POST')
                        @csrf

                        <div  class="row">
                            <!-- product -->
                            <div class="col-md-12 col-xs-8">
                                <div class="product">
                                    <div class="product-img">
                                    </div>

                                    <div class="product-body">
                                        <input name="image" type="file" class="form-control" required ><p></p>
                                        <input name="title" type="text" class="form-control" placeholder="Title" required><p></p>
                                        <textarea name="desc" rows="20" class="form-control" placeholder="Content" required ></textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-warning">Create</button>
                            </div>
                        </div>
                    </form>
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
