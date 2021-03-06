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

    public static function localizeParcelCurrentStatus(Parcel $parcel): string
    {
        return $parcel->currentOrder
            ? self::translate($parcel->currentOrder->currentStatus->status)
            : self::translate(self::STATUS_CREATED);
    }

    public static function localizeOrderCurrentStatus(Order $order): string
    {
        return self::translate($order->currentStatus->status);
    }

    public static function nextProgressStatus(int $currentStatus): int
    {
        switch ($currentStatus) {
            case self::STATUS_RESERVED:
                return self::STATUS_PICKED;
            case self::STATUS_PICKED:
                return self::STATUS_DELIVERED;
            default:
                throw new \Exception('undefined next status');
        }
    }
}
