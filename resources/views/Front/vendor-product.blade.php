@extends('layouts.web')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.product_details') }}
@endsection

@section('content')
	<!-- =========================== Breadcrumbs =================================== -->
	<div class="brd_wraps pt-2 pb-2">
		<div class="container">
			<nav aria-label="breadcrumb" class="simple_breadcrumbs">
			  <ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#"><i class="ti-home"></i></a></li>
				<li class="breadcrumb-item active" aria-current="page">{{$vendorProductData->product_name}}</li>
			  </ol>
			</nav>
		</div>
	</div>
	<!-- =========================== Breadcrumbs =================================== -->

	<!-- =========================== Product Detail =================================== -->
	<section>
		<div class="container">
			<div class="row">

            @if ($vendorProductData)
            @foreach ($vendorProductData->product as $productData)
            {{-- {{dd($productData)}} --}}
            <div class="col-3">
            <div class="card " xstyle="height: 10rem;">
                <a href="{{URL::to('products/product-details/'.$productData->slug)}}">
                <img  height="230px" class="card-img-top" src="{{$productData->productimage->image_url}}" alt="Card image cap">
            </a>
                <div class="card-body">

                  <h4 class=" card-text">  <a href="{{URL::to('products/product-details/'.$productData->slug)}}">
                    {{Str::limit($productData->product_name, 32)}}
                </a></h4>
                <div class="woo_price mt-2">
                    <h6>{{Helper::CurrencyFormatter($productData->product_price)}}<span class="less_price">{{Helper::CurrencyFormatter($productData->discounted_price)}}</span></h6>
                    {{-- <h6><i class="fa fa-star filled"></i> {{number_format($productData->ratings,1)}}</h6> --}}
                </div>
                @if($productData->product_price)
                    <span class="post-article-cat theme-bg mt-2">{{ trans('labels.save') }} {{Helper::CurrencyFormatter( $productData->product_price - $productData->discounted_price )}}</span>
                @endif
                </div>
              </div>
            </div>
            @endforeach

            @endif

				{{-- <div class="col-lg-4 col-md-6 col-sm-12">
					<div class="sp-wrap">
						@foreach($product['productimages'] as $images)
							<a href="{{$images->image_url}}"><img src="{{$images->image_url}}" alt=""></a>
						@endforeach
					</div>
				</div> --}}



			</div>



		</div>
	</section>
	<!-- =========================== Product Detail =================================== -->

	<!-- =========================== Related Products =================================== -->

	<!-- =========================== Related Products =================================== -->

@endsection

@section('scripttop')

@endsection
