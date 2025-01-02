<?php

namespace App\Http\Controllers\SubAdmin;

use Carbon\Carbon;
use App\Models\DtnBol;
use App\Models\Dtn_Fuel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\DtnEft;

class DtnFuelController extends Controller
{
    public function index()
    {

        $dtn = Dtn_Fuel::count();

        return view('admin.subAdmin.dtn.fuel',compact('dtn'));
    }


    // yajra pagination
    public function getFuelDtn(Request $request)
    {
        if ($request->ajax()) {
            $searchdate = $request->input('searchdate');
            $company = $request->input('company');

            if ($searchdate) {
                $date = Carbon::createFromFormat('Y-m-d', $searchdate)->format('m/d/y');
            }

            $query = Dtn_Fuel::query();

            if ($searchdate) {
                $query->where('file_content', 'like', "%" . $date . "%");
            }

            if ($company) {
                $query->where('file_content', 'like', "%" . $company . "%");
            }

            $data = $query->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('remaining', function ($row) {
                    $parts = explode(" ", $row->file_content);
                    for ($i = 0; $i < 4; $i++) {
                        array_pop($parts);
                    }
                    return implode(" ", $parts);
                })
                ->addColumn('date', function ($row) {
                    $parts = explode(" ", $row->file_content);
                    return $parts[count($parts) - 4];
                })
                ->addColumn('time', function ($row) {
                    $parts = explode(" ", $row->file_content);
                    return $parts[count($parts) - 3];
                })
                ->addColumn('price', function ($row) {
                    $parts = explode(" ", $row->file_content);
                    return $parts[count($parts) - 2];
                })
                ->addColumn('change', function ($row) {
                    $parts = explode(" ", $row->file_content);
                    return $parts[count($parts) - 1];
                })
                ->rawColumns(['remaining', 'date', 'time', 'price', 'change'])
                ->make(true);
        }
    }


    public function dtnbol()
    {

        $dtn = DtnBol::count();

        return view('admin.subAdmin.dtnbol.index',compact('dtn'));
    }


    // yajra pagination
    public function getbolDtn(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            if($fromDate == null && $toDate == null){

                $data = DtnBol::get();
            }

            else{
                //Date Filter
                $data = DtnBol::whereBetween('created_at', [$fromDate, $toDate])->get();
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


    public function dtneft()
    {

        $dtn = DtnEft::count();

        return view('admin.subAdmin.dtneft.index',compact('dtn'));
    }


    // yajra pagination
    public function geteftDtn(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            if($fromDate == null && $toDate == null){

                $data = DtnEft::get();
            }

            else{
                //Date Filter
                $data = DtnEft::whereBetween('created_at', [$fromDate, $toDate])->get();
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
