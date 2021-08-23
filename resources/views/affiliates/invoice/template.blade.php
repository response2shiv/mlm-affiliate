<style>
    * {
        margin: 0;
        padding: 0;
        font-family: Arial;
        font-size: 14pt;
        color: #2d2d2d;
    }

    body {
        width: 100%;
        font-family: Arial;
        font-size: 14pt;
        margin: 0;
        padding: 0px;
    }
</style>

<div style='width: 87.2%;height: 20px;margin-bottom: 20px;'>
    <table autosize="1" width="87.2%" style="border-spacing:0;border-collapse: collapse;font-size:11pt;color: #2d2d2d;">
        <tr>
            <td style="width: 15%;height:5%;text-align: left;color: gray;">
                <div>ncrease, LLC</div>
            </td>
        </tr>
        <tr>
            <td style="width: 15%;height:5%;text-align: left;color: gray;">
                <div>8668 John Hickman Parkway, Suite 504</div>
            </td>
        </tr>
        <tr>
            <td style="width: 15%;height:5%;text-align: left;color: gray;">
                <div>Frisco, TX 75034</div>
            </td>
        </tr>
    </table>
</div>

<div style='margin-bottom: 5px;'>
    <table autosize="1" width="87.2%" style="border-spacing:0;border-collapse: collapse;font-size:11pt;color: #2d2d2d;">
        <tr>
            <td style="width: 15%;height:5%;text-align: left;color: gray;">
                <div>Email: support@ncrease.com</div>
            </td>
        </tr>
    </table>
</div>

<div style="margin-bottom: 25px;"><img src='{{asset('assets/images/invoice/inv_line.png')}}' /></div>

<div style='width: 110%;height: 20px;margin-bottom: 30px;'>
    <table autosize="1" width="110%" style="border-spacing:0;border-collapse: collapse;font-size:11pt;color: #2d2d2d;">
        <tr>
            <td style="width: 15%;height:5%;text-align: left;color: gray;">
                <div>Bill to :</div>
            </td>
            <td style="width: 15%;height:5%;text-align: right;color: gray;">
                <div>INVOICE :</div>
            </td>
        </tr>
        <tr>
            <td style="width: 15%;height:5%;text-align: left;">
                <div>{{$user->firstname}} {{$user->lastname}}</div>
            </td>
            <td style="width: 15%;height:5%;text-align: right;color: #434344;">
                <div>Invoice No: {{$order->id}}</div>
            </td>
        </tr>
        <tr>
            <td style="width: 15%;height:5%;text-align: left;color: gray;">
                <div>{{$address? $address->address1:''}}</div>
            </td>
            <td style="width: 15%;height:5%;text-align: right;color: gray;">
                <div>{{ date('F d ,Y',strtotime($order->created_date)) }}</div>
            </td>
        </tr>
        <tr>
            <td style="width: 15%;height:5%;text-align: left;color: gray;">
                <div>{{$address? $address->address2:''}}</div>
            </td>
        </tr>
        <tr>
            <td style="width: 15%;height:5%;text-align: left;color: gray;">
                <div>{{$address ? $address->city.', '.$address->stateprov.' '.$address->postalcode : ''}}</div>
            </td>
        </tr>
        <tr>
            <td style="width: 15%;height:5%;text-align: left;color: gray;">
                <div>{{$user->email }}</div>
            </td>
        </tr>
    </table>
</div>

<div style='width: 110%;height: 20px;'>
    <table autosize="1" width="110%" style="border-spacing:0;border-collapse: collapse;font-size:11pt;color: #2d2d2d;">
        <tr style="background-color: #434344;">
            <th style="border-left: 1px solid #434344;width: 15%;height:5%;vertical-align:middle;text-align: center;padding: 8px;color: #ffffff;">
                <div>INVOICE {{$order->id}}</div>
            </th>
        </tr>
    </table>
</div>

<div style="margin-bottom: 20px;"><img src='{{asset('assets/images/invoice/inv_hed_line.png')}}' /></div>

