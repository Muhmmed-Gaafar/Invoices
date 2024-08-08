<?php

namespace App\Services;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceReportService
{
    /**
     * Search invoices based on the request parameters.
     *
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function searchInvoices(Request $request)
    {
        $rdio = $request->rdio;

        // Search by invoice type
        if ($rdio == 1) {
            if ($request->type && $request->start_at == '' && $request->end_at == '') {
                return Invoice::where('Status', $request->type)->get();
            } else {
                $start_at = date($request->start_at);
                $end_at = date($request->end_at);
                return Invoice::whereBetween('invoice_Date', [$start_at, $end_at])
                               ->where('Status', $request->type)
                               ->get();
            }
        } else {
            // Search by invoice number
            return Invoice::where('invoice_number', $request->invoice_number)->get();
        }
    }
}
