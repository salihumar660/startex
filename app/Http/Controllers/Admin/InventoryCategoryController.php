<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InventoryCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class InventoryCategoryController extends Controller
{
    public function index()
    {
        $inventoryCategory = InventoryCategory::count();


        return view('admin.inventoryCategory.index',compact('inventoryCategory'));
    }

        // yajra pagination
        public function getInventoryCategory(Request $request)
        {
            if ($request->ajax()) {

                $fromDate = $request->input('from_date');
                $toDate = $request->input('to_date');

                if($fromDate == null && $toDate == null){

                    $data = InventoryCategory::get();
                }

                else{
                    //Date Filter
                    $data = InventoryCategory::whereBetween('created_at', [$fromDate, $toDate])->get();
                }

                return Datatables::of($data)
                    ->addIndexColumn()

                    ->addColumn('action', function ($row) {

                        $btn = '<button class="btn btn-sm  btn-info ml-2 my-3 edit" value="' . $row->id . '" type="button"><i class="fa fa-edit"></i></button>';
                        $btn = $btn .  '<a class="btn btn-sm btn-danger ml-2 my-3" href="'.url('/inventoryCategory-delete/'.$row->id).'" role="button"><i class="fa fa-trash"></i></a>';

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
        public function addinventoryCategory(Request $req){

            InventoryCategory::insert([
                'name' => $req->name,
                'description' => $req->description,

                'created_at' => now(),
            ]);


            return redirect()->back();
        }
          // edit Inventory
    public function editinventoryCategory($id){

        $inventoryCategory= InventoryCategory::find($id);

        return response()->json([
            'inventoryCategory'=>$inventoryCategory,
        ]);
    }



    public function updateinventoryCategory(Request $req) {
        $inventoryCategory = InventoryCategory::find($req->inventoryCategoryId);

        if ($inventoryCategory) {
            $inventoryCategory->name = $req->name;
            $inventoryCategory->description = $req->update_description;


            $inventoryCategory->save();
        }


        return redirect()->back();
    }

    // delete inventoryCategory
    public function deleteinventoryCategory($id){

        $inventoryCategory=InventoryCategory::find($id);

        if ($inventoryCategory) {
            $inventoryCategory->delete();
        }

        session()->flash('message', 'Inventory deleted successfully!');

        return redirect()->back();
    }
}
