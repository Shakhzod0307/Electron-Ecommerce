@extends('homepage')
@section('content')
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <h3 class="breadcrumb-header">my orders</h3>
                    <ul class="breadcrumb-tree">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active"> my orders</li>
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
                @foreach($orders as $order)
                <form action="{{url('/my/orders')}}" method="POST">
                    @csrf

                    <div class="col-md-7">
                        <!-- Billing Details -->
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Customer</h3>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" disabled name="f_name" placeholder="{{$order->f_name}} {{$order->l_name}}" autocomplete required>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" disabled name="l_name" placeholder="{{$order->phone}}" required>
                            </div>
                            <div class="form-group">
                                <input class="input" type="email" disabled name="email" placeholder="{{$order->email}}" required>
                            </div>
                            <div class="form-group">
                                <input class="input" type="text" disabled name="address" placeholder="{{$order->address}}" required>
                            </div>

                        </div>
                        <!-- /Billing Details -->

                        <div class="order-notes">
                            <textarea class="input" disabled name="order_note" placeholder="{{$order->order_note}}"></textarea>
                        </div>
                        <!-- /Order notes -->
                    </div>

                    <!-- Order Details -->
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">Your Order</h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>PRODUCT</strong></div>
                                <div><strong>TOTAL</strong></div>
                            </div>
                            <div class="order-products">
                                @php
                                    $total = 0;
                                    $products = json_decode($order->products);

//                                    dd($products)
                                @endphp

                            @foreach($products as $product)
                                @php
                                    $images = json_decode($product->product_image);
//                                    dd($images);
                                @endphp

                                    <div class="order-col">
                                        <div><img style="width: 80px;height: 80px" src="{{asset('./img/'.$images[0])}}" alt=""></div>
                                        <div> {{$product->quantity}}x {{$product->product_name}}</div>
                                        <div>${{$product->product_price}}</div>
                                    </div>
                                    @php
                                        $total += $product->product_price;
                                    @endphp
                                @endforeach
                            </div>
                            <div class="order-col">
                                <div>Shiping</div>
                                <div><strong>FREE</strong></div>
                            </div>
                            <div class="order-col">
                                <div><strong>TOTAL PRICE</strong></div>
                                <div><strong class="order-total">${{$order->total_price}}</strong></div>
                            </div>
                        </div>

                        <div class="input-checkbox">
{{--                            <input type="checkbox" id="terms">--}}
                            <label for="terms">
                                <span></span>
{{--                                I've read and accept the <a href="#">terms & conditions</a>--}}
                            </label>
                        </div>

                    </div>
                </form>
                @endforeach

            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
@endsection
