<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "nome" => ["required"],
            "email" => ["required","email"],
            "telefone" => ["required"]
        ];
    }

    public function messages()
    {
        return [
            "nome.required" => "O campo (nome) é obrigatório",
            "email.required" => "O campo (email) é obrigatório",
            "email.email" => "O campo (email) esta com formato inválido",
            "telefone.required" => "O campo (telefone) é obrigatório"
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errorsValidator = $validator->errors()->toArray();
        $messages = [];

        foreach ($errorsValidator as $errors) {
            foreach ($errors as $error) {
                array_push($messages, $error);
            }
        }

        throw new HttpResponseException(response()->json([
            'error' => true,
            'messages' => $messages
        ], 400));
    }
}
