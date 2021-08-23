<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodType extends Model
{

    public $timestamps = false;

    const TYPE_CREDIT_CARD = 1;
    const TYPE_ADMIN = 2;
    const TYPE_E_WALET = 3;
    const TYPE_BITPAY = 4;
    const TYPE_SKRILL = 5;
    const TYPE_SECONDARY_CC = 6; // usually nuve -- should be removed
    const TYPE_COUPON_CODE = 7;
    const TYPE_TMT = 8;
    const TYPE_T1_PAYMENTS = 9;
    const TYPE_T1_PAYMENTS_SECONDARY_CC = 10; // should be removed in the future as well
    const TYPE_PAYARC = 11; // should be removed in the future as well
    const TYPE_T1_TYPE = 'NMI - T1';
    const TYPE_UNICRYPT = 13;
    const TYPE_IPAYTOTAL = 14;
    protected $fillable = ['pay_method_name'];

    public static function getPaymentMethodTypeByOrder($order)
    {
        $paymentMethod = DB::table('payment_methods')
            ->where('id', $order->payment_methods_id)
            ->first();

        if (!$paymentMethod) {
            return false;
        }

        return DB::table('payment_method_type')
            ->where('id', $paymentMethod->pay_method_type)
            ->first();
    }

    public static function getPaymentMethodNameById($paymentMethodTypeId)
    {
        if ($paymentMethodTypeId == self::TYPE_CREDIT_CARD || $paymentMethodTypeId == self::TYPE_SECONDARY_CC) {
            return 'Credit Card';
        } else if ($paymentMethodTypeId == self::TYPE_E_WALET) {
            return 'Ewallet';
        } else if ($paymentMethodTypeId == self::TYPE_BITPAY) {
            return 'Bitpay';
        } else if ($paymentMethodTypeId == self::TYPE_SKRILL) {
            return 'Skrill';
        } else if ($paymentMethodTypeId == self::TYPE_TMT) {
            return 'Trust My travel';
        } else if ($paymentMethodTypeId == self::TYPE_T1_PAYMENTS) {
            return 'Credit Card - T1';
        }
    }

    public static function getPaymentMethodTypeById($userId, $paymentMethodId)
    {
        return DB::table('payment_methods')
            ->select('pay_method_type')
            ->where('userID', $userId)
            ->where('id', $paymentMethodId)
            ->first();
    }

    public static function getTMTPaymentType()
    {
        return DB::table('payment_method_type')
            ->whereIn('id', [
//                PaymentMethodType::TYPE_TRUST_MY_TRAVEL,
                PaymentMethodType::TYPE_BITPAY,
                PaymentMethodType::TYPE_T1_PAYMENTS,
            ])->get();
    }

    public static function getEnrollmentPaymentMethods()
    {
        $paymentMethodTypeId = array(
            PaymentMethodType::TYPE_CREDIT_CARD,
            PaymentMethodType::TYPE_BITPAY,
        );

        return $paymentMethod = DB::table('payment_method_type')
            ->whereIn('id', $paymentMethodTypeId)
            ->get();
    }
}
