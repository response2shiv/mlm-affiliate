@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title col-lg-12">
                    <h3>Shop</h3>
                    <div class="d-inline ibox-tools col-lg-3">
                        <form class="form-group" action="{{ route('shop.index') }}" method="POST">
                            @csrf
                            Sort By:
                            <select class="form-group" name="sort" id="sort" onchange="this.form.submit();">
                                <option value='desc' {{ $sort == 'desc' ? 'selected=selected' : ''}} >Highest Price</option>
                                <option value='asc' {{ $sort == 'asc' ? 'selected=selected' : ''}}>Lowest Price</option>
                            </select>
                        </form>
                    </div>
                </div>

                <div class="ibox-content">
                    <div class="row">
                        @forelse ($response->products as $product)
                        <div class="col-md-3">
                            <div class="ibox">
                                <div class="ibox-content product-box">
                                    @if(Storage::exists($product->image_path))
                                        <div class="product-imitation">
                                            <img src="{{Storage::url($product->image_path)}}" width="100%" alt="Product Image">
                                        </div>
                                    @endif
                                    <div class="product-desc">
                                        <span class="product-price">
                                            ${{$product->price}}
                                        </span>
                                        {{-- <small class="text-muted">Category</small> --}}
                                        <a href="#" class="product-name"> {{$product->productname}}</a>

                                        <div class="small m-t-xs">
                                            {{$product->productdesc}}
                                        </div>
                                        <div class="row">
                                            <div class="m-t text-righ col-4">
                                                <a href="{{ route('product.details', $product->product_id) }}" class="btn btn-xs btn-outline btn-success">Info <i class="fa fa-long-arrow-right"></i> </a>
                                            </div>
                                            <div class="m-t text-righ col-6">
                                                <button class="btn btn-xs btn-success btnAddToCart" data-product="{{$product->product_id}}" data-qty="1">Add to cart <i class="fa fa-shopping-cart"></i> </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="col-md-3">
                                No products found for your country.
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
