<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Branch;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\InventoryCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::count();

        $branches = Branch::all();
        $inventoryCategory = InventoryCategory::all();

        return view('admin.inventories.index',compact('inventory','branches','inventoryCategory'));
    }

    // yajra pagination
    public function getInventory(Request $request)
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
                    $btn = $btn .  '<a class="btn btn-sm btn-danger ml-2 my-3" href="'.url('/inventory-delete/'.$row->id).'" role="button"><i class="fa fa-trash"></i></a>';

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
    public function addinventory(Request $req){

        Inventory::insert([
            'name' => $req->name,
            'description' => $req->description,
            'quantity' => $req->quantity,
            'price' => $req->price,
            // 'karat' => $req->karat,
            'branch_id' => $req->branch_id,
            'category_id' => $req->category_id,

            'created_at' => now(),
        ]);


        return redirect()->back();
    }
          // edit Inventory
    public function editinventory($id){

        $inventory= Inventory::find($id);

        return response()->json([
            'inventory'=>$inventory,
        ]);
    }



    public function updateinventory(Request $req) {
        $inventory = Inventory::find($req->inventoryId);

        if ($inventory) {
            $inventory->name = $req->name;
            $inventory->description = $req->update_description;
            $inventory->quantity = $req->update_quantity;
            $inventory->price = $req->update_price;
            // $inventory->karat = $req->update_karat;
            $inventory->branch_id = $req->update_branch_id;
            $inventory->category_id = $req->update_category_id;

            $inventory->save();
        }


        return redirect()->back();
    }

    // delete inventory
    public function deleteinventory($id){

        $inventory=Inventory::find($id);

        if ($inventory) {
            $inventory->delete();
        }

        session()->flash('message', 'Inventory deleted successfully!');

        return redirect()->back();
    }








}
