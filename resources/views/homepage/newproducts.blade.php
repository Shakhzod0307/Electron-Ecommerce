@extends('homepage')
@section('content')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="./img/shop01.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Laptop<br>Collection</h3>
                            <a href="{{url('category/Laptops')}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="./img/shop03.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Accessories<br>Collection</h3>
                            <a href="{{url('category/Accessories')}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="./img/shop02.png" alt="">
                        </div>
                        <div class="shop-body">
                            <h3>Cameras<br>Collection</h3>
                            <a href="{{url('category/Cameras')}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">New Products</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab1">Laptops</a></li>
                                <li><a data-toggle="tab" href="#tab1">Smartphones</a></li>
                                <li><a data-toggle="tab" href="#tab1">Cameras</a></li>
                                <li><a data-toggle="tab" href="#tab1">Accessories</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    <!-- product -->
                                    @php
                                        $products = \App\Models\Products::where('price','>',50)->inRandomOrder()->get();
                                        $products1 = \App\Models\Products::where('price','>',50)->inRandomOrder()->limit(4)->get();
                                        $products2 = \App\Models\Products::where('price','>',50)->inRandomOrder()->limit(4)->get();
                                        $products3 = \App\Models\Products::where('price','>',50)->inRandomOrder()->limit(4)->get();
                                        $products4 = \App\Models\Products::where('price','>',50)->inRandomOrder()->limit(4)->get();
                                        $products5 = \App\Models\Products::where('price','>',50)->inRandomOrder()->limit(4)->get();
                                        $products6 = \App\Models\Products::where('price','>',50)->inRandomOrder()->limit(4)->get();
//                                        dd($products1,$products2,$products3,$products4,$products5,$products6,);
                                    @endphp
                                        <!-- product -->
                                    @foreach($products as $product)
                                        <form action="{{route('product.add.cart',$product->id)}}" method="POST">
                                            @csrf
                                            @php
                                                $images = json_decode($product->images);
                                                $colors = json_decode($product->colors);
                                                $qq = 1;
                                                $user_id = auth()->id();
                                                $wishlish_id = App\Models\Wishlist::where('product_id', $product->id)->get();
                                                $title = App\Models\Category::where('id', $product->category_id)->value('title');
//                                                dd($colors[0]);
                                            @endphp
                                            <div class="product">
                                        <div class="product-img">
                                            <img style="height: 250px;width: 280px" src="{{asset('./img/'.$images[0])}}" alt="">
                                            <div class="product-label">
{{--                                                <span class="sale">-30%</span>--}}
                                                <span class="new">NEW</span>
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{$title}}</p>
                                            <h3 class="product-name"><a href="{{route('category.show',$title.'/'.$product->id)}}">{{$product->title}}</a></h3>
                                            @if($product->discounted_price === Null)
                                                <h4 class="product-price">${{$product->price}}</h4>
                                            @else
                                            <h4 class="product-price">${{$product->discounted_price}} <del class="product-old-price">${{$product->price}}</del></h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <input type="hidden" name="color" value="{{$colors[0]}}">
                                            <input type="hidden" name="quantity" value="1">
                                            <div class="product-btns">
                                                @if($wishlish_id->isNotEmpty())
                                                    <button type="button" onclick="deleteFromWishlist({{ $product->id }})">
                                                        <i class="fa fa-heart"></i>
                                                        <span class="tooltipp">remove wishlist</span>
                                                    </button>
                                                @else
                                                    <button type="button" onclick="addToWishlist({{ $product->id }})">
                                                        <i class="fa fa-heart-o"></i>
                                                        <span class="tooltipp">add to wishlist</span>
                                                    </button>
                                                @endif
                                                <button type="button" onclick=quickView('{{route('category.show',$title.'/'.$product->id)}}') class="quick-view">
                                                    <i class="fa fa-eye"></i>
                                                    <span class="tooltipp">
                                                    quick view
                                                </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                        </div>
                                    </div>
                                        </form>
                                    @endforeach
                                    <!-- /product -->

                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3>02</h3>
                                    <span>Days</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>10</h3>
                                    <span>Hours</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>34</h3>
                                    <span>Mins</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>60</h3>
                                    <span>Secs</span>
                                </div>
                            </li>
                        </ul>
                        <h2 class="text-uppercase">hot deal this week</h2>
                        <p>New Collection Up to 50% OFF</p>
                        <a class="primary-btn cta-btn" href="{{url('category/Hot%20deals')}}">Shop now</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Top selling</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab2">Laptops</a></li>
                                <li><a data-toggle="tab" href="#tab2">Smartphones</a></li>
                                <li><a data-toggle="tab" href="#tab2">Cameras</a></li>
                                <li><a data-toggle="tab" href="#tab2">Accessories</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    <!-- product -->
                                    @foreach($products as $product)
                                        <form action="{{route('product.add.cart',$product->id)}}" method="POST">
                                            @csrf
                                            @php
                                                $images = json_decode($product->images);
                                                $colors = json_decode($product->colors);
                                                $qq = 1;
                                                $user_id = auth()->id();
                                                $wishlish_id = App\Models\Wishlist::where('product_id', $product->id)->get();
                                                $title = App\Models\Category::where('id', $product->category_id)->value('title');
