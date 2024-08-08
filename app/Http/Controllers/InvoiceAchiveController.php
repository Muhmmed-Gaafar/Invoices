<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Services\InvoiceAchiveService;

class InvoiceAchiveController extends Controller
{
    protected $invoiceAchiveService;

    public function __construct(InvoiceAchiveService $invoiceAchiveService)
    {
        $this->invoiceAchiveService = $invoiceAchiveService;
    }

    public function index()
    {
        $invoices = Invoice::onlyTrashed()->get();
        return view('Invoices.Archive_Invoices', compact('invoices'));
    }

    public function update(Request $request)
    {
        $id = $request->invoice_id;
        $this->invoiceAchiveService->restore($id);


        session()->flash('restore_invoice', 'The invoice has been restored successfully.');
        return redirect('/invoices');
    }


    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $this->invoiceAchiveService->forceDelete($id);
        session()->flash('delete_invoice', 'The invoice has been permanently deleted.');
        return redirect('/Archive');
    }
}




