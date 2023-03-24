@extends('layouts.app')

@section('content')
<script src="https://sdk.mercadopago.com/js/v2"></script>

<form id="form-checkout" action="/payments/boleto" method="post">
<div>
    <div class="row justify-content-start">
        <div class="col-8 col-md-4">
            <label class="col-6" for="payerFirstName">Nome</label>
        </div>
        <div class="col-4 col-md-2">
            <input class="col-3" id="form-checkout__payerFirstName" name="payer[first_name]" type="text">
        </div>
    </div>
    <div class="row justify-content-start">
        <div class="col-8 col-md-4">
            <label class="col-6" for="payerLastName">Sobrenome</label>
        </div>
        <div class="col-4 col-md-2">
            <input class="col-3" id="form-checkout__payerLastName" name="payer[last_name]" type="text">
        </div>
    </div>
    <div class="row justify-content-start">
        <div class="col-8 col-md-4">
        <label class="col-6" for="email">E-mail</label>
        </div>
        <div class="col-4 col-md-2">
            <input class="col-3" id="form-checkout__email" name="payer[email]" type="text">
        </div>
    </div>
    <div class="row justify-content-start">
        <div class="col-8 col-md-4">
            <label class="col-6" for="identificationType">Tipo de documento</label>
        </div>
        <div class="col-4 col-md-2">
            <select class="col-3" id="form-checkout__identificationType" name="payer[identification][type]" type="text"></select>
        </div>
    </div>
    <div class="row justify-content-start">
        <div class="col-8 col-md-4">
            <label for="identificationNumber">Número do documento</label>
        </div>
        <div class="col-4 col-md-2">
            <input id="form-checkout__identificationNumber" name="payer[identification][number]" type="text">
        </div>
    </div>
    </div>
<div>
    <div class="row justify-content-start">
        <input type="hidden" name="transaction_amount" id="transactionAmount" value="150">
        <input type="hidden" name="description" id="description" value="Produto de Teste">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <br>
        <div class="col-4 col-md-2">
            <button class="btn btn-info" type="submit">Pagar</button>
        </div>
    </div>
</div>
</form>
@endsection

@section('script')
<script>
    const mp = new MercadoPago('TEST-2da1a4b3-6ce6-4044-b610-00718add9291');
    
    (async function getIdentificationTypes() {
        try {
            const identificationTypes = await mp.getIdentificationTypes();
            const identificationTypeElement = document.getElementById('form-checkout__identificationType');

            createSelectOptions(identificationTypeElement, identificationTypes);
        } catch (e) {
            return console.error('Error getting identificationTypes: ', e);
        }
        })();

        function createSelectOptions(elem, options, labelsAndKeys = { label: "name", value: "id" }) {
        const { label, value } = labelsAndKeys;

        elem.options.length = 0;

        const tempOptions = document.createDocumentFragment();

        options.forEach(option => {
            const optValue = option[value];
            const optLabel = option[label];

            const opt = document.createElement('option');
            opt.value = optValue;
            opt.textContent = optLabel;

            tempOptions.appendChild(opt);
        });

        elem.appendChild(tempOptions);
    }
</script>
@endsection