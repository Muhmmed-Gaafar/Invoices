<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerReportService;

class Customers_Report extends Controller
{
    protected $customerReportService;

    /**
     * Customers_Report constructor.
     *
     * @param CustomerReportService $customerReportService
     */
    public function __construct(CustomerReportService $customerReportService)
    {
        $this->customerReportService = $customerReportService;
    }

    /**
     * Display the customer report form.
     */
    public function index()
    {
        $sections = $this->customerReportService->getAllSections();
        return view('reports.customers_report', compact('sections'));
    }

    /**
     * Search for customer invoices.
     *
     * @param Request $request
     */
    public function Search_customers(Request $request)
    {
        $data = $request->all();

        $invoices = $this->customerReportService->searchInvoices($data);
        $sections = $this->customerReportService->getAllSections();

        return view('reports.customers_report', compact('sections'))->withDetails($invoices);
    }
}
