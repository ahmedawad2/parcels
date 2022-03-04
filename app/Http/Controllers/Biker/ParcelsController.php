<?php

namespace App\Http\Controllers\Biker;

use App\Abstraction\Classes\BusinessLogic\OrderStatuses;
use App\Http\Controllers\Controller;
use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParcelsController extends Controller
{
    public function index()
    {
        return view('Admin.Bikers.Parcels.index');
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

        $col = $columns[0];//make default
        $dir = "desc";
        $search = '';
        if (isset($request->get('search')['value'])) {
            $search = trim($request->get('search')['value']);
        }
        $recordsFiltered = Parcel::forBikers()->count();
        $recordsTotal = $recordsFiltered;
        if ($search) {
            $parcels = Parcel::forBikers()
                ->where(function ($q) use ($search) {
                    $q->where('pick', 'like', '%' . $search . '%')
                        ->orWhere('deliver', 'like', '%' . $search . '%');
                })
                ->orderBy($col, $dir)
                ->skip($start)
                ->limit($length)
                ->select($columns)
                ->get();

            $recordsFiltered = Parcel::forBikers()
                ->where(function ($q) use ($search) {
                    $q->where('pick', 'like', '%' . $search . '%')
                        ->orWhere('deliver', 'like', '%' . $search . '%');
                })
                ->count();

        } else {
            $parcels = Parcel::forBikers()
                ->orderBy($col, $dir)
                ->skip($start)
                ->limit($length)
                ->select($columns)
                ->get();
        }

        return response()->json([
            "draw" => $draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $parcels->each(function ($parcel) {
                $parcel->status = OrderStatuses::getParcelCurrentStatus($parcel);
            })
        ]);
    }
}
