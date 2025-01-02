<?php

namespace App\Http\Controllers\SubAdmin;

use Carbon\Carbon;
use App\Models\Sale;
use App\Models\User;
use App\Models\SaleItem;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Barryvdh\Snappy\Facades\SnappyImage;

class SaleController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $inventories = Inventory::where('branch_id',$user->branch_id)->get();
        return view('admin.subAdmin.index',compact('inventories','user'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'buyer_name' => 'required|string|max:255',
            'inventory_ids' => 'required|array',
            'quantities' => 'required|array',
            'prices' => 'required|array',
        ]);

        $user = Auth::user();

        $original_total_price = 0;
        $total_vat = 0;

        foreach ($request->quantities as $index => $quantity) {
            $price = $request->prices[$index];
            $subtotal = $quantity * $price;
            $vat = $subtotal * 0.15;

            $original_total_price += $subtotal;
            $total_vat += $vat;
        }

        $total_price_with_vat = $original_total_price + $total_vat;

        $saleId = Sale::insertGetId([
            'buyer_name' => $request->buyer_name,
            'branch_id' => $user->branch_id,
            'price' => $original_total_price,
            'total_price' => $total_price_with_vat,
            'created_at' => now(),
        ]);

        foreach ($request->inventory_ids as $index => $inventory_id) {
            $quantity_sold = $request->quantities[$index];
            $price = $request->prices[$index];
            $subtotal = $quantity_sold * $price;
            $vat = $subtotal * 0.15; // Calculate VAT
            $total_price_with_vat = $subtotal + $vat;


            SaleItem::insertGetId([
                'sale_id' => $saleId,
                'inventory_id' => $inventory_id,
                'quantity_sold' => $quantity_sold,
                'price' => $subtotal,
                'vat' => $vat,
                'created_at' => now(),
            ]);

            // Update inventory
            $inventory = Inventory::find($inventory_id);
            $inventory->quantity -= $quantity_sold;
            $inventory->save();
        }

        return redirect()->route('invoice.show', $saleId);
    }


    public function show($id)
    {
        $sale = Sale::with('saleItems.inventory' , 'branch', 'user')->findOrFail($id);

        // dd($sale->user->name);

        return view('admin.subAdmin.show', compact('sale'));

        // $pdf = Pdf::setOption(['isHtmlParserEnabled' => true,'isRemoteEnabled'=>true,'defaultFont' => 'sans-serif'])->loadView('admin.subAdmin.show', compact('sale'))->setPaper('A4', 'landscape');

        // return $pdf->stream("pdfcard.pdf");

        // return view('admin.subAdmin.show', compact('sale'));
    }

}
