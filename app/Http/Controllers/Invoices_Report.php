<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InvoiceReportService;

class Invoices_Report extends Controller
{
    protected $invoiceReportService;

    /**
     * Invoices_Report constructor.
     *
     * @param InvoiceReportService $invoiceReportService
     */
    public function __construct(InvoiceReportService $invoiceReportService)
    {
        $this->invoiceReportService = $invoiceReportService;
    }

    /**
     * Show the form for searching invoices.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('reports.invoices_report');
    }

    /**
     * Search invoices based on the request parameters.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function Search_invoices(Request $request)
    {
        $invoices = $this->invoiceReportService->searchInvoices($request);

        $data = ['type' => $request->type];
        if ($request->start_at && $request->end_at) {
            $data['start_at'] = date($request->start_at);
            $data['end_at'] = date($request->end_at);
        }

        return view('reports.invoices_report', $data)->withDetails($invoices);
    }
}
