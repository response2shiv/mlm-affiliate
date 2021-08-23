<div class="ibox-content" id="{{ $product->product_id }}">
    <div class="table-responsive">
        <table class="table shoping-cart-table">
            <tbody>
                <tr>    
                    @if(isset($product->product->photos[0]))
                        @if(Storage::exists($product->product->photos[0]->image_path))                        
                            <td width="120" class="d-sm-none d-md-none d-lg-block">
                                <img src="{{ Storage::url($product->product->photos[0]->image_path)  }}" class="img-responsive" style="max-width:100%;max-height: 100%;" />
                            </td>
                        @endif
                    @endif
                    <td class="desc">
                        <h3>
                            <a href="#" class="text-navy">
                                {{ $product->product->productname }}
                            </a>
                        </h3>
                        <p class="small">
                            {{ $product->product->productdesc }}
                        </p>
                        @if(!Request::segment(2) == 'confirmation')
                        <div class="m-t-sm">
                            <a href="#" class="text-muted remove-product" data-product="{{ $product->product_id }}"><i class="fa fa-trash"></i> Remove item</a>
                        </div>
                        @endif
                    </td>
                    <td class="text-nowrap">
                        $ {{ number_format($product->product_price,2) }}
                        <!-- <s class="small text-muted">$ {{ money_format('%i', $product->product_price + 50) }}</s> -->
                    </td>
                    @if(!Request::segment(2) == 'confirmation')
                    <td class="text-nowrap">
                        @if($product->product->allow_quantity_change==1)
                            <input type="number" onkeyup="notAllowNegativeNumber(this); setMaxNumber(this, 500)" size="3" min="1" style="width: 3rem" value="{{ $product->quantity }}" name="{{$product->product->id}}" max="500">
                        @else
                            <input type="number" onkeyup="notAllowNegativeNumber(this)" size="3" min="1" style="width: 3rem" class="form-control" value="{{ $product->quantity }}" disabled >
                        @endif
                    </td>
                    @else
                    <td class="text-nowrap">
                        X {{ $product->quantity }}
                    </td>
                    @endif
                    <td class="text-nowrap">
                    @if($product->product->producttype == 8)
                        <h5>
                            $ {{ number_format($product->product_price * $product->quantity,2) }} <br>
                            <small {{$product->product->is_taxable == 1 ? '' : 'hidden'}}>+ Tax</small>
                        </h5>
                    @else
                        <h5>
                            $ {{ number_format($product->product_price * $product->quantity,2) }} <br>
                        </h5>
                    @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script>
        function notAllowNegativeNumber(obj) {
            if (obj.value < 0) {
                return obj.value = obj.value * -1;
            }

            if (obj.value == 0) {
                return  obj.value = 1;
            }
        }

        function setMaxNumber(obj, max) {
            if (obj.value > max) {
                return obj.value = max;
            }
        }
    </script>
@endpush
