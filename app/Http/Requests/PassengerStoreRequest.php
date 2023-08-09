<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PassengerStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "return_date" => [''],
            "formula" => ['required'],
            "cabin" => ['required'],
            "category" => ['required'],
            "firstname" => ['required'],
            "lastname" => ['required'],
            "email" => [''],
            "phone" => [''],
            'passport_number' => ['required'],
            'passport_file' => ['mimes:pdf,jpeg,png,jpg,gif,svg|max:5240'],
        ];
    }
}
