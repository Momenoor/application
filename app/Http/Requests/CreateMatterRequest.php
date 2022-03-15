<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateMatterRequest extends FormRequest
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

            'number' => 'required',
            'year'  => 'required|date_format:Y',
            'received_date' => 'required|date',
            'next_session_date' => 'required|date',
            'expert_id' => 'required|exists:experts,id',
            'court_id' => 'required|exists:courts,id',
            'type_id' => 'required|exists:types,id',
            'user_id' => 'required|exists:users,id',
            'external_marketing_rate' => 'integer',
            'commissioning' => 'required',
            //'status' => 'required',

        ];
    }
}
