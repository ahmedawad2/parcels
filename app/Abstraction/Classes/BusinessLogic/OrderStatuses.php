<?php

namespace App\Abstraction\Classes\BusinessLogic;

use App\Models\Parcel;

class OrderStatuses
{
    const STATUS_CREATED = 1;
    const STATUS_PICKED = 2;
    const STATUS_DELIVERED = 3;
    const STATUS_CANCELED = 4;

    public static function getParcelCurrentStatus(Parcel $parcel): string
    {
        return $parcel->currentOrder
            ? self::translate($parcel->currentOrder->currentStatus->status)
            : self::translate(1);
    }

    private static function translate(int $status): string
    {
        switch ($status) {
            case self::STATUS_CREATED:
                return 'CREATED';
            case self::STATUS_PICKED:
                return 'PICKED';
            case self::STATUS_DELIVERED:
                return 'DELIVERED';
            case self::STATUS_CANCELED:
                return 'CANCELED';
            default:
                return '';
        }
    }
}
