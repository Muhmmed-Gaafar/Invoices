<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invoice;
use App\Events\InvoiceArchived;
use Carbon\Carbon;

class ArchiveDueInvoices extends Command
{
protected $signature = 'invoices:archive-due';
protected $description = 'Archive invoices with due dates on or before the invoice date';

public function __construct()
{
parent::__construct();
}

public function handle()
{

$invoices = Invoice::whereColumn('due_date', '<=', 'invoice_date')->get();

foreach ($invoices as $invoice) {
    $invoice->delete();
}

$this->info('Due invoices have been archived.');

}
}

