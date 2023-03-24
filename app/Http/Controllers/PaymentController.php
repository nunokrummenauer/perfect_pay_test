<?php

namespace App\Http\Controllers;

use App\Http\Requests\BoletoRequest;
use App\Http\Requests\CreditCardRequest;
use App\Services\BoletoPaymentService;
use App\Services\CreditCardPaymentService;
use Exception;
use Illuminate\Routing\Controller;

use function PHPUnit\Framework\throwException;

class PaymentController extends Controller
{
    
    public function boleto(BoletoRequest $request)
    {
        try {
            $boleto = (new BoletoPaymentService())->payment($request->toArray());
            $link = $boleto['link'];
            return view('payments.return-boleto', $link);

        } catch (Exception $e) {
            return $e->getMessage();
        } 
    }

    public function creditCard(CreditCardRequest $request)
    {
        try {
            $creditCard = (new CreditCardPaymentService())->payment($request->toArray());
            return view('payments.return-credit-card', $creditCard);

        } catch (Exception $e) {
            return $e->getMessage();
        } 
    }

    

}