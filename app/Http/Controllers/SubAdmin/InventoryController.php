<?php

namespace App\Http\Controllers\SubAdmin;

use Carbon\Carbon;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class InventoryController extends Controller
{

    // =========sub amdin

    public function inventoryBranch()
    {
        $inventory = Inventory::count();


        return view('admin.subAdmin.inventoryView.index',compact('inventory'));
    }

    // yajra pagination
    public function inventoryListBranch(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            $user = Auth::user();
            if($fromDate == null && $toDate == null){


                $data = Inventory::with('branch','category')->where('branch_id',$user->branch_id)->get();
            }

            else{
                //Date Filter
                $data = Inventory::with('branch','category')->whereBetween('created_at', [$fromDate, $toDate])->where('branch_id',$user->branch_id)->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('created_by', function ($row) {

                    $created_at = $row->created_at;

                    $formatted_date = Carbon::parse($created_at)->format('Y-m-d H:i:s');
                    return $formatted_date;
                })
                ->rawColumns(['created_by'])
                ->make(true);

        }
    }
}
