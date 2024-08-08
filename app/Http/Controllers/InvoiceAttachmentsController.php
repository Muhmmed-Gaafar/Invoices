<?php

namespace App\Http\Controllers;

use App\Models\Invoice_Attachment;
use Illuminate\Http\Request;
use App\Services\InvoiceAttachmentService;

class InvoiceAttachmentsController extends Controller
{
    protected $invoiceAttachmentService;

    /**
     * InvoiceAttachmentsController constructor.
     *
     * @param InvoiceAttachmentService $invoiceAttachmentService
     */
    public function __construct(InvoiceAttachmentService $invoiceAttachmentService)
    {
        $this->invoiceAttachmentService = $invoiceAttachmentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->invoiceAttachmentService->storeAttachment($request);
        session()->flash('Add', 'تم اضافة المرفق بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Invoice_Attachment $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice_Attachment $invoice_attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Invoice_Attachment $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice_Attachment $invoice_attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Invoice_Attachment $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice_Attachment $invoice_attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Invoice_Attachment $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice_Attachment $invoice_attachments)
    {
        //
    }
}