//                                                dd($colors[0]);
                                            @endphp
                                            <div class="product">
                                        <div class="product-img">
                                            <img style="height: 250px;width: 280px" src="{{asset('./img/'.$images[0])}}" alt="">
                                            <div class="product-label">
{{--                                                <span class="sale">-30%</span>--}}
{{--                                                <span class="new">NEW</span>--}}
                                            </div>
                                        </div>
                                        <div class="product-body">
                                            <p class="product-category">{{$title}}</p>
                                            <h3 class="product-name"><a href="{{route('category.show',$title.'/'.$product->id)}}">{{$product->title}}</a></h3>
                                            @if($product->discounted_price === Null)
                                                <h4 class="product-price">${{$product->price}}</h4>
                                            @else
                                                <h4 class="product-price">${{$product->discounted_price}} <del class="product-old-price">${{$product->price}}</del></h4>
                                            @endif
                                            <div class="product-rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <input type="hidden" name="color" value="{{$colors[0]}}">
                                            <input type="hidden" name="quantity" value="1">
                                            <div class="product-btns">
                                                @if($wishlish_id->isNotEmpty())
                                                    <button type="button" onclick="deleteFromWishlist({{ $product->id }})">
                                                        <i class="fa fa-heart"></i>
                                                        <span class="tooltipp">remove wishlist</span>
                                                    </button>
                                                @else
                                                    <button type="button" onclick="addToWishlist({{ $product->id }})">
                                                        <i class="fa fa-heart-o"></i>
                                                        <span class="tooltipp">add to wishlist</span>
                                                    </button>
                                                @endif
                                                <button type="button" onclick=quickView('{{route('category.show',$title.'/'.$product->id)}}') class="quick-view">
                                                    <i class="fa fa-eye"></i>
                                                    <span class="tooltipp">
                                                    quick view
                                                </span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="add-to-cart">
                                            <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                        </div>
                                    </div>
                                        </form>
                                    @endforeach
                                    <!-- /product -->


                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Top selling</h4>
                        <div class="section-nav">
                            <div id="slick-nav-3" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-3">
                        <div>
                            <!-- product widget -->
                            @foreach($products1 as $product)
                                    @php
                                        $images = json_decode($product->images);
                                        $colors = json_decode($product->colors);
                                        $qq = 1;
                                        $user_id = auth()->id();
                                        $wishlish_id = App\Models\Wishlist::where('product_id', $product->id)->get();
                                        $title = App\Models\Category::where('id', $product->category_id)->value('title');
//                                                dd($colors[0]);
                                    @endphp
                                    <div class="product-widget">
                                <div class="product-img">
                                    <img src="{{asset('./img/'.$images[0])}}" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{$title}}</p>
                                    <h3 class="product-name"><a href="{{route('category.show',$title.'/'.$product->id)}}">{{$product->title}}</a></h3>
                                    @if($product->discounted_price === Null)
                                        <h4 class="product-price">${{$product->price}}</h4>
                                    @else
                                        <h4 class="product-price">${{$product->discounted_price}} <del class="product-old-price">${{$product->price}}</del></h4>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            <!-- /product widget -->

                        </div>
                        <div>
                            <!-- product widget -->
                            @foreach($products2 as $product)
                                    @php
                                        $images = json_decode($product->images);
                                        $colors = json_decode($product->colors);
                                        $qq = 1;
                                        $user_id = auth()->id();
                                        $wishlish_id = App\Models\Wishlist::where('product_id', $product->id)->get();
                                        $title = App\Models\Category::where('id', $product->category_id)->value('title');
//                                                dd($colors[0]);
                                    @endphp
                                    <div class="product-widget">
                                <div class="product-img">
                                    <img src="{{asset('./img/'.$images[0])}}" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{$title}}</p>
                                    <h3 class="product-name"><a href="{{route('category.show',$title.'/'.$product->id)}}">{{$product->title}}</a></h3>
                                    @if($product->discounted_price === Null)
                                        <h4 class="product-price">${{$product->price}}</h4>
                                    @else
                                        <h4 class="product-price">${{$product->discounted_price}} <del class="product-old-price">${{$product->price}}</del></h4>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            <!-- /product widget -->

                        </div>


                    </div>
                </div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Top selling</h4>
                        <div class="section-nav">
                            <div id="slick-nav-4" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-4">
                        <div>
                        @foreach($products3 as $product)
                            @php
                                $images = json_decode($product->images);
                                $colors = json_decode($product->colors);
                                $qq = 1;
                                $user_id = auth()->id();
                                $wishlish_id = App\Models\Wishlist::where('product_id', $product->id)->get();
                                $title = App\Models\Category::where('id', $product->category_id)->value('title');
