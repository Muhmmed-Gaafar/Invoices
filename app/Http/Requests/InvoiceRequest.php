<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'invoice_number' => 'required|string|min:6|max:6',
                'invoice_Date' => 'required|date',
                'Due_date' => 'required|date|after_or_equal:invoice_Date',
                'Amount_collection' => 'required|numeric',
                'Amount_Commission' => 'required|numeric',
                'Discount' => 'nullable|numeric',
                'product' => 'string|max:255',
                'note' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'invoice_number.required' => 'يرجي ادخال اسم الفاتوره',
            'invoice_number.unique' => 'اسم الفاتوره مسجل مسبقا',
            'invoice_Date.required' => 'يرجي ادخال تاريخ الفاتوره',
            'Due_date.required' => 'يرجي ادخال تاريخ استحقاق الفاتوره',
            'Amount_collection.required' => 'يرجي ادخال مبلغ التحصيل',
            'Amount_Commission.required' => 'يرجي ادخال مبلغ العمولة',
        ];
    }
}
