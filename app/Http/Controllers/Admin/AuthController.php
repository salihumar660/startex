<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Branch;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    public function registerPage()
    {
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function loginPage()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }


    // dashboard

    public function dashboard()
    {
        $user = Auth::user();

        if($user->role_id == 2){
            $pendingOrder = Order::where('status','pending')->count();
            $deliveredOrder = Order::where('status','delivered')->count();

            $driverLoadPerDay = DB::table('split_loads')
            ->join('users', 'split_loads.driver_id', '=', 'users.id') // Join with users table
            ->select(
                DB::raw('DATE(split_loads.created_at) as date'),
                'split_loads.driver_id',
                'users.name as driver_name', // Fetch driver name
                DB::raw('SUM(split_loads.pickup_load) as total_load')
            )
            ->groupBy(DB::raw('DATE(split_loads.created_at)'), 'split_loads.driver_id', 'users.name') // Group by date, driver_id, and driver name
            ->orderBy('date', 'asc')
            ->get();


            return view('admin.subAdmin.dashboard.index', compact('pendingOrder', 'deliveredOrder', 'driverLoadPerDay'));

        }
        else   if($user->role_id == 3){
            return redirect('/dtn-bol');
        }
        else    if($user->role_id == 4){
            return redirect('/driver-order');
        }
        else    if($user->role_id == 5){
            return redirect('/order');
        }

        $user = User::count();
        $branch = Branch::count();


        $orderPerDay = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total_order')
        )
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('date', 'asc')
        ->get();


        $ordersByCompany = Order::select(
            'company',
            DB::raw('COUNT(*) as total_orders')
        )
        ->groupBy('company')
        ->orderBy('company', 'asc')
        ->get();


        $invoicesByAmount = Invoice::select(
            'description',
            DB::raw('SUM(amount) as total_amount')
        )->groupBy('description')
        ->orderBy('description', 'asc')
        ->get();


        $yearlyInvoiceAmount = Invoice::whereYear('created_at', now()->year)
        ->sum('amount');

        $monthlyInvoiceAmount = Invoice::whereYear('created_at', now()->year)
        ->whereMonth('created_at', now()->month)
        ->sum('amount');

        $dailyInvoiceAmount = Invoice::whereDate('created_at', today())
        ->sum('amount');

        return view('admin.dashboard.index', compact('user', 'branch', 'orderPerDay','ordersByCompany','invoicesByAmount','yearlyInvoiceAmount', 'monthlyInvoiceAmount', 'dailyInvoiceAmount'));
    }
}
