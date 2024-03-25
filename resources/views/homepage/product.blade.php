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
							<li>All Categories</li>
							<li><a href="{{url('category/'.$title)}}">{{$title}}</a></li>
{{--							<li><a href="#">Headphones</a></li>--}}
							<li class="active">{{$product->title}}</li>
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
                <form action="{{route('product.add.cart',$product->id)}}" method="POST" enctype="multipart/form-data">
				    @csrf
                    <div class="row">
					<!-- Product main img -->

					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
                            @php
                                $images = json_decode($product->images);
                            @endphp
                            @foreach($images as $image)
							<div class="product-preview">
								<img style="height: 400px" src="{{asset('./img/'.$image)}}" alt="">
							</div>
                            @endforeach
                            <input type="hidden" name="image" value="{{$images[0]}}">

                        </div>
					</div>

					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
                            @foreach($images as $image)
							<div class="product-preview">
								<img style="height: 150px" src="{{asset('./img/'.$image)}}" alt="">
							</div>
                            @endforeach
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name">{{$product->title}}</h2>
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
                                @if($product->discounted_price === Null)
                                    <h3 class="product-price">${{$product->price}}</h3>
                                @else
                                    <h3 class="product-price">${{$product->discounted_price}} <del class="product-old-price">${{$product->price}}</del></h3>
                                @endif{{--                                <input type="hidden" name="price" value="{{$product->discounted_price}}">--}}
                                <span class="product-available">In Stock</span>
							</div>
							<p>{{$product->description}}</p>
{{--                            <input type="hidden" name="description" value="{{$product->description}}">--}}

							<div class="product-options">
								<label>
									Size
									<select class="input-select">
										<option name="size" value="{{$product->size}}">{{$product->size}}</option>
									</select>
{{--                                    <input type="hidden" name="size" value="{{$product->size}}">--}}

                                </label>
								<label>
									Color
                                    @php
                                        $colors = json_decode($product->colors);
                                         $user_id = auth()->id();
                                         $wishlish_id = App\Models\Wishlist::where('product_id', $product->id)->get();
                                    @endphp
									<select name="color" class="input-select">
                                        @foreach($colors as $color)
										<option  value="{{$color}}">{{$color}}</option>
                                        @endforeach
									</select>
								</label>
							</div>

							<div class="add-to-cart">
								<div class="qty-label">
									Qty
									<div class="input-number">
										<input type="number" name="quantity" value="1">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<button type="submit" class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
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
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
								<li><a data-toggle="tab" href="#tab2">Details</a></li>
								<li><a data-toggle="tab" href="#tab3">Reviews (3)</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
                                            <p>{{$product->description}}</p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
                                            <p>{{$product->details}}</p>
										</div>
									</div>
								</div>
								<!-- /tab2  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>4.5</span>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
													</div>
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 80%;"></div>
														</div>
														<span class="sum">3</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 60%;"></div>
														</div>
														<span class="sum">2</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
														</div>
													</li>
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
														</div>
													</li>
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
														</div>
													</li>
												</ul>
												<ul class="reviews-pagination">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#">4</a></li>
													<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
												</ul>
											</div>
										</div>
										<!-- /Reviews -->

										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												<form class="review-form">
													<input class="input" type="text" placeholder="Your Name">
													<input class="input" type="email" placeholder="Your Email">
													<textarea class="input" placeholder="Your Review"></textarea>
													<div class="input-rating">
														<span>Your Rating: </span>
														<div class="stars">
															<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
														</div>
													</div>
													<button class="primary-btn">Submit</button>
												</form>
											</div>
										</div>
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
                </form>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Related Products</h3>
						</div>
					</div>

					<!-- product -->
                    @php
                        $related_p = \App\Models\Products::where('category_id',$product->category_id)->inRandomOrder()->limit(4)->get();
//                        dd($related_p);
                    @endphp
                    @foreach( $related_p as $r)
                        @php
                            $images = json_decode($r->images);
                            $wishlish_id = App\Models\Wishlist::where('product_id', $r->id)->get();
//                            dd($images);
                        @endphp
					<div class="col-md-3 col-xs-6">
						<div class="product">
							<div class="product-img">
								<img style="height: 240px" src="{{asset('./img/'.$images[0])}}" alt="">
								<div class="product-label">
									<span class="sale">-30%</span>
								</div>
							</div>
							<div class="product-body">
								<p class="product-category">{{$title}}</p>
								<h3 class="product-name"><a href="{{url('/category/'.$title.'/'.$r->id)}}">{{$r->title}}</a></h3>
                                @if($r->discounted_price === Null)
                                    <h4 class="product-price">${{$r->price}}</h4>
                                @else
                                    <h4 class="product-price">${{$r->discounted_price}} <del class="product-old-price">${{$r->price}}</del></h4>
                                @endif
                                <div class="product-rating">
								</div>
								<div class="product-btns">
                                    @if($wishlish_id->isNotEmpty())
									    <button onclick="deleteFromWishlist({{ $r->id }})" class="add-to-wishlist"><i class="fa fa-heart"></i><span class="tooltipp">delete wishlist</span></button>
                                    @else
                                        <button onclick="addToWishlist({{ $r->id }})" class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>
                                    @endif
                                    <button onclick="quickView('{{route('category.show',$title.'/'.$r->id)}}')" class="quick-view"><i class="fa fa-eye" ><a href="{{url('/category/'.$title.'/'.$r->id)}}"></a></i><span class="tooltipp" >quick view</span></button>
                                </div>
							</div>
{{--							<div class="add-to-cart">--}}
{{--								<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>--}}
{{--							</div>--}}
						</div>
					</div>
                    @endforeach
					<!-- /product -->


				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->

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
