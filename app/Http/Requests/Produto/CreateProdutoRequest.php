<?php

namespace App\Http\Requests\Produto;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateProdutoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'nome' => ['required'],
            'preco' => ['required'],
            'quantidade_estoque' => ['required'],
            'marca' => ['required'],
            'descricao' => ['required'],
            'categoria_ids' => [
                'required',
                'array',
                'min:1',
                'exists:categorias,id'
            ]
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'o campo (nome) é obrigatório',
            'preco.required' => 'o campo (preco) é obrigatório',
            'quantidade_estoque.required' => 'o campo (quantidade_estoque) é obrigatório',
            'marca.required' => 'o campo (marca) é obrigatório',
            'descricao.required' => 'o campo (descricao) é obrigatório',
            'categoria_ids.required' => 'o campo (categoria_ids) é obrigatório',
            'categoria_ids.array' => 'o campo (categoria_ids) deve ser um array',
            'categoria_ids.min' => 'o campo (categoria_ids) deve conter no mínimo um id',
            'categoria_ids.exists' => 'o campo (categoria_ids) contem um identificador inválido'
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
