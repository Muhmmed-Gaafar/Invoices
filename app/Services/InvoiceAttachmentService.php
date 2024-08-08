<?php

namespace App\Services;

use App\Models\Invoice_Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceAttachmentService
{
    /**
     * Store a newly created invoice attachment in storage.
     *
     * @param Request $request
     * @return void
     */
    public function storeAttachment(Request $request)
    {
        $validatedData = $request->validate([
            'file_name' => 'mimes:pdf,jpeg,png,jpg',
        ], [
            'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
        ]);

        $image = $request->file('file_name');
        $file_name = $image->getClientOriginalName();

        $attachments = new Invoice_Attachment();
        $attachments->file_name = $file_name;
        $attachments->invoice_number = $request->invoice_number;
        $attachments->invoice_id = $request->invoice_id;
        $attachments->Created_by = Auth::user()->name;
        $attachments->save();

        // Move file
        $request->file_name->move(public_path('Attachments/' . $request->invoice_number), $file_name);
    }
}
