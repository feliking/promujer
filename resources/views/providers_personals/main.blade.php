@extends('layouts.app')

@section('title-content')
Proveedores: Persona Natural
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('css/lib/datatable/dataTables.bootstrap.min.css') }}">
<style>
.dataTables_filter{
    float: left;
}
</style>
@endsection
@section('content')
<div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Lista de Proveedores: Persona Natural</strong>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_provider_personal" title="Añadir Proveedor"><i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#print" title="Imprimir"><i class="fa fa-print"></i></button>
                </div>
                
                <div class="card-body text-left">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Código</th>
                                <th>Apellidos</th>
                                <th>Nombres</th>
                                <th>Carnet de identidad</th>
                                <th>Exp.</th>
                                <th>NIT</th>
                                <th>Nacionalidad</th>
                                <th>Actividad Economica</th>
                                <th>Ciudad de residencia</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Corréo Electrónico</th>
                                <th>NRO de cuenta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(proveedor, index) in providers">
                                <td>
                                    <button type="button" class="btn btn-link" title="Documentos guardados" data-toggle="modal" :data-target="'#doc'+proveedor.id"><i class="fa fa-file-text"></i></button>
                                    <button type="button" class="btn btn-link" title="Editar Proveedor" data-toggle="modal" :data-target="'#edit'+proveedor.id"><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-link" title="Eliminar Proveedor" data-toggle="modal" :data-target="'#del'+proveedor.id"><i class="fa fa-trash-o"></i></button>
                                </td>
                                <td>@{{ proveedor.code }}</td>
                                <td>@{{ proveedor.last_name }}</td>
                                <td>@{{ proveedor.first_name }}</td>
                                <td>@{{ proveedor.identity_card }}</td>
                                <td>@{{ getCity(proveedor) }}</td>
                                <td>@{{ proveedor.nit }}</td>
                                <td>@{{ proveedor.nationality }}</td>
                                <td>@{{ proveedor.economic_activity }}</td>
                                <td>@{{ proveedor.residence_city }}</td>
                                <td>@{{ proveedor.phone }}</td>
                                <td>@{{ proveedor.address }}</td>
                                <td>@{{ proveedor.email }}</td>
                                <td>@{{ proveedor.nro_acount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
{{-- Modal de agregación--}}
<div class="modal fade" id="add_provider_personal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" @submit.prevent="addProvider()">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Datos del nuevo proveedor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class="form-control-label">Código</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="code" class="form-control" :class="errors.code ? 'is-invalid' : ''" v-model="provider.code">
                                    <small v-if="errors.code" class="form-text text-danger">@{{ errors.code }}</small>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Apellidos</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="provider.last_name" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nombres</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="first_name" class="form-control" v-model="provider.first_name" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="email-input" class=" form-control-label">Carnet de identidad</label></div>
                                <div class="col-12 col-md-5"><input type="text" name="identity_card" class="form-control" v-model="provider.identity_card" required></div>
                                <div class="col col-md-1"><label for="email-input" class=" form-control-label">Exp.</label></div>
                                <div class="col-12 col-md-3">
                                    <select name="city_id" class="form-control" v-model="provider.city_id">
                                        <option v-for="(city, index) in cities" :value="city.id">@{{ city.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">NIT</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="nit" class="form-control" v-model="provider.nit" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nacionalidad</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="nationality" class="form-control" v-model="provider.nationality" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Actividad economica</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="economic_activity" class="form-control" v-model="provider.economic_activity" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Ciudad de residencia</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="residence_city" class="form-control" v-model="provider.residence_city" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Teléfonos</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="phone" class="form-control" v-model="provider.phone" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dirección</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="address" class="form-control" v-model="provider.address"required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Corréo Electrónico</label></div>
                                <div class="col-12 col-md-9"><input type="email" id="text-input" name="email" class="form-control" v-model="provider.email" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nro Cuenta</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="nro_acount" class="form-control" v-model="provider.nro_acount" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">Carnet de identidad</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="file_identity_card" ref="file_identity_card" name="file_identity_card" class="form-control-file"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">NIT</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="file_nit" ref="file_nit" name="file_nit" class="form-control-file"></div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- End Modal --}}
    {{-- Modal de muestra de documentos --}}
    <div v-for="(proveedor, index) in providers" class="modal fade" :id="'doc'+proveedor.id" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticModalLabel">Documentos Guardados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            @{{ proveedor.last_name+' '+proveedor.first_name }}
                       </p>
                       <p>
                           <a :href="'../storage/'+proveedor.file_identity_card" target="_blank">
                            <button v-if="proveedor.file_identity_card" type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                            </a>
                            <button v-if="!proveedor.file_identity_card" type="button" class="btn btn-danger"  disabled><i class="fa fa-eye-slash"></i></button>
                            CARNET DE IDENTIDAD 
                        </p>
                       <p>
                            <a :href="'../storage/'+proveedor.file_nit" target="_blank">
                            <button v-if="proveedor.file_nit" type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                        </a>
                            <button v-if="!proveedor.file_nit" type="button" class="btn btn-danger" disabled><i class="fa fa-eye-slash"></i></button>
                            NIT
                       </p>
                   </div>
                   <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Fin de modal de muestra de documentos --}}
    {{-- Modal de eliminación de proveedor --}}
    <div v-for="(proveedor, index) in providers" class="modal fade" :id="'del'+proveedor.id" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content bg-warning">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Eliminar Registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-danger">
                        <i class="fa fa-times"></i>Borrar registro
                   </p>
                   <p>
                       ¿Esta seguro que desea eliminar el registro?
                       <ul class="list-group">
                           <li class="list-group-item">- Se eliminaran sus archivos</li>
                           <li class="list-group-item">- Esta acción es irreversible</li>
                       </ul>
                   </p>
               </div>
               <div class="modal-footer text-center col-md-12">
                <button type="button" class="btn btn-danger col-md-6" @click.prevent="deleteProvider(proveedor, index)" data-dismiss="modal">Si</button>
                <button type="button" class="btn btn-success col-md-6" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
{{-- Fin de modal de eliminación --}}
{{-- Modal de edición --}}
<div v-for="(proveedor, index) in providers" class="modal fade" :id="'edit'+proveedor.id" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal" @submit.prevent="updateProvider(proveedor, index)">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Editar datos del proveedor: @{{ proveedor.id }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class="form-control-label">Código</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="code" class="form-control" :class="errors.code ? 'is-invalid' : ''" v-model="proveedor.code" disabled>
                                    <small v-if="errors.code" class="form-text text-danger">@{{ errors.code }}</small>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Apellidos</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="proveedor.last_name" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nombres</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="first_name" class="form-control" v-model="proveedor.first_name" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="email-input" class=" form-control-label">Carnet de identidad</label></div>
                                <div class="col-12 col-md-5"><input type="text" name="identity_card" class="form-control" v-model="proveedor.identity_card" required></div>
                                <div class="col col-md-1"><label for="email-input" class=" form-control-label">Exp.</label></div>
                                <div class="col-12 col-md-3">
                                    <select name="city_id" class="form-control" v-model="proveedor.city_id">
                                        <option :value="getCityId(proveedor)">@{{ getCity(proveedor) }}</option>
                                        <option v-for="(city, index) in cities" :value="city.id">@{{ city.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">NIT</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="nit" class="form-control" v-model="proveedor.nit" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nacionalidad</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="nationality" class="form-control" v-model="proveedor.nationality" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Actividad economica</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="economic_activity" class="form-control" v-model="proveedor.economic_activity" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Ciudad de residencia</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="residence_city" class="form-control" v-model="proveedor.residence_city" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Teléfonos</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="phone" class="form-control" v-model="proveedor.phone" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dirección</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="address" class="form-control" v-model="proveedor.address"required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Corréo Electrónico</label></div>
                                <div class="col-12 col-md-9"><input type="email" id="text-input" name="email" class="form-control" v-model="proveedor.email" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nro Cuenta</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="nro_acount" class="form-control" v-model="proveedor.nro_acount" required></div>
                            </div>
                            <div class="alert alert-warning text-center" role="alert">
                                <i class="fa fa-warning"></i><b> Advertencia: </b>Sí sube un nuevo archivo, se sobrescribirán los anteriores
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">Carnet de identidad</label></div>
                                <div class="col-12 col-md-7"><input type="file" :id="'file_identity_card_update'+proveedor.id" ref="file_identity_card" name="file_identity_card_update" class="form-control-file">
                                </div>
                                <div class="col-12 col-md-2">
                                    <a :href="'../storage/'+proveedor.file_identity_card" target="_blank">
                                        <button v-if="proveedor.file_identity_card" type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                    </a>
                                        <button v-if="!proveedor.file_identity_card" type="button" class="btn btn-danger" disabled><i class="fa fa-eye-slash"></i></button>
                                </div>
                            </div>
                            
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">NIT</label></div>
                                <div class="col-12 col-md-7"><input type="file" :id="'file_nit_update'+proveedor.id" ref="file_nit" name="file_nit_update" class="form-control-file"></div>
                                <div class="col-12 col-md-2">
                                    <a :href="'../storage/'+proveedor.file_nit" target="_blank">
                                        <button v-if="proveedor.file_nit" type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                    </a>
                                        <button v-if="!proveedor.file_nit" type="button" class="btn btn-danger" disabled><i class="fa fa-eye-slash"></i></button>
                                </div>
                            </div>
                            
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Fin de Modal de edición --}}
    {{-- Modal de impresión --}}
    <div class="modal fade" id="print" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Imprimir Proveedor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class="form-control-label">Introduzca el código</label></div>
                                <div class="col-12 col-md-8"><input type="text" id="text-input" name="code" class="form-control" v-model="print.code"></div>
                                <div class="col-12 col-md-1">
                                    <button type="button" class="btn btn-primary" :class="print.identity_card ? 'btn-success' : 'btn-danger'" @click.prevent="getProvider()"><i class="fa fa-search"></i></button></div>
                            </div>
                            <div v-if="print.identity_card">
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Apellidos</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.last_name }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nombres</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.first_name }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="email-input" class=" form-control-label">Carnet de identidad</label></div>
                                <div class="col-12 col-md-5"><p class="form-control-static">@{{ print.identity_card }}</p></div>
                                <div class="col col-md-1"><label for="email-input" class=" form-control-label">Exp.</label></div>
                                <div class="col-12 col-md-3"><p v-if="print.city_id" class="form-control-static">@{{ getCity(print) }}</p>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">NIT</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.nit }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nacionalidad</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.nationality }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Actividad economica</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.economic_activity }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Ciudad de residencia</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.residence_city }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Teléfonos</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.phone }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dirección</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.address }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Corréo Electrónico</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.email }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nro Cuenta</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.nro_acount }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Monto Adjudicado</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="mount_awarded" class="form-control" v-model="print.mount_awarded" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Detalle de monto Adjudicado</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="detail_mount_awarded" class="form-control" v-model="print.detail_mount_awarded" required></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button v-if="print.identity_card" type="button" class="btn btn-danger" @click.prevent="formPdf()" id="formpdf">PDF</button>
                        <button v-if="print.identity_card" type="submit" class="btn btn-info" @click.prevent="formPrint">Imprimir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Fin de Modal de impresión --}}

