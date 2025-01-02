<?php

namespace App\Http\Controllers\SubAdmin;

use Carbon\Carbon;
use App\Models\PurchaseSale;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class PurchaseSaleController extends Controller
{
    public function purchaseSale()
    {

        $purchaseSale = PurchaseSale::count();

        return view('admin.subAdmin.purchaseSale.index',compact('purchaseSale'));
    }


    // yajra pagination
    public function getpurchaseSale(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            if($fromDate == null && $toDate == null){

                $data = purchaseSale::get();
            }

            else{
                //Date Filter
                $data = purchaseSale::whereBetween('created_at', [$fromDate, $toDate])->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('created', function ($row) {

                    $created_at = $row->created_at;

                    $formatted_date = Carbon::parse($created_at)->format('Y-m-d H:i:s');
                    return $formatted_date;
                })
                ->rawColumns([ 'created'])
                ->make(true);

        }
    }
}
