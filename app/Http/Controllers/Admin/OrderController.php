<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $order = Order::where('user_id',$user_id)->count();

        $data = Order::where('user_id',$user_id)->get();

        // dd($data);
        return view('admin.order.index',compact('order'));
    }

    // yajra pagination
    public function getOrder(Request $request)
    {
        if ($request->ajax()) {
            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            $query = Order::query()->where('user_id', Auth::id());

            if ($fromDate && $toDate) {
                $query->whereBetween('date', [$fromDate, $toDate]);
            }

            $data = $query->with('user')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->editColumn('date', function ($row) {
                    return Carbon::parse($row->date)->format('Y-m-d');
                })
                ->addColumn('invoice', function ($row) {

                    $invoice = Invoice::where('order_id',$row->id)->first();

                    if($invoice){

                        $btn = '<a class="btn btn-sm btn-light ml-2 my-3" href="'.url('/invoice-pdf/'.$invoice->id).'" role="button"><i class="fa-solid fa-file-invoice"></i></a>';

                        return $btn;

                    }else{
                        return "Not avaliable yet .";

                    }


                })
                ->rawColumns(['date','invoice'])
                ->make(true);
        }
    }


    public function addOrder(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string',
            'date' => 'required|date',
            'type_of_oil' => 'required|array',
            'type_of_oil.*' => 'string',
            'gallons' => 'required|array',
            'gallons.*' => 'nullable|numeric|min:0.01', // Gallon must be a positive number
        ]);

        // Prepare the gallons data to match the selected oil types
        $oilTypes = $validated['type_of_oil'];
        $gallons = [];
        foreach ($oilTypes as $oil) {
            $gallons[] = $validated['gallons'][$oil] ?? 0; // Default to 0 if not provided
        }

        // Create the order record
        Order::create([
            'user_id' => Auth::id(),
            'address' => $validated['address'],
            'date' => $validated['date'],
            'type_of_oil' => implode(',', $oilTypes), // Comma-separated oil types
            'gallon' => implode(',', $gallons), // Comma-separated gallons
            'status' => 'pending',
        ]);

        //notification record insertion
        $receiverId = User::where('role_id', 2)->first()->id;
        Notification::insert([
            'sender_id' => Auth::id(),  
            'receiver_id' => $receiverId,         
            'text' => 'A new order has been placed by ' . Auth::user()->name,
            'status' => 'unread',     
            'created_at' => now()   
        ]);

        return redirect()->back()->with('success', 'Order created successfully.');
    }


}
