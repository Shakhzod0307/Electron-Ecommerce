@extends('homepage')
@section('content')
    @if(session('message'))
        <div class="alert alert-success text-center">
            {{ session('message') }}
        </div>
    @endif

    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{url('/')}}">Home</a></li>
{{--                        <li><a href="#">All Categories</a></li>--}}
{{--                        <li><a href="{{url('category/'.$title)}}">{{$title}}</a></li>--}}
                        {{--							<li><a href="#">Headphones</a></li>--}}
                        <li class="active">Carts</li>
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
            <!-- row -->
            @foreach($products as $product)
            <form action="{{route('product.delete.cart',$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Product main img -->
                    @php
                        $images = json_decode($product->product_image);
                    @endphp
                    <div class="col-md-5 col-md-push-1">
                        <div id="product-main-img">


                                <div class="product-preview">
                                    <img src="{{asset('./img/'.$images[0])}}" alt="">
                                </div>



                        </div>
                    </div>

                    <!-- /Product main img -->

                    <!-- Product thumb imgs -->
                    <div class="col-md-2  col-md-pull-5">
                        <div id="product-imgs">

{{--                                <div class="product-preview">--}}
{{--                                    <img src="{{asset('./img/'.$images[1])}}" alt="">--}}
{{--                                </div>--}}

                        </div>
                    </div>
                    <!-- /Product thumb imgs -->

                    <!-- Product details -->
                    <div class="col-md-5">
                        <div class="product-details">
                            <h2 class="product-name">{{$product->product_name}}</h2>
                            {{--                            <input type="hidden" name="title" value="{{$product->title}}">--}}

                            <div>
                                <div class="product-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                                <a class="review-link" href="#">10 Review(s) | Add your review</a>
                            </div>
                            <div>
                                <h3 class="product-price">${{$product->product_price}}</h3>
                                {{--                                <input type="hidden" name="price" value="{{$product->discounted_price}}">--}}
                                <span class="product-available">In Stock</span>
                            </div>
                            <p>{{$product->product_description}}</p>
                            {{--                            <input type="hidden" name="description" value="{{$product->description}}">--}}

                            <div class="product-options">
                                <label>
                                    Size
                                    <select class="input-select">
                                        <option name="size">{{$product->product_size}}</option>
                                    </select>
                                    {{--                                    <input type="hidden" name="size" value="{{$product->size}}">--}}

                                </label>
                                <label>
                                    Color
                                    @php
                                         $user_id = auth()->id();
                                         $wishlish_id = App\Models\Wishlist::where('product_id', $product->id)->get();
                                    @endphp
                                    <select name="color" class="input-select">
                                        <option>{{$product->product_color}}</option>
                                    </select>
                                </label>
                            </div>

                            <div class="add-to-cart">
                                <div class="qty-label">
                                    Qty
                                    <div class="input-number">
                                        <input type="number" disabled name="quantity" value="1">
                                    </div>
                                </div>
                                <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> delete from cart</button>
                            </div>
                            <ul class="product-links">
                                <li>Category:</li>
                                <li><a href="{{url('category/Headphones')}}">Headphones</a></li>
                                <li><a href="{{url('category/Accessories')}}">Accessories</a></li>
                            </ul>

                            <ul class="product-links">
                                <li>Share:</li>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i></a></li>
                            </ul>

                        </div>
                    </div>

                </div>
            </form>
            @endforeach
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->



@endsection
