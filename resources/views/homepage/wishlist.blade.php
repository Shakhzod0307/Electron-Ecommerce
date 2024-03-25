
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
                        <li class="active">Wishlist</li>
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
                <!-- STORE -->
                <div id="store" class="col-md-12">
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
{{--                            @php dd($product->title) @endphp--}}
                                <form action="{{ route('product.add.cart', $product->id) }}" method="POST">
                                    @csrf
                                    <div class="col-md-3 col-xs-6">
                                        <div class="product">
                                            <div class="product-img">
                                                @php
                                                    $images = json_decode($product->images);
                                                    $colors = json_decode($product->colors);
                                                    $qq = 1;
                                                    $user_id = auth()->id();
                                                    $wishlist_id = App\Models\Wishlist::where('product_id', $product->id)->get();
                                                    $title = \Illuminate\Support\Facades\DB::select('select title from categories where id = ?',[$product->id]);
                                                    $t = null;
                                                    foreach ($title as $t){
                                                       $t = $t->title;
                                                    }
//                                                    dd($t)
                                                @endphp

                                                <img style="height: 212.49px" src="{{ asset('img/' . $images[0]) }}" alt="">
                                                <div class="product-label">
                                                    <span class="sale">-30%</span>
                                                    <span class="new">NEW</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $product->title }}</p>
                                                <h3 class="product-name"><a href="{{ url('category/' . $t . '/' . $product->id) }}">{{ $product->title }}</a></h3>
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
                                                    @if($wishlist_id->isNotEmpty())
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
                                                    <button type="button" onclick="quickView('{{ route('category.show', [$t, $product->id]) }}')" class="quick-view">
                                                        <i class="fa fa-eye"></i>
                                                        <span class="tooltipp">quick view</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <input type="hidden" name="color" value="{{ $product->colors }}">
                                            <input type="hidden" name="quantity" value="{{ $qq }}">
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
{{--                    <div class="store-filter clearfix">--}}
{{--                        <span class="store-qty">Showing 20-100 products</span>--}}
{{--                        @if($products->count()>0) {{ $products->links('pagination::bootstrap-4') }}@endif--}}
{{--                    </div>--}}
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

