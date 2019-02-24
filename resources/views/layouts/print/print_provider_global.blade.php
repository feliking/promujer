<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('css/lib/bootstrap.min.css') }}">
</head>
<body>
    <div class="w-100">
        <table width="100%">
            <tr>
                <td style="width: 33%">
                    <img src="{{ asset('images/print_logo.png') }}" width="200px">
                </td>
                <td class="text-center" style="width: 34%">
                    <p class="h2">Pro Mujer IFD</p><br>
                    Sistema de Proveedores <br>
                    La Paz - Bolivia
                </td>
                <td class="text-right" style="width: 33%">
                    Nombre de usuario: {{ Auth::user()->username }} <br>
                    Fecha: {{ $date }}
                </td>
            </tr>
        </table>
        @yield('print-content')
        <div style="bottom:0; position: relative">
                <hr>
                <div class="row">
                    <div class="col-md-6 text-left">
                        Nombre de la empresa
                    </div>
                    <div class="col-md-6 text-right">
                        Fecha
                    </div>
                </div>
            </div>
    </div>
    
    
</body>
</html>