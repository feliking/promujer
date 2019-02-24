@extends('layouts.print.print_provider_global')

@section('print-content')
<hr>
    <table class="w-100">
        <tr>
            <td class="text-center">
                <h4>Proveedor: Persona Natural</h4>
            </td>
        </tr>
        <tr>
            <td><hr></td>
        </tr>
    </table>
    <div class="row text-center w-100">
        <table class="table text-left">
            <tr>
                <td>Nombre: </td>
                <td>{{ $provider->first_name }} {{$provider->last_name }}</td>
            </tr>
            <tr>
                <td>Carnet de identidad: </td>
                <td>{{ $provider->identity_card }}</td>
            </tr>
            <tr>
                <td>Nacionalidad: </td>
                <td>{{ $provider->nationality }}</td>
            </tr>
            <tr>
                <td>Actividad economica principal: </td>
                <td>{{ $provider->economic_activity }}</td>
            </tr>
            <tr>
                <td>Ciudad de residencia: </td>
                <td>{{ $provider->city->name }}</td>
            </tr>
            <tr>
                <td>Telefono de contacto: </td>
                <td>{{ $provider->phone }}</td>
            </tr>
            <tr>
                <td>Dirección: </td>
                <td>{{ $provider->address }}</td>
            </tr>
            <tr>
                <td>Importe adjudicado: </td>
                <td>{{ $mount_awarded }}</td>
            </tr>
            <tr>
                <td>Detalle de lo adjudicado: </td>
                <td>{{ $detail_mount_awarded }}</td>
            </tr>
        </table>
    </div>

    <div class="row">
        <table class="w-100 text-center rounded" border="1">
            <tr>
                <td>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    ................................. <br>
                    Firma del administrador
                </td>
                <td>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    ................................. <br>
                    Firma del proveedor
                </td>
            </tr>
        </table>
    </div>
@endsection