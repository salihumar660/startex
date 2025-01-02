<?php

namespace App\Http\Controllers\driver;

use Carbon\Carbon;
use App\Models\User;
use App\Models\SplitLoad;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SplitLoadController extends Controller
{
    public function index()
    {
        $SplitLoad = SplitLoad::count();

        return view('admin.driver.splitLoad.index',compact('SplitLoad'));
    }


    // yajra pagination
    public function getSplitLoad(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            $user_id = Auth::user();

            if($fromDate == null && $toDate == null){

                $data = SplitLoad::where('driver_id',$user_id->id)->get();
            }

            else{
                //Date Filter
                $data = User::where('driver_id',$user_id->id)->whereBetween('created_at', [$fromDate, $toDate])->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()


                ->addColumn('created', function ($row) {

                    $created_at = $row->created_at;

                    $formatted_date = Carbon::parse($created_at)->format('Y-m-d H:i:s');
                    return $formatted_date;
                })
                ->rawColumns(['created'])
                ->make(true);

        }
    }

    public function addSplitLoad(Request $req)
    {
        $user_id = Auth::id();
        $existingRecord = SplitLoad::where('driver_id', $user_id)
            ->whereDate('date', now()->toDateString())
            ->exists();

        if ($existingRecord) {
            return response()->json(['error' => 'Data for today already exists.'], 400);
        }

        SplitLoad::insert([
            'driver_id' => $user_id,
            'date' => $req->date,
            'pickup_load' => $req->pickup_load,
            'remaining_load' => $req->pickup_load,
            'address' => $req->address,
            'created_at' => now(),
        ]);

        return response()->json(['success' => 'Data added successfully.']);
    }

}
