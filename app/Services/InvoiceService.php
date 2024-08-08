<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\InvoiceDetails;
use App\Models\InvoiceAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoiceService
{
    public function createInvoice(Request $request)
    {
        $invoice = Invoice::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'finish_date' => $request->finish_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'transaction' => $this->transaction(),
        ]);
        $invoice->save();


        $invoice_id = Invoice::latest()->first()->id;
        InvoiceDetails::create([
            'id_Invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'Section' => $request->Section,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
            'Payment_Date' => $request->Payment_Date,
            'user' => (Auth::user()->name),
        ]);

        if ($request->hasFile('pic')) {
            $invoice_id = Invoice::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;

            $attachments = new InvoiceAttachment();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $invoice_number), $imageName);
        }




        return $invoice;
    }

    public function updateInvoice(Request $request)
    {
        $invoice = Invoice::findOrFail($request->invoice_id);
        $invoice->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'finish_date' => $request->finish_date,
            'product' => $request->product,
            'section_id' => $request->Section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'note' => $request->note,
        ]);

        return $invoice;
    }

    public function deleteInvoice(Request $request , $id)
    {
        $invoice = Invoice::where('id', $request->invoice_id)->first();

        if ($request->id_page != 2) {
            if (!empty($details->invoice_number)) {
                Storage::disk('public_uploads')->deleteDirectory($details->invoice_number);
            }
            $invoice->forceDelete();
        } else {
            $invoice->delete();
        }
        return $invoice;
    }

    public function updateInvoiceStatus($id, Request $request)
    {
        $invoice = Invoice::findOrFail($id);

        if ($request->Status === 'مدفوعة') {
            $invoice->update([
                'Value_Status' => 1,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);

            InvoiceDetails::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 1,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => Auth::user()->name,
            ]);
        } else {
            $invoice->update([
                'Value_Status' => 3,
                'Status' => $request->Status,
                'Payment_Date' => $request->Payment_Date,
            ]);

            InvoiceDetails::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'Section' => $request->Section,
                'Status' => $request->Status,
                'Value_Status' => 3,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => Auth::user()->name,
            ]);
        }

        return $invoice;
    }

    private function storeInvoiceAttachment(Request $request, $invoiceId)
    {
        $image = $request->file('pic');
        $fileName = $image->getClientOriginalName();
        $invoiceNumber = $request->invoice_number;

        InvoiceAttachment::create([
            'file_name' => $fileName,
            'invoice_number' => $invoiceNumber,
            'Created_by' => Auth::user()->name,
            'invoice_id' => $invoiceId,
        ]);

        $request->pic->move(public_path('Attachments/' . $invoiceNumber), $fileName);
    }

    public function transaction()
    {
        $lastTransaction = Invoice::latest('transaction')->first();
        $newTransaction = is_null($lastTransaction) ? 1000 : $lastTransaction->transaction + 1;

        return $newTransaction;
    }
}
