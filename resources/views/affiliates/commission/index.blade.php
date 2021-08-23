@extends('layouts.affiliates')

@section('base-content')
<div class="wrapper wrapper-content animated fadeIn">
    <div class="row">
         <!-- Weekly Commission col -->
        <div class="col-sm-12 col-lg-6 col-md-6">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Weekly Commission</h5>
                </div>
                <div class="ibox-content">
                        <form method="POST" action="{{url('commission/weekly')}}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <select class="form-control m-b" name="week_ending">
                                        @if(!empty($response->pendingPost))
                                        @foreach($response->pendingPost as $w)
                                            <option value="{{$w->end_date}}#pedingPost">
                                                Commission Period Ending {{substr($w->end_date,0,10)}}</option>
                                        @endforeach
                                        @endif
                                        @foreach ($response->weeks as $week)
                                            <option value="{{$week}}" {{isset($week_ending) && $week_ending == $week ? 'selected':''}}>
                                            Week Ending {{substr($week,0,10)}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if(isset($response->week_commission_detail))
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Commission Type</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($response->week_commission_detail) > 0)
                                        @foreach($response->week_commission_detail as $wcd)
                                            <tr>
                                                <td>
                                                    <form method="POST" action="{{url('commission/weekly/details')}}">
                                                        @csrf
                                                        <input type="hidden" name="week_ending"value="{{$response->week_ending}}"/>
                                                        <a href="#" style="text-decoration: none;" onclick="$(this).closest('form').submit(); return false;">First Order Bonus</a>
                                                    </form>
                                                </td>
                                                <td>${{number_format($wcd->total,2)}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    @if ($response->binaryCommission)
                                        <tr>
                                            <td>
                                                <form method="POST"action="{{url('commission/weekly/details')}}">
                                                    @csrf
                                                    <input type="hidden" name="binary_week_ending" value="{{$response->week_ending}}"/>
                                                    <a href="#" style="text-decoration: none;" onclick="$(this).closest('form').submit(); return false;">Binary Commission</a>
                                                </form>
                                            </td>
                                            <td>${{number_format($response->binaryCommission, 2)}}</td>
                                        </tr>
                                    @endif
                                    @if (isset($response->adjustment5_12) && !empty($response->adjustment5_12))
                                        <tr>
                                            <td>Adjustment</td>
                                            <td>${{ number_format($response->adjustment5_12, 2) }}</td>
                                        </tr>
                                    @endif
                                    @if (isset($response->adjustment5_19) && !empty($response->adjustment5_19))
                                        <tr>
                                            <td>Adjustment</td>
                                            <td>${{ number_format($response->adjustment5_19, 2) }}</td>
                                        </tr>
                                    @endif
                                    @if (isset($response->adjustment5_26) && !empty($response->adjustment5_26))
                                        <tr>
                                            <td>Adjustment</td>
                                            <td>${{ number_format($response->adjustment5_26, 2) }}</td>
                                        </tr>
                                    @endif
                                    @if (isset($response->adjustment6_02) && !empty($response->adjustment6_02))
                                        <tr>
                                            <td>Adjustment</td>
                                            <td>${{ number_format($response->adjustment6_02, 2) }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        @endif

                </div>
            </div>
        </div>
        <!-- Montly Comission Col -->
        <div class="col-sm-12 col-lg-6 col-md-6">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Monthly Commission</h5>
                </div>
                <div class="ibox-content">
                    <form method="POST" action="{{url('commission/weekly')}}">
                        @csrf
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <select class="form-control m-b" name="unilevel_date">
                                    @forelse($response->monthCommissionDates as $item)
                                        <option value="{{ $item }}" {{isset($selected) && $selected ==  $item ? 'selected' : ''}}>
                                            Month Ending {{ substr($item, 0, 10) }}
                                            @if($item == '2019-05-31 23:59:59')
                                                Adjusted
                                            @endif
                                        </option>
                                    @empty
                                        <p>Empty Response</p>
                                    @endforelse
                                </select>
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @if(isset($response->selected))
                        <table class="table">
                            <tbody>
                                @foreach($response->unilevelCommissions as $item)
                                    <tr>
                                        <td>
                                            <form method="POST" action="{{route('unilevel-commissions')}}">
                                                @csrf
                                                <input type="hidden" name="date" value="{{$item->end_date}}"/>
                                                <a href="#" style="text-decoration: none;" onclick="$(this).closest('form').submit(); return false;">Unilevel Commission</a>
                                            </form>
                                        </td>
                                        <td>
                                            ${{ number_format($item->sum,2) }}
                                        </td>
                                    </tr>
                                    @if($item->end_date == '2019-05-31 23:59:59' && isset($adjustment_5_31) && !empty($adjustment_5_31))
                                        <tr>
                                            <td>Adjustment</td>
                                            <td>{{ $adjustment_5_31 }}</td>
                                        </tr>
                                    @endif
                                @endforeach

                                @foreach($response->leadershipCommissions as $item)
                                    @if($response->selected !== '2019-05-31 23:59:59')
                                        <tr>
                                            <td>
                                                <form method="POST" action="{{route('leadership-commissions')}}">
                                                    @csrf
                                                    <input type="hidden" name="date" value="{{$item->end_date}}"/>
                                                    <a href="#" style="text-decoration: none;" onclick="$(this).closest('form').submit(); return false;">Leadership Commission</a>
                                                </form>
                                            </td>
                                            <td>
                                                ${{ number_format($item->sum,2) }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                                @foreach($response->tsbCommissions as $item)
                                    <tr>
                                        <td>
                                            <form method="POST" action="{{route('tsb-commissions')}}">
                                                @csrf
                                                <input type="hidden" name="date" value="{{$item->end_date}}"/>
                                                <a href="#" style="text-decoration: none;" onclick="$(this).closest('form').submit(); return false;">TSB Commission</a>
                                            </form>
                                        </td>
                                        <td>
                                            ${{ number_format($item->sum,2) }}
                                        </td>
                                    </tr>
                                    @if($item->end_date == '2019-05-31 23:59:59' && isset($adjustment_5_31) && !empty($adjustment_5_31))
                                        <tr>
                                            <td>Adjustment</td>
                                            <td>{{ $adjustment_5_31 }}</td>
                                        </tr>
                                    @endif
                                @endforeach

                                @foreach($response->promoCommissions as $item)
                                    @if($response->selected !== '2019-05-31 23:59:59')
                                        <tr>
                                            <td>
                                                <form method="POST" action="{{route('promo-commissions')}}">
                                                    @csrf
                                                    <input type="hidden" name="date" value="{{$item->end_date}}"/>
                                                    <a href="#" style="text-decoration: none;" onclick="$(this).closest('form').submit(); return false;">Promo Commission</a>
                                                </form>
                                            </td>
                                            <td>
                                                {{ $item->sum }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach

                                @foreach($response->vibeCommissions as $item)
                                    <tr>
                                        <td>
                                            <form method="POST" action="{{route('vibe-commissions')}}">
                                                @csrf
                                                <input type="hidden" name="date" value="{{$item->end_date}}"/>
                                                <a href="#" style="text-decoration: none;" onclick="$(this).closest('form').submit(); return false;">VIBE Commission</a>
                                            </form>
                                        </td>
                                        <td>
                                            ${{ number_format($item->sum,2) }}
                                        </td>
                                    </tr>
                                    @if($item->end_date == '2019-05-31 23:59:59' && isset($adjustment_5_31) && !empty($adjustment_5_31))
                                        <tr>
                                            <td>Adjustment</td>
                                            <td>{{ $adjustment_5_31 }}</td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    @endif
                </div><!-- end-box-content -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 ">
            @if(isset($response->commissions))
            <div class="ibox">
                <div class="ibox-title">
                <h5>Commission Details (First Order Bonus)</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover dataTables-example dataTable ib-table" id="fast-start-bonus-table">
                            <thead>
                                <tr role="row">
                                    <th>Name</th>
                                    <th>Level</th>
                                    <th>Memo</th>
                                    <th>Bonus Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($response->commissions as $c)
                                <tr>
                                    <td>{{$c->firstname}} {{$c->lastname}}</td>
                                    <td>{{$c->level}}</td>
                                    <td>{{$c->memo}}</td>
                                    <td>${{number_format($c->amount,2)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @elseif(isset($response->binaryCommissions))
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Binary Commission Details</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover dataTables-example dataTable ib-table" id="binay-commission-details-table">
                                <thead role="row">
                                    <tr>
                                        <th>Carryover Left</th>
                                        <th>Carryover Right</th>
                                        <th>Total Volume Left</th>
                                        <th>Total Volume Right</th>
                                        <th>Gross Volume Left/Right</th>
                                        <th>Commission Percent</th>
                                        <th>Amount Earned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php $showBinaryCommissionsMessage = false; @endphp
                                    @foreach($response->binaryCommissions as $c)
                                        <tr>
                                            <td>{{ number_format($c->carryover_left,2) }}</td>
                                            <td>{{ number_format($c->carryover_right,2) }}</td>
                                            <td>{{ number_format($c->total_volume_left,2) }}</td>
                                            <td>{{ number_format($c->total_volume_right,2) }}</td>
                                            <td>{{ number_format($c->gross_volume,2) }}</td>
                                            <td>{{ $c->commission_percent }}</td>
                                            <td>{{ number_format($c->amount_earned,2) }}</td>
                                        </tr>
                                        @php
                                        if (!$showBinaryCommissionsMessage) {
                                            $expectedAmountEarned = $c->gross_volume * $c->commission_percent;
                                            if ($expectedAmountEarned != $c->amount_earned) {
                                                $showBinaryCommissionsMessage = true;
                                            }
                                        }
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if ($showBinaryCommissionsMessage)
                            <p style="color: red;"><b>60% Max Payout Applied</b></p>
                        @endif
                    </div>

                </div>
            @elseif(isset($response->montlyCommissions))
                <div class="ibox">
                    <div class="ibox-title">
                         Commission Details
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover dataTables-example dataTable ib-table" id="montly-commissions-table">
                                <thead>
                                    @if ($response->typeCommission != 'vibe')
                                        <tr role="row">
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Paid Rank</th>
                                            <th>Amount</th>
                                        </tr>
                                    @else
                                        <tr role="row">
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Ride ID</th>
                                            <th>Amount</th>
                                        </tr>
                                    @endif
                                </thead>
                                <tbody>
                                    @foreach($response->montlyCommissions as $c)
                                        <tr>
                                            @if ($response->typeCommission == 'promo')
                                            <td>Promotional Commission</td>
                                                <td>{{ $c->promo }}</td>
                                                <td></td>
                                                <td>{{ $c->amount }}</td>
                                            @elseif ($response->typeCommission == 'vibe')
                                                <td>{{( $c->rider_id ? $c->rider_name : $c->driver_name)}}</td>
                                                <td>{{( $c->rider_id ? 'Rider' : 'Driver')}}</td>
                                                <td>{{ $c->ride_id }}</td>
                                                <td>{{ $c->direct_payout }}</td>
                                            @else
                                                <td>{{ $c->order->order->user->firstname }} {{ $c->order->order->user->lastname }}</td>
                                                <td>{{$c->percent * 100}}% {{ $response->typeCommission }} Commission (Level {{ $c->level }}) for product (sku: {{ $c->order->product->sku }}) purchased with order ORD{{ $c->order_id }} on {{ $c->order->order->created_date }}</td>
                                                <td>Level {{ $c->level }}</td>
                                                <td>${{ number_format($c->amount,2)}}</td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
  <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
  <script src="{{ asset('js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('js/ibuumerang/reports/commissions.js') }}"></script>
@endpush
