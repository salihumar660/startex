<?php

namespace App\Http\Controllers\Supplier;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Branch;
use App\Models\Invoice;
use App\Models\Inventory;
use App\Models\DriverAssign;
use App\Models\DriverTicket;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderApprovalController extends Controller
{
    public function index()
    {
        $order = Order::count();

        $drivers = User::where('role_id', 4)->get();

        return view('admin.supplier.proveDelivery.index',compact('order','drivers'));
    }

    // yajra pagination
    public function list(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            // $user_id= Auth::user()->id;
            // $driveAssign = DriverAssign::where('user_id', $user_id)->pluck('order_id');
            if($fromDate == null && $toDate == null){
                $data = Order::with('user')->get();
            }

            else{
                //Date Filter
                $data = Order::with('user')->whereBetween('created_at', [$fromDate, $toDate])->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {

                    $btn = '<button class="btn btn-sm  btn-info ml-2 my-3 edit" value="' . $row->id . '" type="button"><i class="fa fa-edit"></i></button>';
                    
                    return $btn;
                })
                ->addColumn('created_by', function ($row) {

                    $created_at = $row->created_at;

                    $formatted_date = Carbon::parse($created_at)->format('Y-m-d H:i:s');
                    return $formatted_date;
                })
              
                ->rawColumns(['action', 'created_by'])
                ->make(true);

        }
    }

    public function editOrderDelivery($id){

        $order= Order::where('id',$id)->first();

        return response()->json([
            'order'=>$order,
        ]);
    }

    public function updateOrderDelivery(Request $req) {

        $order= Order::where('id',$req->orderId)->first();

        $order->delivery_approval = $req->delivery_approval;

        $order->update();

        return redirect()->back();
    }


}
