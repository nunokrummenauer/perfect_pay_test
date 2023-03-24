<?php

namespace App\Http\Requests;

use Exception;
use Illuminate\Contracts\Validation\Validator;


class CreditCardRequest extends CustomFormRequest
{

    public function formatErrors(Validator $validator)
    {
        $prefix = array(
            "cod_erro" => "sistema.erro.pagamentos.cartao"
        );

        return array_merge($prefix, $validator->getMessageBag()->toArray());
    }

    public function rules()
    {

        return array(
            'transaction_amount'            => 'numeric|required',
            'description'                   => 'string',
            'installments'                  => 'integer|required',
            'payment_method_id'             => 'string|required',
            'issuer_id'                     => 'integer|required',
            'payer'                         => 'array|required',
            'payer.email'                   => 'email',
            'payer.identification'          => 'array|required',
            'payer.identification.type'     => 'string|required',
            'payer.identification.number'   => 'integer|required'
        );
    }
}