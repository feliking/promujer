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
        <img src="{{ asset('images/print_logo.png') }}" alt="">
        <table class="table table-dark">
            <thead>
                <tr>
                <th scope="col">#</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">
                    {{ $provider->id }}
                    {{ $provider->code }}
                    {{ Auth::user()->name }}
                    {{ $provider->city_id }}
                </th>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script>
    $( document ).ready(function() {
        window.print();
    });
    </script>
</body>
</html>