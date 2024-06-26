
@extends('homepage')
@section('content')
@if(Session('message'))
    <div class="alert-success alert text-center">
        {{Session('message')}}
    </div>
@endif
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li>All Categories</li>
                        <li class="active">{{$title}}</li>
{{--                        <li class="active">Headphones (227,490 Results)</li>--}}
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
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Categories</h3>
                        <div class="checkbox-filter">

                            <div class="input-checkbox">
                                <input type="checkbox" id="category-1">
                                <label for="category-1">
                                    <span></span>
                                    Laptops
                                    <small>(120)</small>
                                </label>
                            </div>

                            <div class="input-checkbox">
                                <input type="checkbox" id="category-2">
                                <label for="category-2">
                                    <span></span>
                                    Smartphones
                                    <small>(740)</small>
                                </label>
                            </div>

                            <div class="input-checkbox">
                                <input type="checkbox" id="category-3">
                                <label for="category-3">
                                    <span></span>
                                    Cameras
                                    <small>(1450)</small>
                                </label>
                            </div>

                            <div class="input-checkbox">
                                <input type="checkbox" id="category-4">
                                <label for="category-4">
                                    <span></span>
                                    Accessories
                                    <small>(578)</small>
                                </label>
                            </div>

                            <div class="input-checkbox">
                                <input type="checkbox" id="category-5">
                                <label for="category-5">
                                    <span></span>
                                    Laptops
                                    <small>(120)</small>
                                </label>
                            </div>

                            <div class="input-checkbox">
                                <input type="checkbox" id="category-6">
                                <label for="category-6">
                                    <span></span>
                                    Smartphones
                                    <small>(740)</small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Price</h3>
                        <div class="price-filter">
                            <div id="price-slider"></div>
                            <div class="input-number price-min">
                                <input id="price-min" type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                            <span>-</span>
                            <div class="input-number price-max">
                                <input id="price-max" type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Brand</h3>
                        <div class="checkbox-filter">
                            <div class="input-checkbox">
                                <input type="checkbox" id="brand-1">
                                <label for="brand-1">
                                    <span></span>
                                    SAMSUNG
                                    <small>(578)</small>
                                </label>
                            </div>
                            <div class="input-checkbox">
                                <input type="checkbox" id="brand-2">
                                <label for="brand-2">
                                    <span></span>
                                    LG
                                    <small>(125)</small>
                                </label>
                            </div>
                            <div class="input-checkbox">
                                <input type="checkbox" id="brand-3">
                                <label for="brand-3">
                                    <span></span>
                                    SONY
                                    <small>(755)</small>
                                </label>
                            </div>
                            <div class="input-checkbox">
                                <input type="checkbox" id="brand-4">
                                <label for="brand-4">
                                    <span></span>
                                    SAMSUNG
                                    <small>(578)</small>
                                </label>
                            </div>
                            <div class="input-checkbox">
                                <input type="checkbox" id="brand-5">
                                <label for="brand-5">
                                    <span></span>
                                    LG
                                    <small>(125)</small>
                                </label>
                            </div>
                            <div class="input-checkbox">
                                <input type="checkbox" id="brand-6">
                                <label for="brand-6">
                                    <span></span>
                                    SONY
                                    <small>(755)</small>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- /aside Widget -->

                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Top selling</h3>
                        @php
                            $topsell = \App\Models\Products::where('price', '>', 50)->inRandomOrder()->limit(3)->get();

                        @endphp
                        @foreach($topsell as $top)
                            @php
                                $images = json_decode($top->images);
                                $category_title = \App\Models\Category::where('id',$top->category_id)->value('title');
