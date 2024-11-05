<?php

namespace App\Http\Requests\Pedido;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;

use Illuminate\Http\Exceptions\HttpResponseException;

class CreatePedidoRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente_id' => [
                'required',
                'exists:clientes,id'
            ],

            'pedido_pago' => ['required'],
            'produtos.*.produto_id' => [
                'required',
                'exists:produtos,id'
            ],
            'produtos.*.quantidade' => [
                'required',
                'integer',
                'min:1'
            ]

        ];
    }

    public function messages()
    {
        return [
            'cliente_id.required' => 'O campo (cliente_id) é obrigatório.',
            'cliente_id.exists' => 'O campo (cliente_id) precisa existir.',
            
            'pedido_pago.required' => 'O campo (pedido_pago) é obrigatório',
            'produto.*.produto_id.required' => 'O campo (produto.*.produto_id) é obrigatório',
            'produto.*.produto_id.exists' => 'O campo (produto.*.produto_id) precisa existir',

            'produto.*.quantidade.required' => 'O campo (produto.*.quantidade) é obrigatório',
            'produto.*.quantidade.min' => 'O campo (produto.*.quantidade) precisa ser maior que 0',
            'produto.*.quantidade.integer' => 'O campo (produto.*.quantidade) precisa ser inteiro',
            
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
