<?php

namespace App\Http\Requests;


use App\Rules\DateBetween;
use App\Rules\TimeBetween;
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
            'firstName' => ['required'],
            'lastName' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required'],
            'resTime' => ['required', 'date', new DateBetween(), new TimeBetween()],
            'table_id' => ['required'],
            'guestNumber' => ['required'],
        ];
    }
}