//                                dd($category_title);
                            @endphp
                        <div class="product-widget">
                            <div class="product-img">
                                <img src="{{asset('./img/'.$images[0])}}" alt="">
                            </div>
                            <div class="product-body">
                                <p class="product-category">{{$category_title}}</p>
                                <h3 class="product-name"><a href="{{url('category/'.$category_title.'/'.$top->id)}}">{{$top->title}}</a></h3>
                                @if($top->discounted_price === Null)
                                    <h4 class="product-price">${{$top->price}}</h4>
                                @else
                                    <h4 class="product-price">${{$top->discounted_price}} <del class="product-old-price">${{$top->price}}</del></h4>
                                @endif
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <!-- /aside Widget -->
                </div>
                <!-- /ASIDE -->

                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- store top filter -->
                    <div class="store-filter clearfix">
                        <div class="store-sort">
                            <label>
                                Sort By:
                                <select class="input-select">
                                    <option value="0">Popular</option>
                                    <option value="1">Position</option>
                                </select>
                            </label>

                            <label>
                                Show:
                                <select class="input-select">
                                    <option value="0">20</option>
                                    <option value="1">50</option>
                                </select>
                            </label>
                        </div>
                        <ul class="store-grid">
                            <li class="active"><i class="fa fa-th"></i></li>
                            <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                        </ul>
                    </div>
                    <!-- /store top filter -->

                    <!-- store products -->
                    <div class="row">
                        <!-- product -->
                        @foreach($products as $product)
                            <form action="{{route('product.add.cart',$product->id)}}" method="POST">
                                @csrf
                            <div class="col-md-4 col-xs-6">
                                <div class="product">
                                    <div class="product-img">
                                        @php
                                            $images = json_decode($product->images);
                                            $colors = json_decode($product->colors);
                                            $qq = 1;
                                            $user_id = auth()->id();
                                            $wishlish_id = App\Models\Wishlist::where('product_id', $product->id)->get();
                                        @endphp

                                        <img style="height:212.49px" src="{{ asset('img/' . $images[0]) }}" alt="">
                                        <div class="product-label">
{{--                                            <span class="sale">-30%</span>--}}
{{--                                            <span class="new">NEW</span>--}}
                                        </div>
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{$title}}</p>
                                        <h3 class="product-name"><a href="{{url('category/'.$title.'/'.$product->id)}}">{{$product->title}}</a></h3>
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
                                    <input type="hidden" name="color" value="{{$product->colors}}">
                                    <input type="hidden" name="quantity" value="{{$qq}}">
                                    <div class="add-to-cart">
                                        <button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
                                    </div>
                                </div>
                            </div>
                            </form>
                        @endforeach
                        <!-- /product -->


{{--                        <div class="clearfix visible-sm visible-xs"></div>--}}

                    </div>
                    <!-- /store products -->

                    <!-- store bottom filter -->
                    <div class="store-filter clearfix">
{{--                        <span class="store-qty">Showing 20-100 products</span>--}}
                        @if($products->count()>0) {{ $products->links('pagination::bootstrap-4') }}@endif

                    </div>
                    <!-- /store bottom filter -->
                </div>
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->


<style>
    .product .product-body .product-btns>a {
        position:relative;
        width: 40px;
        height: 40px;
        line-height: 40px;
        background: transparent;
        border: none;
        -webkit-transition: 0.2s all;
        transition: 0.2s all;
    }
    .product .product-body .product-btns>a:hover {
        background-color: #E4E7ED;
        color: #D10024;
        border-radius: 50%;
    }
    .product .product-body .product-btns>a .tooltipp {
        position: absolute;
        bottom: 100%;
        left: 50%;
        -webkit-transform: translate(-50%, -15px);
        -ms-transform: translate(-50%, -15px);
        transform: translate(-50%, -15px);
        width: 150px;
        padding: 10px;
        font-size: 12px;
        line-height: 10px;
        background: #1e1f29;
        color: #FFF;
        text-transform: uppercase;
        z-index: 10;
        opacity: 0;
        visibility: hidden;
        -webkit-transition: 0.2s all;
        transition: 0.2s all;
    }

    .product .product-body .product-btns>a:hover .tooltipp {
        opacity: 1;
        visibility: visible;
        -webkit-transform: translate(-50%, -5px);
        -ms-transform: translate(-50%, -5px);
        transform: translate(-50%, -5px);
    }
    .red-heart {
        color: red;
    }

</style>
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

