<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsUpdateRequest extends FormRequest
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
            "stand_amount" => ['required'],
            "dev_commission_on_point" => ['required'],
            "dev_commission_on_reservation" => ['required'],
            "tva_tax" => ['required'],
            "currency" => ['required']
        ];
    }
}
