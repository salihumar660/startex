<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Dtn;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class DtnController extends Controller
{
    public function index()
    {

        $dtn = Dtn::count();

        return view('admin.dtn.index',compact('dtn'));
    }


    // yajra pagination
    public function getDtn(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            if($fromDate == null && $toDate == null){

                $data = Dtn::get();
            }

            else{
                //Date Filter
                $data = Dtn::whereBetween('created_at', [$fromDate, $toDate])->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<button class="btn btn-sm  btn-info ml-2 my-3 edit" value="' . $row->id . '" type="button"><i class="fa fa-edit"></i></button>';
                    $btn = $btn .  '<a class="btn btn-sm btn-danger ml-2 my-3" href="'.url('/dtn-delete/'.$row->id).'" role="button"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->addColumn('created', function ($row) {

                    $created_at = $row->created_at;

                    $formatted_date = Carbon::parse($created_at)->format('Y-m-d H:i:s');
                    return $formatted_date;
                })
                ->rawColumns(['action', 'created'])
                ->make(true);

        }
    }


    public function addDtn(Request $req){


        Dtn::insert([
            'brand' => $req->brand,
            'order' => $req->order,
            'terminal_zone' => $req->terminal_zone,
            'transport' => $req->transport,
            'date' => $req->date,
            'rack' => $req->rack,
            'commission' => $req->commission,
            'bol' => $req->bol,

        ]);


        return redirect()->back();
    }



    // edit
    public function editDtn($id){

        $dtn = Dtn::find($id);

        return response()->json([
            'dtn'=>$dtn,
        ]);
    }


    // update user
    public function updateDtn(Request $req){

        $dtn = Dtn::find($req->dtnId);

        $dtn->brand = $req->brand;
        $dtn->order = $req->order;
        $dtn->terminal_zone = $req->terminal_zone;
        $dtn->transport = $req->transport;
        $dtn->date = $req->date;
        $dtn->rack = $req->rack;
        $dtn->commission = $req->commission;
        $dtn->bol = $req->bol;


        $dtn->update();

        return redirect()->back();

    }


    // delete
    public function deleteDtn($id){

        $dtn=Dtn::find($id);

        if ($dtn) {
            $dtn->delete();

        }

        session()->flash('message', 'Dtn deleted successfully!');

        return redirect()->back();
    }
}