<div style='width: 110%;height: 20px;margin-bottom: 130px;'>
    <table autosize="1" width="110%" style="border-spacing:0;border-collapse: collapse;font-size:11pt;color: #2d2d2d;">
        <tr>
            <th style="width: 15%;height:5%;text-align: left;font-size:9pt;color: gray;">
                <div>QUANTITY</div>
            </th>
            <th style="width: 15%;height:5%;text-align: left;font-size:9pt;color: gray;">
                <div>DESCRIPTION</div>
            </th>
            <th style="width: 15%;height:5%;text-align: right;font-size:9pt;color: gray;">
                <div>UNIT PRICE</div>
            </th>
            <th style="width: 15%;height:5%;text-align: right;font-size:9pt;color: gray;">
                <div>PRICE</div>
            </th>
        </tr>
        @foreach($order_items as $item)
        <tr>
            <td style="width: 15%;height:5%;text-align: left;padding-top: 8px;font-size:10pt;color:#434344;">
                <div>{{$item->quantity}}</div>
            </td>
            <td style="width: 15%;height:5%;text-align: left;padding-top: 8px;font-size:10pt;color: gray;">
                <div>{{$item->productname}}</div>
            </td>
            <td style="width: 15%;height:5%;text-align: right;padding-top: 8px;font-size:10pt;color: gray;">
                <div>$ {{number_format($item->itemprice,2)}}</div>
            </td>
            <td style="width: 15%;height:5%;text-align: right;padding-top: 8px;font-size:10pt;color: gray;">
                <div>$ {{number_format($item->quantity*$item->itemprice,2)}}</div>
            </td>
        </tr>
        @endforeach
    </table>
</div>

<div style="margin-bottom: 25px; height: 2px;"><img src='{{asset('assets/images/invoice/inv_tbl_line.png')}}' /></div>

<div style='width: 110%;height: 20px;margin-bottom: 25px;'>
    <table autosize="1" width="110%" style="border-spacing:0;border-collapse: collapse;font-size:11pt;color: #2d2d2d;">

        <tr>
            <th style="width: 15%;height:5%;text-align: left;font-size:10pt;color: gray;">
                <div>SUBTOTAL</div>
            </th>
            <th style="width: 15%;height:5%;text-align: right;font-size:10pt;color: gray;">
                <div>$ {{number_format($order->ordersubtotal,2)}}</div>
            </th>
        </tr>
        @if(isset($coupon))
        <tr>
            <th style="width: 15%;height:5%;text-align: left;font-size:10pt;color: gray;">
                <div>DISCOUNT (voucher code: {{ $coupon->code }})</div>
            </th>
            <th style="width: 15%;height:5%;text-align: right;font-size:10pt;color: gray;">
                <div>- $ {{number_format($coupon->discount_amount,2)}}</div>
            </th>
        </tr>
        @endif
    </table>
</div>

<div style="margin-bottom: 25px; height: 2px;"><img src='{{asset('assets/images/invoice/inv_tbl_line.png')}}' /></div>

<div style='width: 110%;height: 20px;margin-bottom: 25px;'>
    <table autosize="1" width="110%" style="border-spacing:0;border-collapse: collapse;font-size:11pt;color: #2d2d2d;">
        <tr>
            <th style="width: 15%;height:5%;text-align: left;color: gray;">
                <div>TOTAL</div>
            </th>
            <th style="width: 15%;height:5%;text-align: right;color: gray;">
                <div>$ {{number_format($order->ordertotal,2)}}</div>
            </th>
        </tr>
    </table>
</div>
@if(!empty($display_ordertotal))
<div style="margin-bottom: 25px; height: 2px;"><img src='{{asset('assets/images/invoice/inv_tbl_line.png')}}' /></div>

<div style='width: 110%;height: 20px;margin-bottom: 25px;'>
    <table autosize="1" width="110%" style="border-spacing:0;border-collapse: collapse;font-size:11pt;color: #2d2d2d;">
        <tr>
            <th style="width: 15%;height:5%;text-align: left;color: gray;">
                <div>CONVERTED TOTAL</div>
            </th>
            <th style="width: 15%;height:5%;text-align: right;color: gray;">
                <div>{{$display_ordertotal}}</div>
            </th>
        </tr>
    </table>
</div>
@endif
<div style="margin-bottom: 70px;"><img src='{{asset('assets/images/invoice/inv_hed_line.png')}}' /></div>