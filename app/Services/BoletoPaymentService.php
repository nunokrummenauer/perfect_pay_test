<?php

namespace App\Services;

use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\SDK;

class BoletoPaymentService
{

    public function payment ($data)
    {
        SDK::setAccessToken(config('app.mp_access_token'));

        $payment = new Payment();
        
        $payment->transaction_amount = $data['transaction_amount'];
        $payment->description = $data['description'];
        $payment->payment_method_id = "bolbradesco";
        
        $payer = new Payer();

        $payer->email = $data['payer']['email'];
        $payer->first_name = $data['payer']['first_name'];
        $payer->last_name = $data['payer']['last_name'];
        $payer->identification = array(
            "type" => $data['payer']['identification']['type'],
            "number" => $data['payer']['identification']['number']
        );

        if (array_key_exists('address',$data['payer'])) {
            $payer->address = array (
                "zip_code" => $data['payer']['address']['zip_code'],
                "street_name" => $data['payer']['address']['street'],
                "street_number" => $data['payer']['address']['number'],
                "neighborhood" => $data['payer']['address']['neighborhood'],
                "city" => $data['payer']['address']['city'],
                "federal_unit" => $data['payer']['address']['federal_unit']
            );
        }

        $payment->payer = $payer;

        $payment->save();

        $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'link' => $payment->transaction_details->external_resource_url,
        );

        return $response;
    }
}