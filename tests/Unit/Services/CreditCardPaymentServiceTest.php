<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\CreditCardPaymentService;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\SDK;

class CreditCardPaymentServiceTest extends TestCase
{
    public function test_Credit_Card_Payment() {

        $sdkMock = $this->createMock(SDK::class);
        $paymentMock = $this->createMock(Payment::class);
        $payerMock = $this->createMock (Payer::class);
        
        $resultMock = array(
            'status' => 'approved',
            'status_detail' => 'accredited',
        );

        $sdkMock::setAccessToken(env('MP_ACCESS_TOKEN'));

        $paymentMock->transaction_amount = '20';
        $paymentMock->token = env('MP_ACCESS_TOKEN');
        $paymentMock->description = 'teste mock';
        $paymentMock->installments = '2';
        $paymentMock->payment_method_id = 'visa';
        $paymentMock->issuer_id = 'bradesco';
                
        $payerMock->email = 'teste@teste.com';
        $payerMock->identification = array(
            "type" => 'CPF',
            "number" => '12345678910'
        );

        $paymentMock->payer = $payerMock;
        
        $paymentMock->save();
        
        $response = array(
            'status' => $paymentMock->status,
            'status_detail' => $paymentMock->status_detail,
        );

        $this->assertEquals($response, $resultMock);
    }
}
