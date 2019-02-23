@extends('layouts.app')

@section('title')
Administrador
@endsection

@section('title-content')
Configurar Administrador
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <strong class="card-title">Credenciales del administrador</strong>
    </div>
    <div class="card-body">
        <!-- Credit Card -->
        <div id="pay-invoice">
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center">Administrador Pro Mujer IFD</h3>
                </div>
                <hr>
                <form action="{{route('user.updateadmin') }}" method="post">
                    @csrf
                    @method('POST')
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Nombre de usuario del administrador</label>
                        <input id="cc-payment" name="username" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{ old('username', $user->username) }}" required>
                    </div>
                    <div class="form-group has-success">
                        <label for="cc-name" class="control-label mb-1">Contraseña</label>
                        <input id="cc-name" name="password" type="password" class="form-control" required>
                        <span class="help-block field-validation-valid" data-valmsg-for="cc-name" data-valmsg-replace="true"></span>
                    </div>
                    <div class="form-group">
                        <label for="cc-number" class="control-label mb-1">Repita la Contraseña</label>
                        <input id="cc-number" name="password_confirmation" type="password" class="form-control" required>
                        <span class="help-block" data-valmsg-for="cc-number" data-valmsg-replace="true"></span>
                    </div>
                    <div>
                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                            <i class="fa fa-lock fa-lg"></i>&nbsp;
                            <span id="payment-button-amount">Actualizar administrador</span>
                            <span id="payment-button-sending" style="display:none;">Sending…</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div> <!-- .card -->

@endsection

