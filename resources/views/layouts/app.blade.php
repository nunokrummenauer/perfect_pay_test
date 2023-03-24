<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>
        #form-checkout {
            display: flex;
            flex-direction: column;
            max-width: 500px;
        }

        .contain {
            height: 20px;
            display: inline-block;
            border: 1px solid rgb(118, 118, 118);
            border-radius: 2px;
            padding: 1px 2px;
            max-width: 500px;
        }
        #app {
            padding: 20px 10px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav>
            <div class="container">
                <a href="{{ url('/') }}">
                </a>
            </div>
        </nav>
        <main class="py-4">
            <div class="container">
                <img class="col-4" src="{{ asset('img/logo_perfectpay.png') }}" />
            </div>
            <div class="container">
                <br />
                <div class="card">
                    <div class="card-header">
                        <p class="h4">Produto: Produto de Teste</p>
                        <p class="h4">Valor da Compra: R$ 150.00</p>
                    </div>
                    <div class="card-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

@yield('script')

