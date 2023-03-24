<?php

namespace App\Services;

use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\SDK;

class CreditCardPaymentService
{

    public function payment ($data)
    {
        SDK::setAccessToken(config('app.mp_access_token'));

        $payment = new Payment();

        $payment->transaction_amount = $data['transaction_amount'];
        $payment->token = $data['token'];
        $payment->description = $data['description'];
        $payment->installments = $data['installments'];
        $payment->payment_method_id = $data['payment_method_id'];
        $payment->issuer_id = $data['issuer'];

        $payer = new Payer();

        $payer->email = $data['email'];
        $payer->identification = array(
            "type" => $data['payer']['identification']['type'],
            "number" => $data['payer']['identification']['number']
        );

        $payment->payer = $payer;
        
        $payment->save();
        
        $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
        );


        return $response;
    }
}