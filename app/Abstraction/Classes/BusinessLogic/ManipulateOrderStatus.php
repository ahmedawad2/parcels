<?php

namespace App\Abstraction\Classes\BusinessLogic;

use App\Models\Order;
use App\Models\OrderStatus;

class ManipulateOrderStatus
{
    public static function canBeCanceled(int $currentStatus): bool
    {
        return $currentStatus === OrderStatuses::STATUS_RESERVED;
    }

    public static function cancelOrder(int $orderId): bool
    {
        try {
            OrderStatus::create([
                'order_id' => $orderId,
                'status' => OrderStatuses::STATUS_CANCELED
            ]);
            return true;
        } catch (\Throwable $t) {
            return false;
        }
    }
}
