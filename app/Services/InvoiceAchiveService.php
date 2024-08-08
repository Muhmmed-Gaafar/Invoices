<?php

namespace App\Services;

use App\Models\Invoice;

class InvoiceAchiveService
{
    public function archive($invoice)
    {
        $invoice->delete();
    }

    public function restore($id)
    {
        return Invoice::withTrashed()->where('id', $id)->restore();
    }

    public function forceDelete($id)
    {
        $invoice = Invoice::withTrashed()->where('id', $id)->first();
        if ($invoice) {
            $invoice->forceDelete();
        }
    }
}