@endsection

@section('scripts')
<script src="{{ asset('js/lib/data-table/datatables.min.js') }}"></script>
<script src="{{ asset('js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/lib/data-table/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/lib/data-table/jszip.min.js') }}"></script>
<script src="{{ asset('js/lib/data-table/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/lib/data-table/buttons.html5.min.js') }}"></script>
<script src="{{ asset('js/lib/data-table/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/lib/data-table/buttons.colVis.min.js') }}"></script>
<script>
    const app = new Vue({
        el: '#app',
        data(){
            return{
                cities: {},
                providers:[],
                provider:{
                    code:''
                },
                errors:[],
                print:{},
                action: ''
            }
        },
        mounted() {
            axios.get('/provider_personals').then(response => {
                this.cities = response.data[0];
                this.providers = response.data[1];
                setTimeout(function(){$('#bootstrap-data-table-export').DataTable(
                    {
                        "dom": '<"text-left"<f>>rtip',
                    //searching: false,
                    //paging: false,
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay información",
                        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                        "infoPostFix": "",
                        "thousands": ",",
                        "lengthMenu": "Mostrar _MENU_ Entradas",
                        "loadingRecords": "Cargando...",
                        "processing": "Procesando...",
                        "search": "Buscar:",
                        "zeroRecords": "Sin resultados encontrados",
                        "paginate": {
                            "first": "Primero",
                            "last": "Ultimo",
                            "next": "Siguiente",
                            "previous": "Anterior"
                        }
                    },
                }
                );}, 1000);
            });
        },
        methods:{
            getCity(provider){
                const city = this.cities.find(city => city.id === provider.city_id);
                const data  = city['name'];
                return data;
            },
            getCityId(provider){
                const city = this.cities.find(city => city.id === provider.city_id);
                const data  = city['id'];
                return data;
            },
            addProvider(){
                let data = new FormData();
                data.append('code', this.provider.code);
                data.append('last_name', this.provider.last_name);
                data.append('first_name', this.provider.first_name);
                data.append('identity_card', this.provider.identity_card);
                data.append('city_id', this.provider.city_id);
                data.append('nit', this.provider.nit);
                data.append('nationality', this.provider.nationality);
                data.append('economic_activity', this.provider.economic_activity);
                data.append('residence_city', this.provider.residence_city);
                data.append('phone', this.provider.phone);
                data.append('address', this.provider.address);
                data.append('email', this.provider.email);
                data.append('nro_acount', this.provider.nro_acount);
                data.append('file_identity_card', document.getElementById('file_identity_card').files[0]);
                data.append('file_nit', document.getElementById('file_nit').files[0]);
                axios.post('/provider_personals', data).then(response => {
                    const providers = response.data;
                    this.providers = providers;
                    document.getElementById('file_identity_card').value = null;
                    document.getElementById('file_nit').value = null;
                    toastr.success('Operacion exitosa', 'Proveedor Registrado');
                    this.provider = {};
                    this.errors = [];
                }).catch(error => {
                    this.errors = error.response.data.errors;
                    toastr.error('¡Error!', 'Verifique los datos por favor')
                });
            },
            deleteProvider(provider, index){
                axios.delete('/provider_personals/'+provider.id).then(() => {
                    this.providers.splice(index, 1);
                    toastr.success('Operacion exitosa', 'Proveedor Eliminado');
                }).catch(error => {
                    toastr.error('¡Error!', 'No se pudo eliminar');
                });
            },
            updateProvider(provider, index){
                const file_identity_card = 'file_identity_card_update'+provider.id;
                const file_nit = 'file_nit_update'+provider.id;
                let data = new FormData();
                data.append('_method', 'PATCH');
                data.append('code', provider.code);
                data.append('last_name', provider.last_name);
                data.append('first_name', provider.first_name);
                data.append('identity_card', provider.identity_card);
                data.append('city_id', provider.city_id);
                data.append('nit', provider.nit);
                data.append('nationality', provider.nationality);
                data.append('economic_activity', provider.economic_activity);
                data.append('residence_city', provider.residence_city);
                data.append('phone', provider.phone);
                data.append('address', provider.address);
                data.append('email', provider.email);
                data.append('nro_acount', provider.nro_acount);
                data.append('file_identity_card_update', document.getElementById(file_identity_card).files[0]);
                data.append('file_nit_update', document.getElementById(file_nit).files[0]);
                axios.post('/provider_personals/'+provider.id, data).then(response => {
                    const providers = response.data;
                    this.providers = providers;
                    document.getElementById(file_identity_card).value = null;
                    document.getElementById(file_nit).value = null;
                    this.errors = [];
                    toastr.success('Operacion exitosa', 'Proveedor Actualizado');
                }).catch(error => {
                    toastr.error('¡Error!', 'No se pudo actualizar');
                });
                
            },
            getProvider(){
                axios.get('/providers_personal/search/'+this.print.code).then(response => {
                    const print = response.data;
                    this.print = print;
                    toastr.success('Proveedor encontrado', '¡Exito!');
                }).catch(error => {
                    const code = this.print.code;
                    this.print = {
                        code: code
                    };
                    toastr.error('No se encontro al proveedor', '¡Error!');
                })
            },
            formPdf(){
                const data = new FormData();
                data.append('_method', 'POST');
                data.append('code', this.print.code);
                data.append('mount_awarded', this.print.mount_awarded);
                data.append('detail_mount_awarded', this.print.detail_mount_awarded);
                axios.post('/providers_personal/provider_personals/pdf', data, {
                    responseType: 'blob'
                }).then(response => {
                    var d = new Date();
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    const name =  String(d.getDate()+'/'+eval(d.getMonth()+1)+'/'+d.getFullYear()+' '+d.getHours()+':'+d.getMinutes()+':'+d.getSeconds()+' '+this.print.code+'.pdf');
                    console.log(name);
                    link.setAttribute('download',name);
                    document.body.appendChild(link);
                    link.click();
                });
            },
            formPrint(){
                const data = new FormData();
                data.append('_method', 'POST');
                data.append('code', this.print.code);
                data.append('mount_awarded', this.print.mount_awarded);
                data.append('detail_mount_awarded', this.print.detail_mount_awarded);
                axios.post('/providers_personal/provider_personals/pdf', data, {
                    responseType: 'arraybuffer'
                }).then(response => {
                    var pdfFile = new Blob([response.data], {
                        type: "application/pdf"
                    });
                    var pdfUrl = URL.createObjectURL(pdfFile);
                    printJS(pdfUrl);
                });
            }
        }
        
    });
</script>
@endsection
