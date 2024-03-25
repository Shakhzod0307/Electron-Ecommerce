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
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
							<li><a href="{{url('/')}}">Home</a></li>
							<li class="active">Checkout</li>
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
                <form action="{{url('/product/orders')}}" method="POST">
                    @csrf

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Shipping address</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="f_name" placeholder="First Name" autocomplete required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="l_name" placeholder="Last Name" required>
							</div>
							<div class="form-group">
								<input class="input" type="email" name="email" placeholder="Email" required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="address" placeholder="Address" required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="city" placeholder="City" required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="country" placeholder="Country" required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="z_code" placeholder="ZIP Code" required>
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="phone" placeholder="Telephone" required>
							</div>
						</div>
						<!-- /Billing Details -->

						<!-- Order notes -->
						<div class="order-notes">
							<textarea class="input" name="order_note" placeholder="Order Notes"></textarea>
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
                                @endphp
                                @foreach($carts as $cart)
                                    @php
                                        $images = json_decode($cart->product_image);
    //                                    dd($images);
                                    @endphp
								<div class="order-col">
                                    <input type="hidden" name="quantity" value="{{$cart->product_quantity}}">
                                    <div><img style="width: 80px;height: 80px" src="{{asset('./img/'.$images[0])}}" alt=""></div>
									<div>{{$cart->product_quantity}}x {{$cart->product_name}}</div>
									<div>${{$cart->product_price}}</div>
								</div>
                                    @php
                                        $total += $cart->product_price;
                                    @endphp
                                @endforeach
							</div>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
                                <input type="hidden" name="total_price" value="{{$total}}">
								<div><strong class="order-total">${{$total}}</strong></div>
							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Direct Bank Transfer
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Cheque Payment
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Paypal System
								</label>
								<div class="caption">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
								</div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
                        @if($total > 0)
                            <button class="primary-btn order-submit" type="submit"> Place order</button>
                        @else
                            <button class="primary-btn order-submit" disabled type="submit"> Place order</button>
                        @endif

					</div>
                </form>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
@endsection
