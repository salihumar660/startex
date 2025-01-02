<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Branch;
use App\Models\SaleItem;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\InventoryCategory;
use App\Http\Controllers\Controller;

class BranchController extends Controller
{
    public function index()

    {


        $branch = Branch::count();
        $inventory = Inventory::count();

        $branches = Branch::all();
        $inventoryCategory = InventoryCategory::all();

        return view('admin.branches.index',compact('branch','branches','inventoryCategory'));
    }

        // yajra pagination
    public function getBranch(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            if($fromDate == null && $toDate == null){

                $data = Branch::get();
            }

            else{
                //Date Filter
                $data = Branch::whereBetween('created_at', [$fromDate, $toDate])->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {

                    $btn = '<button class="btn btn-sm  btn-info ml-2 my-3 edit" value="' . $row->id . '" type="button"><i class="fa fa-edit"></i></button>';
                    $btn = $btn .  '<a class="btn btn-sm btn-dark ml-2 my-3" href="'.url('/branch-detail/'.$row->id).'" role="button"><i class="fa fa-eye"></i></a>';
                    $btn = $btn .  '<a class="btn btn-sm btn-danger ml-2 my-3" href="'.url('/branch-delete/'.$row->id).'" role="button"><i class="fa fa-trash"></i></a>';

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


    public function addBranch(Request $req){

        Branch::insert([
            'name' => $req->name,
            'address' => $req->address,
            'created_at' => now(),
        ]);

        return redirect()->back();
    }


    // edit
    public function editBranch($id){

        $branch = Branch::find($id);

        return response()->json([
            'branch'=>$branch,
        ]);
    }



    // update Branch
    public function updateBranch(Request $req){

        $branch = Branch::find($req->branchId);

        $branch->name = $req->name;

        $branch->address = $req->address;

        $branch->save();


        return redirect()->back();

    }



    // delete Branch
    public function deleteBranch($id){

        $Branch=Branch::find($id);

        if ($Branch) {
            $Branch->delete();
        }

        session()->flash('message', 'Branch deleted successfully!');

        return redirect()->back();
    }


    // detail page
    public function detailBranch($id){

        $branch=Branch::find($id);

        $user = User::where('branch_id',$id)->first();

        $inventory = Inventory::count();

        $branches = Branch::all();
        $inventoryCategory = InventoryCategory::all();




        return view('admin.branches.detail',compact('user','id','branches','inventoryCategory'));
    }


    public function getBranchInventory(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');
            $branchId = $request->input('id');

            // Query to fetch inventory based on filters
            $query = Inventory::with('branch', 'category')
                              ->where('branch_id', $branchId);

            // Apply date filter if provided
            if($fromDate && $toDate) {
                $query->whereBetween('created_at', [$fromDate, $toDate]);
            }

            $data = $query->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $editBtn = '<button class="btn btn-sm btn-info ml-2 my-3 edit" value="' . $row->id . '" type="button"><i class="fa fa-edit"></i></button>';
                    $deleteBtn = '<a class="btn btn-sm btn-danger ml-2 my-3" href="'.url('/inventory-delete/'.$row->id).'" role="button"><i class="fa fa-trash"></i></a>';
                    return $editBtn . $deleteBtn;
                })
                ->addColumn('created_by', function($row) {
                    return Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
                })
                ->rawColumns(['action', 'created_by'])
                ->make(true);
        }
    }



    public function getBranchSale(Request $request)
    {
        if ($request->ajax()) {
            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');
            $branchId = $request->input('id');

            // Query to fetch total quantity sold, price, category, description, and ids of each inventory item within the specified branch
            $query = SaleItem::join('inventories', 'sale_items.inventory_id', '=', 'inventories.id')
                ->join('inventory_categories', 'inventories.category_id', '=', 'inventory_categories.id')
                ->selectRaw('inventories.id as inventory_id, inventories.name as inventory_name, inventories.description as inventory_description, inventories.price as inventory_price, inventory_categories.id as category_id, inventory_categories.name as category_name, SUM(sale_items.quantity_sold) as total_quantity_sold')
                ->where('inventories.branch_id', $branchId)
                ->groupBy('inventories.id', 'inventories.name', 'inventories.description', 'inventories.price', 'inventory_categories.id', 'inventory_categories.name');

            // Apply date filter if provided
            if ($fromDate && $toDate) {
                $query->whereBetween('sale_items.created_at', [$fromDate, $toDate]);
            }

            $data = $query->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('inventory_id', function($row) {
                    return $row->inventory_id;
                })
                ->addColumn('category_id', function($row) {

                    $data = InventoryCategory::find($row->category_id);

                    return $data->name;
                })
                ->addColumn('inventory_name', function($row) {
                    return $row->inventory_name;
                })
                ->addColumn('inventory_description', function($row) {
                    return $row->inventory_description;
                })
                ->addColumn('inventory_price', function($row) {
                    return $row->inventory_price . ' USD';
                })
                ->addColumn('category_name', function($row) {
                    return $row->category_name;
                })
                ->addColumn('total_quantity_sold', function($row) {
                    return $row->total_quantity_sold;
                })
                ->addColumn('total_value', function($row) {
                    return $row->inventory_price * $row->total_quantity_sold . ' USD';
                })

                ->addColumn('created_by', function($row) {
                    return Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
                })
                ->rawColumns(['action', 'created_by'])
                ->make(true);
        }
    }

}
