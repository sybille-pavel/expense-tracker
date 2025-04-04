<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class StoreExpenseRequest extends FormRequest
    {
        public function authorize(): bool
        {
            return true; // авторизованный пользователь уже проверен
        }

        public function rules(): array
        {
            return [
                'description' => 'required|string|max:255',
                'amount' => 'required|numeric|min:0.01',
                'date' => 'required|date',
            ];
        }
    }
