<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SectionsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow the request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $sectionId = $this->route('id') ?? null;
        return [
            'id'=>'integer|exists:sections,id',
            'section_name' => 'required|string|unique:sections,section_name,' . $sectionId,
            'description' => 'nullable|string',
            'status' => 'required|integer',
            'pic' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'branch_id' => 'nullable|exists:branches,id',
            'Created_by' => Auth::user()->name,
        ];
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'section_name.required' => 'يرجي ادخال اسم القسم',
            'section_name.unique' => 'اسم القسم مسجل مسبقا',
            'status.required' => 'يرجي ادخال الحاله',
            'pic.mimes' => 'يرجى تحميل صورة بصيغة jpg, jpeg, png, pdf',
            'pic.max' => 'حجم الملف يجب ألا يتجاوز 2048 كيلوبايت',
        ];
    }
}

