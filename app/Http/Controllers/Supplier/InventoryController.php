<?php

namespace App\Http\Controllers\Supplier;

use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Invoice;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\InventoryCategory;
use App\Http\Controllers\Controller;

class InventoryController extends Controller
{
    public function view()
    {
        $inventory = Inventory::count();

        $branches = Branch::all();
        $inventoryCategory = InventoryCategory::all();


        return view('admin.supplier.inventory.index',compact('inventory','branches','inventoryCategory'));
    }

    // yajra pagination
    public function getSupplierInventory(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            if($fromDate == null && $toDate == null){

                $data = Inventory::with('branch','category')->get();
            }

            else{
                //Date Filter
                $data = Inventory::with('branch','category')->whereBetween('created_at', [$fromDate, $toDate])->get();
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

    // edit Inventory
    public function editinventoryRefill($id){

        $inventory= Inventory::find($id);

        return response()->json([
            'inventory'=>$inventory,
        ]);
    }



    public function updateinventoryRefill(Request $req) {
        $inventory = Inventory::find($req->inventoryId);

        if ($inventory) {

            $inventory->quantity = $req->update_quantity;
            $inventory->price = $req->update_price;


            $inventory->update();
        }


        return redirect()->back();
    }
}
