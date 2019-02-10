<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                    {{ $id }}
                    {{ $code }}
                </th>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>