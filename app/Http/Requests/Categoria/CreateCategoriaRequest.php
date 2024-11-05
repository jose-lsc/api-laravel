<?php

namespace App\Http\Requests\Categoria;

use Illuminate\Contracts\Validation\Validator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateCategoriaRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return [
            "nome" => ["required"],
            "descricao" => ["required"]
        ];
    }

    public function messages(){
        return [
            "nome.required" => "O campo (nome) é obrigatório",
            "descricao.required" => "O campo (descricao) é obrigatório",
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
