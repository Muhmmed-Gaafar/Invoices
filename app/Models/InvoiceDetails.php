<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    protected $table = 'invoice_details';

    protected $fillable = [
        'id_Invoice', 'invoice_number', 'product', 'Section', 'Status', 'Value_Status', 'note', 'Payment_Date', 'user'
    ];
}
