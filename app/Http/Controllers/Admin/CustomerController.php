<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CustomerDetail;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()

    {

        $customers = User::where('role_id',5)->count();

        return view('admin.customer.index',compact('customers'));
    }


    // yajra pagination
    public function getCustomers(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            if($fromDate == null && $toDate == null){

                $data = User::where('role_id',5)->get();
            }

            else{
                //Date Filter
                $data = User::where('role_id',5)->whereBetween('created_at', [$fromDate, $toDate])->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<button class="btn btn-sm  btn-info ml-2 my-3 edit" value="' . $row->id . '" type="button"><i class="fa fa-edit"></i></button>';
                    $btn = $btn .  '<a class="btn btn-sm btn-danger ml-2 my-3" href="'.url('/user-delete/'.$row->id).'" role="button"><i class="fa fa-trash"></i></a>';
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


    public function addCustomer(Request $req){

        // dd($req->all());
        $password = $req->user_password;
        $hashedPassword = Hash::make($password);

        $user_id = User::insertGetId([
            'name' => $req->user_name,
            'email' => $req->user_email,
            'password' => $hashedPassword,
            'role_id' => 5,
            'created_at' => now(),

        ]);

        CustomerDetail::insert([
            'user_id' => $user_id,
            'customer' => $req->user_customer,
            'account_active' => $req->user_account_active,
            'address' => $req->user_address,
            'city' => $req->user_city,
            'state' => $req->user_state,
            'zip' => $req->user_zip,
            'zone' => $req->user_zone,
            'card_id' => $req->user_card_id,
            'pin' => $req->user_pin,
            'miles' => $req->user_miles,
            'user_pin' => $req->user_userPin,
            'access' => $req->user_access,
            'phone' => $req->user_phone,
            'fax' => $req->user_fax,
            'cell' => $req->user_cell,
            'cus_group' => $req->user_cus_group,
            'opening_bal' => $req->user_openingBal,
            'current_bal' => $req->user_currentBal,
            'credit_limit' => $req->user_credit_limit,
            'post_credit_card_in_each_invoice' => $req->user_post_credit,
            'credit_type' => $req->user_credit_type,
            'credit_days' => $req->user_credit_days,
            'accept_split_order' => $req->user_accept_split_order,
            'transport_include_in_price' => $req->user_transport_include_in_price,
            'peach' => $req->user_peach,
            'income' => $req->user_income,
            'acc_rec' => $req->user_acc_rec,
            'acc_pay' => $req->user_acc_pay,
            'brand_invoice_acc' => $req->user_branch_invoice_acc,
            'card_pin' => $req->user_card_pin,
            'brand' => $req->user_brand,
            'terminal' => $req->user_terminal,
            'distributor' => $req->user_distributor,
            'Brand_transport' => $req->user_branch_transport,
            'credit_company' => $req->user_credit_company,
            'contract_date' => $req->user_contract_date,
            'expiry_date' => $req->user_expiry_date,
            'set_price' => $req->user_set_price,
            'buy_pass' => $req->user_buy_pass,
            'transport' => $req->user_transport,
            'sign_maintanance' => $req->user_sign_maintanance,
            'invested_by' => $req->user_invested_by,
            'owner' => $req->user_owner,
            'salesman' => $req->user_salesman,
            'cont_person' => $req->user_cont_person,
            'quiraga_fuelRate' => $req->user_quiroga_fuelRate,
            'quiraga_dieselRate' => $req->user_quiroga_diesel,
            'quiraga_flatRate' => $req->user_quiroga_flat,
            'startex_gas_oil_fuelRate' => $req->user_startex_gas_and_oil_fuelRate,
            'startex_gas_oil_dieselRate' => $req->user_startex_gas_and_oil_diesel,
            'startex_gas_oil_flatRate' => $req->user_startex_gas_and_oil_flat,
            'texas_trans_fuelRate' => $req->user_texas_trans_eastern_fuelRate,
            'texas_trans_dieselRate' => $req->user_texas_trans_eastern_diesel,
            'texas_trans_flatRate' => $req->user_texas_trans_eastern_flat,
            'coastal_transport_fuelRate' => $req->user_coastal_transport_fuelRate,
            'coastal_transport_dieselRate' => $req->user_coastal_transport_diesel,
            'coastal_transport_flatRate' => $req->user_coastal_transport_flat,

        ]);


        return redirect()->back();
    }



    // edit
    public function editCustomer($id){

        $customer = User::with('customerDetail')->find($id);

        return response()->json([
            'customer'=>$customer,
        ]);
    }


    // update user
    public function updateCustomer(Request $req){

        $user = User::with('customerDetail')->find($req->customerId);

        $user->name = $req->name;

        $user->email = $req->email;


        if($req->password != null){
            $password = $req->password;
            $hashedPassword = Hash::make($password);

            $user->password= $hashedPassword;
        }

        $user->save();

        $customers = CustomerDetail::where('user_id',$user->id)->first();


        $customers->customer = $req->customer_number;
         $customers->address = $req->address;
         $customers->account_active = $req->account_active;
         $customers->city = $req->city;
         $customers->state = $req->state;
         $customers->zip = $req->zip;
         $customers->zone = $req->zone;
         $customers->card_id = $req->card_id;
         $customers->pin = $req->pin;
         $customers->miles = $req->miles;
         $customers->pin = $req->user_pin;
         $customers->access = $req->access;
        $customers->phone = $req->phone;
         $customers->fax = $req->fax;
         $customers->cell = $req->cell;
         $customers->cus_group = $req->cus_group;
         $customers->opening_bal = $req->openingBal;
         $customers->current_bal = $req->currentBal;
         $customers->credit_limit = $req->credit_limit;
         $customers->post_credit_card_in_each_invoice = $req->post_credit_card_in_each_invoice;
         $customers->credit_type = $req->credit_type;
         $customers->credit_days = $req->credit_days;
         $customers->accept_split_order = $req->accept_split_order;
         $customers->transport_include_in_price = $req->transport_include_in_price;
        $customers->peach = $req->peach;
        $customers->income = $req->income;
        $customers->acc_rec = $req->acc_rec;
        $customers->acc_pay = $req->acc_pay;
        $customers->brand_invoice_acc = $req->brand_invoice_acc;
        $customers->card_pin = $req->card_pin;
        $customers->brand = $req->brand;
        $customers->terminal = $req->terminal;
        $customers->distributor = $req->distributor;
        $customers->Brand_transport = $req->brand_transport;
        $customers->credit_company = $req->credit_company;
        $customers->contract_date = $req->contract_date;
        $customers->expiry_date = $req->expiry_date;
        $customers->set_price = $req->set_price;
        $customers->buy_pass = $req->buy_pass;
        $customers->transport = $req->transport;
        $customers->sign_maintanance = $req->sign_maintanance;
        $customers->invested_by = $req->invested_by;
        $customers->owner = $req->owner;
        $customers->salesman = $req->salesman;
        $customers->cont_person = $req->cont_person;
        $customers->quiraga_fuelRate = $req->quiroga_fuelRate;
        $customers->quiraga_dieselRate = $req->quiroga_diesel;
        $customers->quiraga_flatRate = $req->quiroga_flat;
        $customers->startex_gas_oil_fuelRate = $req->startex_gas_and_oil_fuelRate;
        $customers->startex_gas_oil_dieselRate = $req->startex_gas_and_oil_diesel;
        $customers->startex_gas_oil_flatRate = $req->startex_gas_and_oil_flat;
        $customers->texas_trans_fuelRate = $req->texas_trans_eastern_fuelRate;
        $customers->texas_trans_dieselRate = $req->texas_trans_eastern_diesel;
        $customers->texas_trans_flatRate = $req->texas_trans_eastern_flat;
        $customers->coastal_transport_fuelRate = $req->coastal_transport_fuelRate;
        $customers->coastal_transport_dieselRate = $req->coastal_transport_diesel;
        $customers->coastal_transport_flatRate = $req->coastal_transport_flat;

        $customers->update();

        return redirect()->back();

    }


    // delete
    public function deleteCustomer($id){

        $user=User::find($id);

        if ($user) {
            $user->delete();

        }
        $customer = CustomerDetail::where('user_id',$user->id)->first();

        $customer->delete();

        session()->flash('message', 'Customer deleted successfully!');

        return redirect()->back();
    }


    public function customerListPage()
    {

        $customers = User::where('role_id',5)->count();

        return view('admin.customer.list',compact('customers'));
    }


    // yajra pagination
    public function getcustomerList(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            if($fromDate == null && $toDate == null){

                $data = User::with('customerDetail')->where('role_id',5)->get();
            }

            else{
                //Date Filter
                $data = User::with('customerDetail')->where('role_id',5)->whereBetween('created_at', [$fromDate, $toDate])->get();
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





    public function creditCard()
    {

        $customers = User::where('role_id',5)->count();
        $customerDetail = User::where('role_id',5)->get();

        // dd($customerDetail);

        return view('admin.customer.credit-card',compact('customers','customerDetail'));
    }


    // yajra pagination
    public function getcreditCard(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            if($fromDate == null && $toDate == null){

                $data = CustomerDetail::with('user')->get();
            }

            else{
                //Date Filter
                $data = CustomerDetail::with('user')->whereBetween('created_at', [$fromDate, $toDate])->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<button class="btn btn-sm  btn-info ml-2 my-3 edit" value="' . $row->id . '" type="button"><i class="fa fa-edit"></i></button>';

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


    // public function addcreditCard(Request $req){

    //     $customerDetail = CustomerDetail::where('id',$req->customer_id)->first();

    //     dd($customerDetail);

    //     $customerDetail->card_fee = $req->card_fee;
    //     $customerDetail->card_net = $req->card_net;
    //     $customerDetail->card_pin = $req->card_pin;
    //     $customerDetail->card_date = $req->card_date;
    //     $customerDetail->card_reference_no = $req->card_reference_no;
    //     $customerDetail->card_gross_amount = $req->card_gross_amount;
    //     $customerDetail->brand = $req->brand;

    //     $customerDetail->update();

    //     return redirect()->back();
    // }



    // edit
    public function editcreditCard($id){

        $customer = CustomerDetail::with('user')->find($id);

        return response()->json([
            'customer'=>$customer,
        ]);
    }


    // update user
    public function updatecreditCard(Request $req)
    {
        $customerDetail = CustomerDetail::find($req->customer_id);

        if (!$customerDetail) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        $customerDetail->card_fee = $req->card_fee;
        $customerDetail->card_net = $req->card_net;
        $customerDetail->card_pin = $req->card_pin;
        $customerDetail->card_date = $req->card_date;
        $customerDetail->card_reference_no = $req->card_reference_no;
        $customerDetail->card_gross_amount = $req->card_gross_amount;
        $customerDetail->brand = $req->brand;

        $customerDetail->save();

        return response()->json(['success' => true, 'message' => 'Credit card updated successfully']);
    }



    // delete
    public function deletecreditCard($id){

        $user=User::find($id);

        if ($user) {
            $user->delete();

        }
        $customer = CustomerDetail::where('user_id',$user->id)->first();

        $customer->delete();

        session()->flash('message', 'Customer deleted successfully!');

        return redirect()->back();
    }

}
