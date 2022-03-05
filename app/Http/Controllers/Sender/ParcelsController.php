<?php

namespace App\Http\Controllers\Sender;


use App\Abstraction\Classes\BusinessLogic\OrderStatuses;
use App\Abstraction\Classes\Common\FeedbackMessagesClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\Parcels\ParcelCreateRequest;
use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParcelsController extends Controller
{
    public static string $layoutTitle = 'Parcels';

    public function index()
    {
        return view('Admin.Senders.Parcels.index');
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
        $recordsFiltered = Parcel::where('sender_id', Auth::id())->count();
        $recordsTotal = $recordsFiltered;
        if ($search) {
            $parcels = Parcel::where('sender_id', Auth::id())
                ->where(function ($q) use ($search) {
                    $q->where('pick', 'like', '%' . $search . '%')
                        ->orWhere('deliver', 'like', '%' . $search . '%');
                })
                ->orderBy($col, $dir)
                ->skip($start)
                ->limit($length)
                ->with('currentOrder.currentStatus')
                ->select($columns)
                ->get();

            $recordsFiltered = Parcel::where('sender_id', Auth::id())
                ->where(function ($q) use ($search) {
                    $q->where('pick', 'like', '%' . $search . '%')
                        ->orWhere('deliver', 'like', '%' . $search . '%');
                })
                ->count();

        } else {
            $parcels = Parcel::where('sender_id', Auth::id())
                ->orderBy($col, $dir)
                ->skip($start)
                ->limit($length)
                ->with('currentOrder.currentStatus')
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

    public function create()
    {
        return view('Admin.Senders.Parcels.create');
    }

    public function store(ParcelCreateRequest $request)
    {
        Parcel::create([
            'sender_id' => Auth::id(),
            'pick' => $request->get('pick'),
            'deliver' => $request->get('deliver'),
        ]);
        return redirect()->route('sender.parcels.index')->with([
            'feedback' => FeedbackMessagesClass::feedback(FeedbackMessagesClass::SUCCESS)
        ]);
    }

    public function show($id)
    {

    }

    public function destroy($id)
    {

    }

    public function edit($id)
    {

    }

    public function update($id)
    {

    }
}
