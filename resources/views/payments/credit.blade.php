@extends('layouts.app')

@section('content')
<script src="https://sdk.mercadopago.com/js/v2"></script>
<form id="form-checkout" action="/payments/credit-card" method="post">
    <div id="form-checkout__cardNumber" class="contain"></div>
    <div id="form-checkout__expirationDate" class="contain"></div>
    <div id="form-checkout__securityCode" class="contain"></div>
    <input type="text" id="form-checkout__cardholderName" />
    <select id="form-checkout__issuer"></select>
    <select id="form-checkout__installments"></select>
    <select id="form-checkout__identificationType"></select>
    <input type="text" id="form-checkout__identificationNumber" />
    <input type="email" id="form-checkout__cardholderEmail" />

    <button type="submit" class="btn btn-info" id="form-checkout__submit">Pagar</button>
    <progress value="0" class="progress-bar" role="progressbar">Carregando...</progress>
</form>
@endsection

@section('script')
<script>
    const mp = new MercadoPago('TEST-2da1a4b3-6ce6-4044-b610-00718add9291');

    const cardForm = mp.cardForm({
        amount: "150.0",
        iframe: true,
        form: {
        id: "form-checkout",

        cardNumber: {
            id: "form-checkout__cardNumber",
            placeholder: "Número do cartão",
        },
        expirationDate: {
            id: "form-checkout__expirationDate",
            placeholder: "MM/YY",
        },
        securityCode: {
            id: "form-checkout__securityCode",
            placeholder: "Código de segurança",
        },
        cardholderName: {
            id: "form-checkout__cardholderName",
            placeholder: "Titular do cartão",
        },
        issuer: {
            id: "form-checkout__issuer",
            placeholder: "Banco emissor",
        },
        installments: {
            id: "form-checkout__installments",
            placeholder: "Parcelas",
        },        
        identificationType: {
            id: "form-checkout__identificationType",
            placeholder: "Tipo de documento",
        },
        identificationNumber: {
            id: "form-checkout__identificationNumber",
            placeholder: "Número do documento",
        },
        cardholderEmail: {
            id: "form-checkout__cardholderEmail",
            placeholder: "E-mail",
        },
        },
        callbacks: {
        onFormMounted: error => {
            if (error) return console.warn("Form Mounted handling error: ", error);
            console.log("Form mounted");
        },
        onSubmit: event => {
            event.preventDefault();
            const csrf = document.getElementById("csrf-token");
            const {
            paymentMethodId: payment_method_id,
            issuerId: issuer_id,
            cardholderEmail: email,
            amount,
            token,
            installments,
            identificationNumber,
            identificationType,
            } = cardForm.getCardFormData();
            fetch("/payments/credit-card", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': csrf.getAttribute("content"),
            },
            body: JSON.stringify({
                token,
                issuer_id,
                payment_method_id,
                transaction_amount: Number(amount),
                installments: Number(installments),
                description: "Produto de Teste",
                payer: {
                email,
                identification: {
                    type: identificationType,
                    number: identificationNumber,
                },
                },
            }),
            });
        },
        onFetching: (resource) => {
            console.log("Fetching resource: ", resource);

            // Animate progress bar
            const progressBar = document.querySelector(".progress-bar");
            progressBar.removeAttribute("value");

            return () => {
            progressBar.setAttribute("value", "0");
            };
        }
        },
    });

</script>
@endsection