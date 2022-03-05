<?php

namespace App\Abstraction\Classes\BusinessLogic;

use App\Models\Order;
use App\Models\Parcel;

class OrderStatuses
{
    const STATUS_CREATED = 1;
    const STATUS_RESERVED = 2;
    const STATUS_PICKED = 3;
    const STATUS_DELIVERED = 4;
    const STATUS_CANCELED = 5;

    public static function getParcelCurrentStatus(Parcel $parcel): string
    {
        return $parcel->currentOrder
            ? self::translate($parcel->currentOrder->currentStatus->status)
            : self::translate(1);
    }

    public static function localizeOrderCurrentStatus(Order $order): string
    {
        return self::translate($order->currentStatus->status);
    }

    private static function translate(int $status): string
    {
        switch ($status) {
            case self::STATUS_RESERVED:
                return 'RESERVED';
            case self::STATUS_PICKED:
                return 'PICKED';
            case self::STATUS_DELIVERED:
                return 'DELIVERED';
            case self::STATUS_CANCELED:
                return 'CANCELED';
            default:
                return 'CREATED';
        }
    }
}
