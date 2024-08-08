<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Section;
use App\Models\InvoiceDetails;
use App\Models\InvoiceAttachment;
use App\Notifications\AddInvoice;
use App\Services\InvoiceService;
use App\Http\Requests\InvoiceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enums\InvoiceStatus;
use Illuminate\Support\Facades\Auth;

class InvoicesController extends Controller
{
    protected $invoiceService;

    public function __construct(InvoiceService $invoiceService)
    {
        $this->invoiceService = $invoiceService;
    }

    public function index()
    {
        $invoices = Invoice::orderByDesc('id')->get();
        return view('invoices.invoices', compact('invoices'));
    }

    public function create()
    {

        $sections = Section::orderByDesc('id')->get();
        return view('invoices.add_invoice', compact('sections'));
    }

    public function store(InvoiceRequest $request)
    {
        $invoice = $this->invoiceService->createInvoice($request);

        $user = Auth::user();
        $user->notify(new AddInvoice([
            'id' => $invoice->id,
            'number' => $invoice->invoice_number,
            'amount' => $invoice->amount,
            'user_id' => $user->id,
        ]));

        return responce('Add', 'تم اضافة الفاتورة بنجاح' ,'/invoices');
    }

    public function show($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        return view('invoices.status_update', compact('invoices'));


    }

    public function edit($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        $sections = Section::all();
        return view('invoices.edit_invoice', compact('sections', 'invoices'));
    }

    public function update(Request $request, Invoice $invoices)
    {

        $invoice = $this->invoiceService->updateInvoice($request);
        return responce('edit', 'تم تعديل الفاتورة بنجاح' ,'/invoices');

    }

    public function destroy(Request $request)
    {
        $this->invoiceService->deleteInvoice($request, $request->invoice_id);
        return responce('delete_invoice', 'تم حذف الفاتورة بنجاح' ,'/invoices');

    }

    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("Product_name", "id");
        return json_encode($products);
    }

    public function Status_Update($id, Request $request)
    {
        $invoice = $this->invoiceService->updateInvoiceStatus($id, $request);
        return responce('Status_Update', 'تم تحديث حالة الدفع بنجاح' ,'/invoices');

//        session()->flash('Status_Update');
//        return redirect('/invoices');
    }

    public function Invoice_Paid()
    {
        $invoices = Invoice::where('Value_Status', InvoiceStatus::PAID)->get();
        return view('invoices.invoices_paid', compact('invoices'));
    }

    public function Invoice_unPaid()
    {
        $invoices = Invoice::where('Value_Status', InvoiceStatus::UNPAID)->get();
        return view('invoices.invoices_unpaid', compact('invoices'));
    }

    public function Invoice_Partial()
    {
        $invoices = Invoice::where('Value_Status', InvoiceStatus::PARTIAL)->get();
        return view('invoices.invoices_Partial', compact('invoices'));
    }

    public function Print_invoice($id)
    {
        $invoices = Invoice::where('id', $id)->first();
        return view('invoices.Print_invoice', compact('invoices'));
    }

}
