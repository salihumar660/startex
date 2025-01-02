<?php

namespace App\Http\Controllers\SubAdmin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\SplitLoad;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminSplitLoadController extends Controller
{
    public function index()
    {

        return view('admin.subAdmin.splitLoad.index');
    }


    // yajra pagination
    public function getSplitLoad(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');


            if($fromDate == null && $toDate == null){

                $data = SplitLoad::with('driver')->get();
            }

            else{
                //Date Filter
                $data = User::with('driver')->whereBetween('created_at', [$fromDate, $toDate])->get();
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

}
