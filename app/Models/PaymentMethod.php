<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Util;

class PaymentMethod extends Model
{

    const MINIMUM_TOKEN_LENGTH = 8;

    const PAYMENT_METHOD_TYPE_CREDITCARD      = 1;
    const PAYMENT_METHOD_TYPE_ADMIN           = 2;
    const PAYMENT_METHOD_TYPE_EWALLET         = 3;
    const PAYMENT_METHOD_TYPE_BITPAY          = 4;   // Not In use
    const PAYMENT_METHOD_TYPE_SKRILL          = 5;   // Not In use
    const PAYMENT_METHOD_TYPE_SECONDARY_CC    = 6;
    const PAYMENT_METHOD_TYPE_CREDIT_CARD_TMT = 8;  // No Longer Used
    const PAYMENT_METHOD_TYPE_CREDIT_CARD_T1  = 9;
    const PAYMENT_METHOD_TYPE_CREDIT_CARD_T1_SECONDARY = 10;
    const TYPE_PAYARC = 11; // refunds only


    public static $creditCards = [
        self::PAYMENT_METHOD_TYPE_CREDITCARD,
        self::PAYMENT_METHOD_TYPE_SECONDARY_CC,
        self::PAYMENT_METHOD_TYPE_CREDIT_CARD_TMT,  // No Longer Used
        self::PAYMENT_METHOD_TYPE_CREDIT_CARD_T1,
        self::PAYMENT_METHOD_TYPE_CREDIT_CARD_T1_SECONDARY
    ];



    public static function getFormatedCardNo($token)
    {
        if (Util::isNullOrEmpty($token) || strlen($token) < self::MINIMUM_TOKEN_LENGTH) {
            return "";
        }
        $count = strlen($token);
        $temp1 = substr($token, 0, 6);
        $temp2 = substr($token, -4);
        $xCount = $count - 10;
        return $temp1 . str_repeat('x', $xCount) . $temp2;
    }
}
