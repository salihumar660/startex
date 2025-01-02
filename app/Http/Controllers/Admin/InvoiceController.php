<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Dtn;
use App\Models\Order;
use App\Models\Invoice;
use Termwind\Components\Dt;
use Illuminate\Http\Request;
use App\Exports\InvoiceExport;
use App\Models\CustomerDetail;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class InvoiceController extends Controller
{
    public function generate($id){
        $order = Order::find($id);
        $dtn = Dtn::get();
        $customer = CustomerDetail::with('user')->where('user_id',$order->user_id)->first();

        // dd($customer);

        return view('admin.invoice.form',compact('dtn','customer','id'));
    }



    public function getInvoice(Request $request)
    {
        if ($request->ajax()) {

            $fromDate = $request->input('from_date');
            $toDate = $request->input('to_date');

            $user_id = Auth::user()->id;
            if($fromDate == null && $toDate == null){

                $data = Invoice::get();
            }

            else{
                //Date Filter
                $data = Invoice::whereBetween('created_at', [$fromDate, $toDate])->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $btn =  '<a class="btn btn-sm btn-dark ml-2 my-3" href="'.url('/invoice-pdf/'.$row->id).'" role="button"><i class="fas fa-file-invoice"></i></a>';

                    return $btn;
                })
                ->addColumn('created_by', function ($row) {

                    $created_at = $row->created_at;

                    $formatted_date = Carbon::parse($created_at)->format('Y-m-d H:i:s');
                    return $formatted_date;
                })
                ->rawColumns([ 'created_by','action'])
                ->make(true);
        }
    }

     public function addInvoice(Request $request){

       $order = Order::find($request->input('order_id'));
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Convert fields to integers and calculate values
        $rack = (float)$request->input('rack');
        $commission = (float)$request->input('commission');
        $tax = (float)$request->input('tax');
        $card_net = (float)$request->input('card_net');
        $charges_transportation_amount = (float)$request->input('charges_transportation_amount');
        $charges_gilbarco_amount = (float)$request->input('charges_gilbarco_amount');
        $charges_tx_delivery_fee = (float)$request->input('charges_tx_delivery_fee');
        $charges_cybera = (float)$request->input('charges_cybera');
        $charges_fed_oil_spil_fee = (float)$request->input('charges_fed_oil_spil_fee');
        $charges_transport_surcharge = (float)$request->input('charges_transport_surcharge');

        $price = $rack + $commission + $tax;
        $amount = $price * (float)$order->gallon;
        $add_charges = $charges_transportation_amount + $charges_gilbarco_amount + $charges_tx_delivery_fee
            + $charges_cybera + $charges_fed_oil_spil_fee + $charges_transport_surcharge;
        $gross_amount = $amount;
        $net_amount = $gross_amount + $add_charges + $card_net;

        $invoiceId = DB::table('invoices')->insertGetId([
            'order_id' => (float)$request->input('order_id'),
            'description' => $request->input('description'),
            'rack' => $rack + $commission,
            'tax' => $tax,
            'commission' => $commission,
            'price' => $price,
            'amount' => $amount,
            'card_date' => $request->input('card_date'),
            'card_ref' => $request->input('card_ref'),
            'card_net' => $card_net,
            'charges_transportation_amount' => $charges_transportation_amount,
            'charges_gilbarco_amount' => $charges_gilbarco_amount,
            'charges_tx_delivery_fee' => $charges_tx_delivery_fee,
            'charges_cybera' => $charges_cybera,
            'charges_fed_oil_spil_fee' => $charges_fed_oil_spil_fee,
            'charges_transport_surcharge' => $charges_transport_surcharge,
            'gross_amount' => $gross_amount,
            'add_charges' => $add_charges,
            'credit_cards' => $card_net,
            'net_amount' => $net_amount,
            'created_at' => Carbon::now(),
        ]);

        $invoice = Invoice::with('customer','dtn')->find($invoiceId);


        return redirect('/invoice-pdf/'. $invoice->id);
    }

     public function generatePdf($id){
        $invoice = Invoice::with('order')->find($id);

        return view('admin.invoice.index', compact('invoice'));
    }


    public function exportInvoice($id)
    {
        $order = Order::findOrFail($id);

        $invoice = Invoice::with('customer')->where('order_id', $id)->first();


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Order gallon');
        $sheet->setCellValue('B1', 'Order address');
        $sheet->setCellValue('C1', 'Order company');
        $sheet->setCellValue('D1', 'Order date');
        $sheet->setCellValue('E1', 'Order type of oil');
        $sheet->setCellValue('F1', 'Order status');
        $sheet->setCellValue('G1', 'Invoice description');
        $sheet->setCellValue('H1', 'Invoice rack');
        $sheet->setCellValue('I1', 'Invoice tax');
        $sheet->setCellValue('J1', 'Invoice commission');
        $sheet->setCellValue('K1', 'Invoice price');
        $sheet->setCellValue('L1', 'Invoice amount');
        $sheet->setCellValue('M1', 'Invoice card_date');
        $sheet->setCellValue('N1', 'Invoice card_ref');
        $sheet->setCellValue('O1', 'Invoice card_net');
        $sheet->setCellValue('P1', 'Invoice charges_transportation_amount');
        $sheet->setCellValue('Q1', 'Invoice charges_gilbarco_amount');
        $sheet->setCellValue('R1', 'Invoice charges_tx_delivery_fee');
        $sheet->setCellValue('S1', 'Invoice charges_cybera');
        $sheet->setCellValue('T1', 'Invoice charges_fed_oil_spil_fee');
        $sheet->setCellValue('U1', 'Invoice charges_transport_surcharge');
        $sheet->setCellValue('V1', 'Invoice gross_amount');
        $sheet->setCellValue('W1', 'Invoice add_charges');
        $sheet->setCellValue('X1', 'Invoice credit_charges');
        $sheet->setCellValue('Y1', 'Invoice net_charges');


        $sheet->setCellValue('A2', $order->gallon);
        $sheet->setCellValue('B2', $order->address);
        $sheet->setCellValue('C2', $order->company);
        $sheet->setCellValue('D2', $order->date);
        $sheet->setCellValue('E2', $order->status);
        $sheet->setCellValue('F2', $order->status);
        $sheet->setCellValue('G2', $invoice->description);
        $sheet->setCellValue('H2', $invoice->rack);
        $sheet->setCellValue('I2', $invoice->tax);
        $sheet->setCellValue('J2', $invoice->commission);
        $sheet->setCellValue('K2', $invoice->price);
        $sheet->setCellValue('L2', $invoice->amount);
        $sheet->setCellValue('M2', $invoice->card_date);
        $sheet->setCellValue('N2', $invoice->card_ref);
        $sheet->setCellValue('O2', $invoice->card_net);
        $sheet->setCellValue('P2', $invoice->charges_transportation_amount);
        $sheet->setCellValue('Q2', $invoice->charges_gilbarco_amount);
        $sheet->setCellValue('R2', $invoice->charges_tx_delivery_fee);
        $sheet->setCellValue('S2', $invoice->charges_cybera);
        $sheet->setCellValue('T2', $invoice->charges_fed_oil_spil_fee);
        $sheet->setCellValue('U2', $invoice->charges_transport_surcharge);
        $sheet->setCellValue('V2', $invoice->gross_amount);
        $sheet->setCellValue('W2', $invoice->add_charges);
        $sheet->setCellValue('X2', $invoice->credit_charges);
        $sheet->setCellValue('Y2', $invoice->net_charges);


        $writer = new Xlsx($spreadsheet);

        $filename = "Invoice_Order_{$id}.xlsx";

        return response()->stream(
            function() use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment;filename="' . $filename . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }

    public function exportAllInvoices()
    {
        $orders = Order::with('invoice')->get();

        // dd($orders);
        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No data found.'], 404);
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $headers = [
            'Order Gallon', 'Order Address', 'Order Company', 'Order Date', 'Order Type of Oil', 'Order Status',
            'Invoice Description', 'Invoice Rack', 'Invoice Tax', 'Invoice Commission',
            'Invoice Price', 'Invoice Amount', 'Invoice Card Date', 'Invoice Card Ref',
            'Invoice Card Net', 'Transportation Charges', 'Gilbarco Charges',
            'TX Delivery Fee', 'Cybera Charges', 'Oil Spill Fee',
            'Transport Surcharge', 'Gross Amount', 'Additional Charges',
            'Credit Charges', 'Net Charges'
        ];

        // Set headers in the first row
        foreach ($headers as $index => $header) {
            $column = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index + 1);
            $sheet->setCellValue($column . '1', $header);
        }

        // Populate data
        $row = 2; // Start from the second row
        foreach ($orders as $order) {
            $invoice = $order->invoice;

            $sheet->setCellValue('A' . $row, $order->gallon);
            $sheet->setCellValue('B' . $row, $order->address);
            $sheet->setCellValue('C' . $row, $order->company);
            $sheet->setCellValue('D' . $row, $order->date);
            $sheet->setCellValue('E' . $row, $order->type_of_oil ?? ''); // Adjust based on your schema
            $sheet->setCellValue('F' . $row, $order->status);

            if ($invoice) {
                $sheet->setCellValue('G' . $row, $invoice->description);
                $sheet->setCellValue('H' . $row, $invoice->rack);
                $sheet->setCellValue('I' . $row, $invoice->tax);
                $sheet->setCellValue('J' . $row, $invoice->commission);
                $sheet->setCellValue('K' . $row, $invoice->price);
                $sheet->setCellValue('L' . $row, $invoice->amount);
                $sheet->setCellValue('M' . $row, $invoice->card_date);
                $sheet->setCellValue('N' . $row, $invoice->card_ref);
                $sheet->setCellValue('O' . $row, $invoice->card_net);
                $sheet->setCellValue('P' . $row, $invoice->charges_transportation_amount);
                $sheet->setCellValue('Q' . $row, $invoice->charges_gilbarco_amount);
                $sheet->setCellValue('R' . $row, $invoice->charges_tx_delivery_fee);
                $sheet->setCellValue('S' . $row, $invoice->charges_cybera);
                $sheet->setCellValue('T' . $row, $invoice->charges_fed_oil_spil_fee);
                $sheet->setCellValue('U' . $row, $invoice->charges_transport_surcharge);
                $sheet->setCellValue('V' . $row, $invoice->gross_amount);
                $sheet->setCellValue('W' . $row, $invoice->add_charges);
                $sheet->setCellValue('X' . $row, $invoice->credit_charges);
                $sheet->setCellValue('Y' . $row, $invoice->net_charges);
            }

            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        $filename = "All_Invoices.xlsx";

        // Return file for download
        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment;filename="' . $filename . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }




}
