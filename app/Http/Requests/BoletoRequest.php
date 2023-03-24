<?php

namespace App\Http\Requests;

use Exception;
use Illuminate\Contracts\Validation\Validator;


class BoletoRequest extends CustomFormRequest
{

    public function formatErrors(Validator $validator)
    {
        $prefix = array(
            "cod_erro" => "sistema.erro.pagamentos.boleto"
        );

        return array_merge($prefix, $validator->getMessageBag()->toArray());
    }

    public function rules()
    {

        return array(
            'transaction_amount'            => 'numeric|required',
            'description'                   => 'string',
            'payer'                         => 'array|required',
            'payer.email'                   => 'email',
            'payer.first_name'              => 'string|required',
            'payer.last_name'               => 'string|required',
            'payer.identification'          => 'array|required',
            'payer.identification.type'     => 'string|required',
            'payer.identification.number'   => 'integer|required',
            'payer.address'                 => 'array',
            'payer.address.zip_code'        => 'integer',
            'payer.address.street_name'     => 'string',
            'payer.address.neighborhood'    => 'string',
            'payer.address.city'            => 'string',
            'payer.address.federal_unit'    => 'string',
        );
    }
}