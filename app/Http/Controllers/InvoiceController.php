<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Invoice;

use App\InvoiceEntry;

use App\Product;

class InvoiceController extends Controller
{
    //
    public function editInvoice($invoiceId) {

        $invoice = Invoice::firstWhere('id', $invoiceId);
        //dd($invoice);

        $invoiceEntries = InvoiceEntry::where('invoice_id', $invoiceId)->get();
        // dd($invoiceEntries);

        $products = Product::all();
        // dd($products);      

        return view('newInvoice', ['invoice' => $invoice, 'invoiceEntries' => $invoiceEntries, 'products' => $products]);

    }

    public function showInvoice($invoiceId) {

        $invoice = Invoice::firstWhere('id', $invoiceId);
        //dd($invoice);

        $invoiceEntries = InvoiceEntry::where('invoice_id', $invoiceId)->get();
        // dd($invoiceEntries);

        $products = Product::all();
        // dd($products);      

        return view('showInvoice', ['invoice' => $invoice, 'invoiceEntries' => $invoiceEntries, 'products' => $products]);

    }

    public function newInvoice() {

        $products = Product::all();

        return view('newInvoice', ['products' => $products]);

    }

    public function listInvoices() {

        $invoices = Invoice::all();
               
        return view('listInvoices', ['invoices' => $invoices]);

    }

    public function insertInvoice(Request $request) {

        $input = $request->all();
        // dd($input);
        $invoice = new Invoice();
        $invoice->invoiceDate = date("Y-m-d");
        $invoice->dueDate = date_format(date_add(date_create(),date_interval_create_from_date_string("14 days")), "Y-m-d");
        $invoice->customerName = $input['cName'];
        $invoice->customerAddress = $input['cAddress'];
        $invoice->customerEmail = $input['cEmail'];
        $invoice->save();
        // dd($invoice);
        $x = 1;
        while($x <= $input['newEntries']) {
            $invoiceEntry = new InvoiceEntry();
            $str = "pId" . $x;
            $invoiceEntry->productId = $input[$str];
            $product = Product::where('productId', $invoiceEntry->productId)->firstOrFail();
            $str = "pQty" . $x;
            $invoiceEntry->productQuantity = $input[$str];
            $invoiceEntry->invoice_id = $invoice->id;
            $invoiceEntry->invoiceEntryPrice = $product->productPrice;
            $invoiceEntry->save();
            $x++;
        }
        // dd($invoiceEntry);
        return redirect('/');
    }

    public function updateInvoice($invoiceId, Request $request) {

        $invoice = Invoice::firstWhere('id', $invoiceId);
        // dd($invoice);

        $input = $request->all();
        // dd($input);
        $invoice->customerName = $input['cName'];
        $invoice->customerAddress = $input['cAddress'];
        $invoice->customerEmail = $input['cEmail'];
        $invoice->save();
        // dd($invoice);
        $invoiceEntries = InvoiceEntry::where('invoice_id', $invoiceId)->get();
        // dd($invoiceEntries);
        foreach($invoiceEntries as $invoiceEntry) {
            $str = "eId" . $invoiceEntry->id;
            if(array_key_exists($str, $input)) {
                $invoiceEntry->productId = $input[$str];
            }
            $str = "eQty" . $invoiceEntry->id;
            if(array_key_exists($str, $input)) {
                $invoiceEntry->productQuantity = $input[$str];
            }
        $invoiceEntry->save();
        }
        // dd($input);
        $x = 1;
        while($x <= $input['newEntries']) {
            $invoiceEntry = new InvoiceEntry();
            $str = "pId" . $x;
            if(array_key_exists($str, $input)) {
                $invoiceEntry->productId = $input[$str];
            }
            $str = "pQty" . $x;
            if(array_key_exists($str, $input)) {
                $invoiceEntry->productQuantity = $input[$str];
            }
            $invoiceEntry->invoice_id = $invoice->id;
            $invoiceEntry->save();
            $x++;
        }
        // dd($invoiceEntry);
        return redirect('/');
    }


}
