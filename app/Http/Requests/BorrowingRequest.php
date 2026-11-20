<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'due_date' => 'required|date|after:today',
        ];
    }

    public function messages(): array
    {
        return [
            'book_id.required' => 'Buku wajib dipilih.',
            'book_id.exists' => 'Buku tidak valid.',
            'member_id.required' => 'Member wajib dipilih.',
            'member_id.exists' => 'Member tidak valid.',
            'due_date.required' => 'Tanggal tempo wajib diisi.',
            'due_date.after' => 'Tanggal tempo harus setelah hari ini.',
        ];
    }
}
