<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationStoreRequest extends FormRequest
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
            "for" => ['required'],
            "departure_city" => ['required'],
            "destination_city" => ['required'],
            "departure_date" => ['required'],
            "return_date" => [''],
            "passenger_number" => ['required', 'numeric', 'max:9'],
            "fidelity_code" => [''],
            "company" => [''],
            "firstname" => ['required'],
            "lastname" => ['required'],
            "email" => ['required', 'email'],
            "phone" => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:8'],
            // 'files' => ['required'],
            // 'files.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg|max:5240'],
            // "description" => ['required'],
        ];
    }
}
