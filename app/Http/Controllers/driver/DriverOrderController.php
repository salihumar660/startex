<?php

namespace App\Http\Controllers\driver;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Branch;
use App\Models\Inventory;
use App\Models\SplitLoad;
use App\Models\DriverAssign;
use App\Models\DriverTicket;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DriverOrderController extends Controller
{
    public function index()
    {

        $id = Auth::user()->id;

        $assign = DriverAssign::with('order')->where('user_id',$id)->where('status', '!=', 'Delivered')->get();

        // dd($assign);
        return view('admin.driver.orderGet.index',compact('assign'));
    }


    public function editDriverOrder($id){

        try {

            $order = Order::findOrFail($id);
            $order->status = 'delivered';
            $order->save();

            $userId = Auth::id();
            $assign = DriverAssign::where('order_id', $id)
                ->where('user_id', $userId)
                ->firstOrFail();

            $assign->status = 'Delivered';
            $assign->save();

            $existingRecord = SplitLoad::where('driver_id', $userId)
                ->whereDate('date', now()->toDateString())
                ->first();

            if ($existingRecord) {

                $existingRecord->remaining_load = $existingRecord->pickup_load - $order->gallon;
                $existingRecord->save();
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'No split load record found for today.',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Order status updated to Complete.',
                'order' => $order,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Record not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }

    }



    public function updateDriverOrder(Request $req) {

        $orderId = $req->orderId;
        $status = $req->status;
        $signatureData = $req->signature;
        $order = Order::find($orderId);

        // Decode the base64 data
        $signatureImage = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureImage = str_replace(' ', '+', $signatureImage);
        $imageName = 'signature_' . $orderId . '_' . time() . '.png';

        Storage::disk('public')->put($imageName, base64_decode($signatureImage));


        $order->status = $status;
        $order->signature_path = 'storage/' . $imageName;
        $order->save();

        return response()->json(['success' => true]);
    }



    public function ticket($id)
    {
        $order = Order::with('user')->find($id);
        $user = Auth::user();
        // dd($order);

        return view('admin.driver.driver-ticket',compact('order','user'));
    }


    public function store(Request $request)
    {
        $signatureData = $request->signature;

        $signatureImage = str_replace('data:image/png;base64,', '', $signatureData);
        $signatureImage = str_replace(' ', '+', $signatureImage);
        $imageName = 'signature_' . time() . '.png';


        Storage::disk('public')->put($imageName, base64_decode($signatureImage));

        $signaturePath = 'storage/' . $imageName;

        DriverTicket::insert([
            'customer' => $request->customer,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone,
            'ld' => $request->ld,
            'zone' => $request->zone,
            'order_number' => $request->order_number,
            'delivery_date' => $request->delivery_date,
            'delivery_time' => $request->delivery_time,
            'bl_number' => $request->bl_number,
            'mileage_begin' => $request->mileage_begin,
            'load_started' => $request->load_started,
            'unloading_started' => $request->unloading_started,
            'rack' => $request->rack,
            'end' => $request->end,
            'finished' => $request->finished,
            'finished_2' => $request->finished_2,
            'load_account' => $request->load_account,
            'consigned_to' => $request->consigned_to,
            'extra_tank_reading' => $request->extra_tank_reading,
            'station_fuel_required' => $request->station_fuel_required,
            'ordered_1' => $request->ordered_1,
            'gross_1' => $request->gross_1,
            'net_1' => $request->net_1,
            'before_1' => $request->before_1,
            'after_1' => $request->after_1,
            'water_1' => $request->water_1,
            'ordered_2' => $request->ordered_2,
            'gross_2' => $request->gross_2,
            'net_2' => $request->net_2,
            'before_2' => $request->before_2,
            'after_2' => $request->after_2,
            'water_2' => $request->water_2,
            'station_fuel' => json_encode($request->only([
                'station_fuel_1', 'station_fuel_2', 'station_fuel_3', 'station_fuel_4', 'station_fuel_5',
            ])),
            'truck_pump_required' => $request->truck_pump_required,
            'truck_pump' => json_encode($request->only([
                'truck_pump_1', 'truck_pump_2', 'truck_pump_3', 'truck_pump_4', 'truck_pump_5',
            ])),
            'received_in_good_order' => $request->received_in_good_order,
            'date' => $request->date,
            'driver' => $request->driver,
            'received_check' => $request->received_check,
            'dated' => $request->dated,
            'amount' => $request->amount,
            'cod_check' => $request->cod_check,
            'gas_type' => $request->gas_type,
            'signature' => $signaturePath,
            'created_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Delivery Ticket saved successfully!']);
    }
}
