<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
        if ($this->member->id) {
            $phone_number = 'required|max:255|unique:members,phone_number,' . $this->member->id;
        } else {
            $phone_number = 'required|unique:members|max:255';
        }
        return [
            'name' => 'required|max:255',
            'phone_number' => $phone_number,
            'address' => 'required|max:255',
        ];
    }
}
