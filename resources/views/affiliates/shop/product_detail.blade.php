@extends('layouts.affiliates')
@push('styles')
    <link href="{{asset('css/plugins/slick/slick.css')}}" rel="stylesheet">
    <link href="{{asset('css/plugins/slick/slick-theme.css')}}" rel="stylesheet">
@endpush

@section('base-content')
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">    
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h3>{{$product->productname}}</h3>
                </div>
                <div class="ibox-content">
                     <div class="row">
                                <div class="col-md-5">

                                    <div class="product-images" role="toolbar">
                                        <img src="{{Storage::url($product->image_path)}}" width="100%" alt="Product Image">
                                    </div>
                                        
                                </div>
                                <div class="col-md-7">

                                    <h2 class="font-bold m-b-xs">
                                        {{$product->productdesc}}
                                    </h2>
                                    <small>{{$product->productdesc2}}</small>
                                    <div class="m-t-md">
                                        <h2 class="product-main-price">${{$product->price}} <small class="text-muted">Plus Tax</small> </h2>
                                    </div>
                                    <hr>

                                    <h4>Product description</h4>

                                    <div class="small text-muted">
                                        {!! $product->long_description !!}
                                    </div>
                                    <hr>
                                    <div>
                                        <div class="ml-1 row">
                                            <button class="btn btn-primary btn-sm mr-2 btnAddToCart" data-product="{{$product->product_id}}" data-qty="1"><i class="fa fa-cart-plus"></i> Add to cart</button>
                                            <a href="{{route('shop.index')}}" class="btn btn-white btn-sm"> Continue Shopping </a>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                </div> 
                
            </div>
        </div>      
    </div>
</div>
@endsection

