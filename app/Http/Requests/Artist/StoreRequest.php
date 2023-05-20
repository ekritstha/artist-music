<?php

namespace App\Http\Requests\Artist;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'dob' => 'required|date|date_format:Y-m-d',
            'address' => 'required|string|max:255',
            'gender' => 'required|in:m,f,o',
            'first_release_year' =>'required|date_format:Y',
            'no_of_albums_released' => 'required|integer'
        ];
    }
}
