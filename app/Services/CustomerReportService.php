<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Section;

class CustomerReportService
{
    /**
     * Get all sections.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllSections()
    {
        return Section::all();
    }

    /**
     * Search invoices based on section, product, and optional date range.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function searchInvoices(array $data)
    {
        $query = Invoice::query();

        if (!empty($data['Section'])) {
            $query->where('section_id', $data['Section']);
        }

        if (!empty($data['product'])) {
            $query->where('product', $data['product']);
        }

        if (!empty($data['start_at']) && !empty($data['end_at'])) {
            $query->whereBetween('invoice_Date', [$data['start_at'], $data['end_at']]);
        }

        return $query->get();
    }
}
