<?php

namespace App\Http\Controllers\SubAdmin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Branch;
use App\Models\Invoice;
use App\Models\Inventory;
use App\Models\Transport;
use App\Models\DriverAssign;
use App\Models\DriverTicket;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderAssignController extends Controller
{
    public function index()
    {
        $order = Order::count();
        $transport = Transport::get();

        $drivers = User::where('role_id', 4)->get();

        return view('admin.subAdmin.orders.index',compact('order','drivers','transport'));
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
                $data = Order::with('user','transport')->get();
            }

            else{
                //Date Filter
                $data = Order::with('user','transport')->whereBetween('created_at', [$fromDate, $toDate])->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {

                    $btn = '<button class="btn btn-sm  btn-info ml-2 my-3 edit" value="' . $row->id . '" type="button"><i class="fa fa-edit"></i></button>';
                    // $btn = $btn .  '<a class="btn btn-sm btn-danger ml-2 my-3" href="'.url('/order-delete/'.$row->id).'" role="button"><i class="fa fa-trash"></i></a>';


                    return $btn;
                })

                ->addColumn('delivery_ticket', function ($row) {

                    $ticket = DriverTicket::where('order_number',$row->id)->orderBy('id','DESC')->first();

                    if ($ticket) {

                        $btn = '<a class="btn btn-sm btn-warning ml-2 my-3" href="'.url('/admin-delivery-ticket-show/'.$ticket->id).'" role="button"><i class="fa-solid fa-ticket"></i></a>';
                    }else{
                        $btn = 'Ticket Not Save Yet';

                    }

                    return $btn;
                })
                ->addColumn('created_by', function ($row) {

                    $created_at = $row->created_at;

                    $formatted_date = Carbon::parse($created_at)->format('Y-m-d H:i:s');
                    return $formatted_date;
                })
                ->addColumn('invoice', function ($row) {
                    $invoice = Invoice::with('customer')->where('order_id', $row->id)->first();

                    if($invoice){

                        $btn = 'Invoice already Saved';
                    }else{
                        $btn = '<a class="btn btn-sm btn-light ml-2 my-3" href="'.url('/invoices/'.$row->id).'" role="button"><i class="fa-solid fa-file-invoice"></i></a>';
                    }



                    return $btn;
                })

                ->addColumn('status', function ($row) {

                    if ($row->status == 'delivered') {

                        $btn = '<button class="btn btn-sm  btn-danger ml-2 my-3 statusForm" value="' . $row->id . '" type="button">'.$row->status.'</button>';
                    }else{
                        $btn = '<button class="btn btn-sm  btn-dark ml-2 my-3 statusForm" value="' . $row->id . '" type="button">'.$row->status.'</button>';

                    }

                    return $btn;
                })
                ->addColumn('excel', function ($row) {
                    $invoice = Invoice::with('customer')->where('order_id', $row->id)->first();

                    if($invoice){

                        $btn = '<a class="btn btn-sm btn-secondary ml-2 my-3" href="'.url('/export-invoice/'.$row->id).'" role="button"><i class="fa-solid fa-file-excel"></i></a>';
                    }else{
                        $btn = 'Invoice Not Save Yet';
                    }

                    return $btn;
                })
                ->rawColumns(['action', 'created_by','delivery_ticket','invoice','excel','status'])
                ->make(true);

        }
    }


    public function editAssignOrder($id){

        $driverAssign= DriverAssign::where('order_id',$id)->first();

        $order= Order::where('id',$id)->first();


        return response()->json([
            'orderAssign'=>$driverAssign,
            'order'=>$order,

        ]);
    }



    public function updateAssignOrder(Request $req) {

        $orderAssign= DriverAssign::where('order_id',$req->orderId)->first();


        if ($orderAssign) {
            $orderAssign->order_id = $req->orderId;
            $orderAssign->user_id = $req->driver_id;

            $orderAssign->update();

            $order = Order::find($req->orderId);

            // $order->driver = $driver->name;
            $order->company = $req->company;
            $order->transport_id = $req->transport_id;


            $order->update();

        }else{
            $orderAssign = new DriverAssign();
            $orderAssign->order_id = $req->orderId;

            $orderAssign->user_id = $req->driver_id;
            $orderAssign->save();


            $order_status =  Order::where('id',$req->orderId)->first();

            $order_status->status = 'assign';

            $order_status->company = $req->company;
            $order_status->transport_id = $req->transport_id;

            $order_status->update();

        }
        $driver = User::find($req->driver_id);



        return redirect()->back();
    }




    public function editOrderStatus($id){

        $order= Order::where('id',$id)->first();


        return response()->json([
            'order'=>$order,
        ]);
    }

    public function updateOrderStatus(Request $req) {

        $order= Order::where('id',$req->orderId)->first();

        $order->status = $req->status;

        $order->update();

        return redirect()->back();
    }



    // delivery ticket

    public function adminDeliveryTicketShow($id)
    {
        $formData = DriverTicket::findOrFail($id);

        // Decode JSON fields
        $formData->station_fuel = json_decode($formData->station_fuel, true);
        $formData->truck_pump = json_decode($formData->truck_pump, true);

        // dd($formData);

        return view('admin.subAdmin.deliveryticket.index', compact('formData'));
    }
}
