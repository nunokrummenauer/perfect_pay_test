<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
        <title>Retorno - Boleto</title>
        
        <style>
            .text-return {
                text-align:center;
            }
        </style>
    </head>
    <body>
        <div class="text-return">
            <h4>Pagamento realizado com sucesso!</h4>
            <br />
            <a href={{$link}}>Clique aqui para baixar seu boleto</a>.
            <h4>Obrigado =D</h4>
        </div>
    </body>
</html>
