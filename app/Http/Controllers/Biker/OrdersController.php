<?php

namespace App\Http\Controllers\Biker;

use App\Abstraction\Classes\BusinessLogic\ManipulateOrderStatus;
use App\Abstraction\Classes\BusinessLogic\OrderStatuses;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public static string $layoutTitle = 'Orders';

    public function index()
    {
        return view('Admin.Bikers.Orders.index');
    }

    public function DTHandler(Request $request)
    {
        $columns = ['id', 'pick', 'deliver'];

        $draw = abs((int)$request->get('draw'));
        $length = abs((int)$request->get('length'));
        $start = abs((int)$request->get("start"));
        if (!isset($length)) {
            $length = 25;
        }
        if (!isset($start)) {
            $start = 0;
        }
        if (!isset($draw)) {
            $draw = 1;
        }

        $col = 'id';//make default
        $dir = "desc";
        $search = '';
        if (isset($request->get('search')['value'])) {
            $search = trim($request->get('search')['value']);
        }
        $recordsFiltered = Order::where('biker_id', Auth::id())->count();
        $recordsTotal = $recordsFiltered;
        if ($search) {
            $orders = Order::where('biker_id', Auth::id())
                ->whereHas('parcel', function ($q) use ($search) {
                    $q->where(function ($q) use ($search) {
                        $q->where('pick', 'like', '%' . $search . '%')
                            ->orWhere('deliver', 'like', '%' . $search . '%');
                    });
                })
                ->with('parcel', function ($q) use ($columns) {
                    $q->select($columns);
                })
                ->with('currentStatus')
                ->orderBy($col, $dir)
                ->skip($start)
                ->limit($length)
                ->select(['id', 'parcel_id'])
                ->get();

            $recordsFiltered = Order::where('biker_id', Auth::id())
                ->whereHas('parcel', function ($q) use ($search) {
                    $q->where(function ($q) use ($search) {
                        $q->where('pick', 'like', '%' . $search . '%')
                            ->orWhere('deliver', 'like', '%' . $search . '%');
                    });
                })
                ->count();
        } else {
            $orders = Order::where('biker_id', Auth::id())
                ->with('parcel', function ($q) use ($columns) {
                    $q->select($columns);
                })
                ->with('currentStatus')
                ->orderBy($col, $dir)
                ->skip($start)
                ->limit($length)
                ->select(['id', 'parcel_id'])
                ->get();
        }

        return response()->json([
            "draw" => $draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $orders->each(function ($order) {
                $order->status = OrderStatuses::localizeOrderCurrentStatus($order);
                $order->canBeCanceled = ManipulateOrderStatus::canBeCanceled($order->currentStatus->status);
            })
        ]);
    }

    public function cancel(Request $request)
    {
        $order = Order::where('id', intval($request->get('id')))
            ->where('biker_id', Auth::id())
            ->with('currentStatus')
            ->first();
        if ($order
            && ManipulateOrderStatus::canBeCanceled($order->currentStatus->status)
            && ManipulateOrderStatus::cancelOrder($order->id)
        ) {
            return [
                'status' => true
            ];
        }
        return [
            'status' => false
        ];
    }
}
