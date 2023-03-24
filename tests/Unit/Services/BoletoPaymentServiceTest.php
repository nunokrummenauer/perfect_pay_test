<?php

namespace Tests\Unit\Services;

use App\Services\BoletoPaymentService;
use PHPUnit\Framework\TestCase;
use App\Services\CreditCardPaymentService;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\SDK;

class BoletoPaymentServiceTest extends TestCase
{
    public function test_Credit_Card_Payment() {

        $sdkMock = $this->createMock(SDK::class);
        $paymentMock = $this->createMock(Payment::class);
        $payerMock = $this->createMock (Payer::class);
        
        $dataMock = array(
            "transaction_amount" => "150",
            "description" => "Produto de Teste",
            "payer" => array(
                "email" => "teste@teste.com",
                "first_name" => "Teste",
                "last_name" => "123",
                "identification" => array(
                    "type" => "CPF",
                    "number" => "12345678909"
                )
            )
        );

        $response =  (new BoletoPaymentService())->payment($dataMock);

        $this->assertEquals($response, []);
    }
}