//                                                dd($colors[0]);
                            @endphp
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="{{asset('./img/'.$images[0])}}" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{$title}}</p>
                                    <h3 class="product-name"><a href="{{route('category.show',$title.'/'.$product->id)}}">{{$product->title}}</a></h3>
                                    @if($product->discounted_price === Null)
                                        <h4 class="product-price">${{$product->price}}</h4>
                                    @else
                                        <h4 class="product-price">${{$product->discounted_price}} <del class="product-old-price">${{$product->price}}</del></h4>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div>
                        @foreach($products4 as $product)
                                @php
                                    $images = json_decode($product->images);
                                    $colors = json_decode($product->colors);
                                    $qq = 1;
                                    $user_id = auth()->id();
                                    $wishlish_id = App\Models\Wishlist::where('product_id', $product->id)->get();
                                    $title = App\Models\Category::where('id', $product->category_id)->value('title');
//                                                dd($colors[0]);
                                @endphp
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{asset('./img/'.$images[0])}}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{$title}}</p>
                                        <h3 class="product-name"><a href="{{route('category.show',$title.'/'.$product->id)}}">{{$product->title}}</a></h3>
                                        @if($product->discounted_price === Null)
                                            <h4 class="product-price">${{$product->price}}</h4>
                                        @else
                                            <h4 class="product-price">${{$product->discounted_price}} <del class="product-old-price">${{$product->price}}</del></h4>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="clearfix visible-sm visible-xs"></div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Top selling</h4>
                        <div class="section-nav">
                            <div id="slick-nav-5" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-5">
                        <div>
                        @foreach($products5 as $product)
                            @php
                                $images = json_decode($product->images);
                                $colors = json_decode($product->colors);
                                $qq = 1;
                                $user_id = auth()->id();
                                $wishlish_id = App\Models\Wishlist::where('product_id', $product->id)->get();
                                $title = App\Models\Category::where('id', $product->category_id)->value('title');
//                                                dd($colors[0]);
                            @endphp
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="{{asset('./img/'.$images[0])}}" alt="">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{$title}}</p>
                                    <h3 class="product-name"><a href="{{route('category.show',$title.'/'.$product->id)}}">{{$product->title}}</a></h3>
                                    @if($product->discounted_price === Null)
                                        <h4 class="product-price">${{$product->price}}</h4>
                                    @else
                                        <h4 class="product-price">${{$product->discounted_price}} <del class="product-old-price">${{$product->price}}</del></h4>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        </div>
                        <div>
                        @foreach($products6 as $product)
                                @php
                                    $images = json_decode($product->images);
                                    $colors = json_decode($product->colors);
                                    $qq = 1;
                                    $user_id = auth()->id();
                                    $wishlish_id = App\Models\Wishlist::where('product_id', $product->id)->get();
                                    $title = App\Models\Category::where('id', $product->category_id)->value('title');
//                                                dd($colors[0]);
                                @endphp
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{asset('./img/'.$images[0])}}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{$title}}</p>
                                        <h3 class="product-name"><a href="{{route('category.show',$title.'/'.$product->id)}}">{{$product->title}}</a></h3>
                                        @if($product->discounted_price === Null)
                                            <h4 class="product-price">${{$product->price}}</h4>
                                        @else
                                            <h4 class="product-price">${{$product->discounted_price}} <del class="product-old-price">${{$product->price}}</del></h4>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <script>
        function addToWishlist(productId) {
            // Create a form element
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('product.add.wishlist', ':id') }}".replace(':id', productId);
            form.style.display = 'none'; // Hide the form

            // Add CSRF token input
            var csrfTokenInput = document.createElement('input');
            csrfTokenInput.type = 'hidden';
            csrfTokenInput.name = '_token';
            csrfTokenInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfTokenInput);

            // Append form to the body and submit
            document.body.appendChild(form);
            form.submit();
        }
        function deleteFromWishlist(productId) {
            // Create a form element
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('product.delete.wishlist', ':id') }}".replace(':id', productId);
            form.style.display = 'none'; // Hide the form

            // Add CSRF token input
            var csrfTokenInput = document.createElement('input');
            csrfTokenInput.type = 'hidden';
            csrfTokenInput.name = '_token';
            csrfTokenInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfTokenInput);

            // Append form to the body and submit
            document.body.appendChild(form);
            form.submit();
        }
        function quickView(url) {
            window.location.href = url;
            // console.log('Redirecting to: ' + url);
        }

    </script>
@endsection
