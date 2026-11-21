<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:190'],
            'phone' => ['nullable', 'string', 'max:30', 'regex:/^[0-9+\-\s()]+$/'],
            'subject' => ['required', 'string', 'max:190'],
            'message' => ['required', 'string', 'min:10', 'max:3000'],
            // Honeypot: must stay empty (hidden from humans).
            'website' => ['nullable', 'max:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nama', 'email' => 'email', 'phone' => 'telepon',
            'subject' => 'subjek', 'message' => 'pesan',
        ];
    }
}
