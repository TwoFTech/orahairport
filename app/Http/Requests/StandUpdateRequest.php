<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Stand;

class StandUpdateRequest extends FormRequest
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
            "enseigne" => ['required'],
            "country" => ['required'],
            "city" => ['required'],
            "quartier" => ['required'],
            "rue" => ['required'],
            "phone" => ['required', Rule::unique('stands', 'phone')->ignore($this->stand)],
            "code" => ['']
        ];
    }
}
