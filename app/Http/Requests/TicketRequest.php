<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'trace-input-1' => ['required', 'exists:stations,NAME'],
            'trace-input-2' => ['required', 'exists:stations,NAME'],
            'date-input' => [ 'required', 'date'],
            'hour-input' => [ 'required', 'regex:/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/']
        ]; 
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */

    public function messages(){
        return [
            'trace-input-1.exists' => 'Taka stacja początkowa nie istnieje w naszej bazie',
            'trace-input-2.exists' => 'Taka stacja końcowa nie istnieje w naszej bazie',
            'trace-input-1.required' => 'Nazwa trasy jest wymagana',
            'trace-input-2.required' => 'Nazwa trasy jest wymagana',
            'date-input.required' => 'Data jest wymagana',
            'hour-input.required' => 'Godzina jest wymagana',
            'hour-input.regex' => 'Podales niepoprawna godzine - prawidłowy format gg:mm',
            'date-input.date' => 'Podana godzina nie jest datą'
        ];
    }
}
