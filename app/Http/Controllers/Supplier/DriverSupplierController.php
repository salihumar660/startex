<?php

namespace App\Http\Controllers\Supplier;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Transport;
use App\Models\DriverDetail;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DriverSupplierController extends Controller
{
    public function index()
    {

        $drivers = User::where('role_id','=',4)->count();

        $transport = Transport::get();

        return view('admin.supplier.driver.index',compact('drivers', 'transport'));
    }


    // yajra pagination
    public function getSupplierDrivers(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            if($fromDate == null && $toDate == null){

                $data = User::with('driver')->where('role_id','=',4)->get();
            }

            else{
                //Date Filter
                $data = User::with('driver')->where('role_id','=',4)->whereBetween('created_at', [$fromDate, $toDate])->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<button class="btn btn-sm  btn-info ml-2 my-3 edit" value="' . $row->id . '" type="button"><i class="fa fa-edit"></i></button>';
                    $btn = $btn .  '<a class="btn btn-sm btn-danger ml-2 my-3" href="'.url('/driverDetail-delete/'.$row->id).'" role="button"><i class="fa fa-trash"></i></a>';
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


    public function addSupplierDriver(Request $req){


        $password = $req->password;
        $hashedPassword = Hash::make($password);

        $user_id = User::insertGetId([
            'name' => $req->name,
            'email' => $req->email,
            'password' => $hashedPassword,
            'role_id' => '4',
            'created_at' => now(),

        ]);


        DriverDetail::insert([
            'user_id'=> $user_id,
            'transport_company' => $req->transport_company,
            'address' => $req->address,
            'phone' => $req->phone,
            'city' => $req->city,
            'state' => $req->state,
            'zip' => $req->zip,
            // 'transport_id' => $req->transport_id,
            'status' => $req->status,
            'route' => $req->route,
            'charges' => $req->charges,
        ]);

        return redirect()->back();
    }



    // edit
    public function editSupplierDriver($id){

        $user = User::with('driver')->find($id);

        return response()->json([
            'user'=>$user,
        ]);
    }


    // update user
    public function updateSupplierDriver(Request $req){

        $user = User::find($req->userId);

        $user->name = $req->name;

        $user->email = $req->email;


        if($req->password != null){
            $password = $req->password;
            $hashedPassword = Hash::make($password);

            $user->password= $hashedPassword;
        }

        $user->save();


        $driver = DriverDetail::where('user_id', $req->userId)->first();

        $driver->transport_company = $req->transport_company;
        $driver->address = $req->address;
        $driver->phone = $req->phone;
        $driver->city = $req->city;
        $driver->state = $req->state;
        $driver->zip = $req->zip;
        // $driver->transport_id = $req->transport_id;
        $driver->status = $req->status;
        $driver->route = $req->route;
        $driver->charges = $req->charges;

        $driver->update();

        return redirect()->back();

    }


    // delete user
    public function deleteSupplierDriver($id){

        $user=User::find($id);

        if ($user) {
            $driver = DriverDetail::where('user_id', $id)->first();

            $driver->delete();


            $user->delete();


        }

        session()->flash('message', 'Driver deleted successfully!');

        return redirect()->back();
    }

}
