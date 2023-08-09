<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PassengerStudyRequest extends FormRequest
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
            "amount" => [$this->step == 1 ? 'required' : null, $this->step == 1 ? 'integer' : null],
            "ticket_number" => [$this->step == 2 ? 'required' : null],
            "ticket_file" => [$this->step == 2 ? 'mimes:pdf,jpeg,png,jpg,gif,svg|max:5240' : null],
        ];
    }
}
