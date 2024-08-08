<?php

namespace App\Services;

use App\Models\Invoice_Details;
use App\Models\Invoice;
use App\Models\Invoice_Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceDetailsService
{
    public function getInvoiceDetails($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $details = Invoice_Details::where('id_Invoice', $id)->get();
        $attachments = Invoice_Attachment::where('invoice_id', $id)->get();

        return compact('invoice', 'details', 'attachments');
    }

    public function deleteInvoiceAttachment(Request $request)
    {
        $attachment = Invoice_Attachment::findOrFail($request->id_file);
        $attachment->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);
    }

    public function getFile($invoice_number, $file_name)
    {
        $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->download($contents);
    }

    public function openFile($invoice_number, $file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($invoice_number . '/' . $file_name);
        return response()->file($files);
    }
}
