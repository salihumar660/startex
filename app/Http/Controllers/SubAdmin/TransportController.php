<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use App\Models\Transport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Carbon;

class TransportController extends Controller
{
    public function index()
    {

        $transports = Transport::count();

        return view('admin.subAdmin.transport.index',compact('transports'));
    }


    // yajra pagination
    public function getTransports(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            if($fromDate == null && $toDate == null){

                $data = Transport::get();
            }

            else{
                //Date Filter
                $data = Transport::whereBetween('created_at', [$fromDate, $toDate])->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<button class="btn btn-sm  btn-info ml-2 my-3 edit" value="' . $row->id . '" type="button"><i class="fa fa-edit"></i></button>';
                    $btn = $btn .  '<a class="btn btn-sm btn-danger ml-2 my-3" href="'.url('/transport-delete/'.$row->id).'" role="button"><i class="fa fa-trash"></i></a>';
                    return $btn;
                })
                ->addColumn('created', function ($row) {

                    $created_at = $row->created_at;

                    $formatted_date = Carbon::parse($created_at)->format('Y-m-d H:i:s');
                    return $formatted_date;
                })
                ->rawColumns(['action', 'created', 'roleName'])
                ->make(true);

        }
    }


    public function addTransport(Request $req){

        $transport = Transport::insertGetId([
            'company_name' => $req->company_name,
            'phone' => $req->phone,
            'fax' => $req->fax,
            'email' => $req->email,
            'ppy_code' => $req->ppy_code,
            'fuel_sur_charge' => $req->fuel_sur_charge,
            'insurance' => $req->insurance,
            'other' => $req->other,
            'code' => $req->code,
            'status' => $req->status,

            'created_at' => now(),

        ]);

        return redirect()->back();
    }



    // edit
    public function editTransport($id){

        $transport = Transport::find($id);

        return response()->json([
            'transport'=>$transport,
        ]);
    }


    // update
    public function updateTransport(Request $req){

        $transport = Transport::find($req->transportId);

        $transport->company_name = $req->company_name;
        $transport->phone = $req->phone;
        $transport->fax = $req->fax;
        $transport->email = $req->email;
        $transport->ppy_code = $req->ppy_code;
        $transport->fuel_sur_charge = $req->fuel_sur_charge;
        $transport->insurance = $req->insurance;
        $transport->other = $req->other;
        $transport->code = $req->code;
        $transport->status = $req->status;

        $transport->save();

        return redirect()->back();

    }


    // delete
    public function deleteTransport($id){

        $transport=Transport::find($id);

        if ($transport) {


            $transport->delete();


        }

        session()->flash('message', 'Transport deleted successfully!');

        return redirect()->back();
    }

}
