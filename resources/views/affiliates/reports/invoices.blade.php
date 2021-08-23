@extends('layouts.affiliates')

@section('base-content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="ibox">
                    <div class="ibox-title">
                        <h3>Invoice</h3>
                    </div>
                    <div class="ibox-content">
                        <table class="table table-striped ib-table">
                            <thead>
                                <tr>
                                    <th>Order Date</th>
                                    <th>Order Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->created_date }}</td>
                                        <td>USD$ {{number_format($order->ordertotal, 2, '.', ',')}}  
                                        @if(!empty($order->display_amount))
                                            / {{$order->display_amount}}</td>                           
                                        @endif
                                              
                                        <td>
                                            <a href="{{ url('/report/invoice/view/'.$order->id_order) }}" target="_blank" class="text-decoration-none">
                                                <i class="fa fa-eye fa-lg" title="View Invoice"></i>
                                            </a>
                                            <a href="{{ url('/report/invoice/download/'.$order->id_order) }}" target="_blank" class="text-decoration-none">
                                                <i class="fa fa-download fa-lg" title="Download Invoice"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
