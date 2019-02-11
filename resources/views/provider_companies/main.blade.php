@extends('layouts.app')

@section('title-content')
Proveedores: Persona Juridica
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
                    <strong class="card-title">Lista de Proveedores: Persona Juridica</strong>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_provider_company" title="Añadir Proveedor"><i class="fa fa-plus"></i></button>
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#print" title="Imprimir"><i class="fa fa-print"></i></button>
                </div>
                
                <div class="card-body text-left">
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Código</th>
                                <th class="text-white bg-dark">Nombre(Empresa)</th>
                                <th class="text-white bg-dark">NIT</th>
                                <th class="text-white bg-dark">Fundaempresa</th>
                                <th class="text-white bg-dark">Actividad Economica</th>
                                <th class="text-white bg-dark">Ciudad de residencia(Empresa)</th>
                                <th class="text-white bg-dark">Teléfono(Empresa)</th>
                                <th class="text-white bg-dark">Dirección(Empresa)</th>
                                <th class="text-white bg-danger">Apellidos</th>
                                <th class="text-white bg-danger">Nombres</th>
                                <th class="text-white bg-danger">Carnet de identidad</th>
                                <th class="text-white bg-danger">Exp.</th>
                                <th class="text-white bg-danger">Nacionalidad</th>
                                <th class="text-white bg-danger">Ciudad de residencia</th>
                                <th class="text-white bg-danger">Teléfono</th>
                                <th class="text-white bg-danger">Dirección</th>
                                <th class="text-white bg-danger">Corréo Electrónico</th>
                                <th class="text-white bg-danger">NRO de cuenta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(proveedor, index) in providers">
                                <td>
                                    <button type="button" class="btn btn-info" title="Documentos guardados" data-toggle="modal" :data-target="'#doc'+proveedor.id"><i class="fa fa-file-text"></i></button>
                                    <button type="button" class="btn btn-info" title="Editar Proveedor" data-toggle="modal" :data-target="'#edit'+proveedor.id"><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-info" title="Socios del proveedor" data-toggle="modal" :data-target="'#part'+proveedor.id"><i class="fa fa-users"></i></button>
                                    <button type="button" class="btn btn-danger" title="Eliminar Proveedor" data-toggle="modal" :data-target="'#del'+proveedor.id"><i class="fa fa-trash-o"></i></button>
                                </td>
                                <td>@{{ proveedor.code }}</td>
                                <td>@{{ proveedor.name }}</td>
                                <td>@{{ proveedor.nit }}</td>
                                <td>@{{ proveedor.fundaempresa }}</td>
                                <td>@{{ proveedor.economic_activity }}</td>
                                <td>@{{ proveedor.residence_city }}</td>
                                <td>@{{ proveedor.phone }}</td>
                                <td>@{{ proveedor.address }}</td>
                                <td>@{{ proveedor.last_name }}</td>
                                <td>@{{ proveedor.first_name }}</td>
                                <td>@{{ proveedor.identity_card }}</td>
                                <td>@{{ getCity(proveedor) }}</td>
                                <td>@{{ proveedor.nationality }}</td>
                                <td>@{{ proveedor.personal_residence_city }}</td>
                                <td>@{{ proveedor.personal_phone }}</td>
                                <td>@{{ proveedor.personal_address }}</td>
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
<div class="modal fade" id="add_provider_company" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
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
                            @{{ $data.provider }}
                            <div class="text-center">
                                <h5><b>Empresa</b></h5><br>
                            </div>
                            <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class="form-control-label">Código</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="code" class="form-control" :class="errors.code ? 'is-invalid' : ''" v-model="provider.code">
                                    <small v-if="errors.code" class="form-text text-danger">@{{ errors.code }}</small>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nombre</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="provider.name" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">NIT</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="provider.nit" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Fundaempresa</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="provider.fundaempresa" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Actividad Economica</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="provider.economic_activity" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Ciudad de residencia</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="provider.residence_city" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Telefono</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="provider.phone" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dirección</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="provider.address" required></div>
                            </div>
                            <div class="text-center">
                                <h5><b>Representante Legal</b></h5><br>
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
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nacionalidad</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="nationality" class="form-control" v-model="provider.nationality" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Ciudad de residencia</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="residence_city" class="form-control" v-model="provider.personal_residence_city" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Teléfonos</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="phone" class="form-control" v-model="provider.personal_phone" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dirección</label></div>
                                <div class="col-12 col-md-9"><input type="text" id="text-input" name="address" class="form-control" v-model="provider.personal_address"required></div>
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
                                <div class="col-12 col-md-9"><input type="file" id="file_identity_card" name="file_identity_card" class="form-control-file"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">NIT</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="file_nit" name="file_nit" class="form-control-file"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">Fundaempresa</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="file_fundaempresa" name="file_identity_card" class="form-control-file"></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="file-input" class=" form-control-label">Otros...</label></div>
                                <div class="col-12 col-md-9"><input type="file" id="file_other" name="file_nit" class="form-control-file"></div>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-2"></div>
                                <div class="col-md-8"><button type="button" class="btn btn-success btn-block" @click.prevent="addPartner()"><i class="fa fa-plus"></i>Añadir Socio</button></div>
                                <div class="col-md-2"></div>
                            </div><br>
                            <div v-for="(partner, index) in provider.partners" class="row form-group" :key="index">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" placeholder="Nombre Completo" v-model="partner.full_name" required>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" placeholder="Carnet de identidad" v-model="partner.identity_card" required>
                                </div>
                                <div class="col-md-2">
                                    <select name="city_id" class="form-control" v-model="partner.city_id" required>
                                        <option v-for="(city, index) in cities" :value="city.id">@{{ city.name }}</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" placeholder="% Part." v-model="partner.participation" required>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger" @click.prevent="deletePartner(index)" title="Quitar Socio"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
                            @{{ proveedor.name }}
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
                       <p>
                        <a :href="'../storage/'+proveedor.file_fundaempresa" target="_blank">
                         <button v-if="proveedor.file_fundaempresa" type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                         </a>
                         <button v-if="!proveedor.file_fundaempresa" type="button" class="btn btn-danger"  disabled><i class="fa fa-eye-slash"></i></button>
                         Fundaempresa
                     </p>
                    <p>
                         <a :href="'../storage/'+proveedor.file_others" target="_blank">
                         <button v-if="proveedor.file_others" type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                     </a>
                         <button v-if="!proveedor.file_others" type="button" class="btn btn-danger" disabled><i class="fa fa-eye-slash"></i></button>
                         Otros...
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
                           <li class="list-group-item">- Se eliminaran a los socios relacionados</li>
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
{{-- Modal de socios --}}
<div v-for="(proveedor, index) in providers" class="modal fade" :id="'part'+proveedor.id" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form-horizontal">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Socios del proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Socios de @{{ proveedor.name }}</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre Completo</th>
                                            <th scope="col">Carnet de identidad</th>
                                            <th scope="col">Exp.</th>
                                            <th scope="col">% de participación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(partner, index) in proveedor.partners">
                                            <td>@{{ partner.full_name }}</td>
                                            <td>@{{ partner.identity_card }}</td>
                                            <td>@{{ getCity(partner) }}</td>
                                            <td>@{{ partner.participation }} %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Fin de Modal de socios --}}
{{-- Modal de edición --}}
<div v-for="(proveedor, index) in providers" class="modal fade" :id="'edit'+proveedor.id" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form class="form-horizontal" @submit.prevent="updateProvider(proveedor, index)">
                <div class="modal-header">
                    <h5 class="modal-title" id="mediumModalLabel">Editar datos del proveedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        @{{ proveedor }}
                        <div class="text-center">
                            <h5><b>Empresa</b></h5><br>
                        </div>
                        <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class="form-control-label">Código</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="code" class="form-control" :class="errors.code ? 'is-invalid' : ''" v-model="proveedor.code" disabled>
                                <small v-if="errors.code" class="form-text text-danger">@{{ errors.code }}</small>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nombre</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="proveedor.name" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">NIT</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="proveedor.nit" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Fundaempresa</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="proveedor.fundaempresa" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Actividad Economica</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="proveedor.economic_activity" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Ciudad de residencia</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="proveedor.residence_city" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Telefono</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="proveedor.phone" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dirección</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="last_name" class="form-control" v-model="proveedor.address" required></div>
                        </div>
                        <div class="text-center">
                            <h5><b>Representante Legal</b></h5><br>
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
                                    <option v-for="(city, index) in cities" :value="city.id">@{{ city.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nacionalidad</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="nationality" class="form-control" v-model="proveedor.nationality" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Ciudad de residencia</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="residence_city" class="form-control" v-model="proveedor.personal_residence_city" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Teléfonos</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="phone" class="form-control" v-model="proveedor.personal_phone" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dirección</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="address" class="form-control" v-model="proveedor.personal_address"required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Corréo Electrónico</label></div>
                            <div class="col-12 col-md-9"><input type="email" id="text-input" name="email" class="form-control" v-model="proveedor.email" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nro Cuenta</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="text-input" name="nro_acount" class="form-control" v-model="proveedor.nro_acount" required></div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Carnet de identidad</label></div>
                            <div class="col-12 col-md-7"><input type="file" :id="'file_identity_card_update'+proveedor.id" name="file_identity_card" class="form-control-file"></div>
                            <div class="col-12 col-md-2">
                                <a :href="'../storage/'+proveedor.file_identity_card" target="_blank">
                                    <button v-if="proveedor.file_identity_card" type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                </a>
                                    <button v-if="!proveedor.file_identity_card" type="button" class="btn btn-danger" disabled><i class="fa fa-eye-slash"></i></button>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">NIT</label></div>
                            <div class="col-12 col-md-7"><input type="file" :id="'file_nit_update'+proveedor.id" name="file_nit" class="form-control-file"></div>
                            <div class="col-12 col-md-2">
                                <a :href="'../storage/'+proveedor.file_nit" target="_blank">
                                    <button v-if="proveedor.file_nit" type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                </a>
                                    <button v-if="!proveedor.file_nit" type="button" class="btn btn-danger" disabled><i class="fa fa-eye-slash"></i></button>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Fundaempresa</label></div>
                            <div class="col-12 col-md-7"><input type="file" :id="'file_fundaempresa_update'+proveedor.id" name="file_identity_card" class="form-control-file"></div>
                            <div class="col-12 col-md-2">
                                <a :href="'../storage/'+proveedor.file_fundaempresa" target="_blank">
                                    <button v-if="proveedor.file_fundaempresa" type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                </a>
                                    <button v-if="!proveedor.file_fundaempresa" type="button" class="btn btn-danger" disabled><i class="fa fa-eye-slash"></i></button>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Otros...</label></div>
                            <div class="col-12 col-md-7"><input type="file" :id="'file_others_update'+proveedor.id" name="file_nit" class="form-control-file"></div>
                            <div class="col-12 col-md-2">
                                <a :href="'../storage/'+proveedor.file_others" target="_blank">
                                    <button v-if="proveedor.file_others" type="button" class="btn btn-success"><i class="fa fa-eye"></i></button>
                                </a>
                                    <button v-if="!proveedor.file_others" type="button" class="btn btn-danger" disabled><i class="fa fa-eye-slash"></i></button>
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
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nombre de la Empresa</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.name }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">NIT</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.nit }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Fundaempresa</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.fundaempresa }}</p></div>
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
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Telefono</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.phone }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Direccion de la empresa</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.address }}</p></div>
                            </div>
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
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nacionalidad</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.nationality }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Ciudad de residencia</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.personal_residence_city }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Teléfonos</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.personal_phone }}</p></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Dirección</label></div>
                                <div class="col-12 col-md-9"><p class="form-control-static">@{{ print.personal_address }}</p></div>
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
                    code:'',
                    partners: []
                },
                errors:[],
                print:{},
                partners:[]
            }
        },
        mounted() {
            axios.get('/provider_company').then(response => {
                this.cities = response.data[0];
                this.providers = response.data[1];
                this.partners = response.data[2];
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
            getPartners(provider){
                axios.get('/provider_company/getpartners/'+provider.id).then(response => {
                    this.provider.partners = response.data;
                }).catch(error => {
                    console.log('vacio');
                });
            },
            addProvider(){
                let data = new FormData();
                data.append('code', this.provider.code);
                data.append('name', this.provider.name);
                data.append('nit', this.provider.nit);
                data.append('fundaempresa', this.provider.fundaempresa);
                data.append('economic_activity', this.provider.economic_activity);
                data.append('residence_city', this.provider.residence_city);
                data.append('phone', this.provider.phone);
                data.append('address', this.provider.address);
                data.append('last_name', this.provider.last_name);
                data.append('first_name', this.provider.first_name);
                data.append('identity_card', this.provider.identity_card);
                data.append('city_id', this.provider.city_id);
                data.append('nationality', this.provider.nationality);
                data.append('personal_residence_city', this.provider.personal_residence_city);
                data.append('personal_phone', this.provider.personal_phone);
                data.append('personal_address', this.provider.personal_address);
                data.append('email', this.provider.email);
                data.append('nro_acount', this.provider.nro_acount);
                data.append('file_identity_card', document.getElementById('file_identity_card').files[0]);
                data.append('file_nit', document.getElementById('file_nit').files[0]);
                data.append('file_fundaempresa', document.getElementById('file_fundaempresa').files[0]);
                data.append('file_other', document.getElementById('file_other').files[0]);
                const partners = JSON.stringify(this.provider.partners);
                data.append('partners',  partners);
                axios.post('/provider_company', data).then(response => {
                    console.log(response.data);
                    this.provider = {
                        partners: []
                    };
                    this.errors = [];
                    const providers = response.data[0];
                    this.providers = providers;
                    const partners = response.data[1];
                    this.partners = partners;
                    console.log(this.providers);
                    console.log(this.partners);
                    document.getElementById('file_identity_card').value = null;
                    document.getElementById('file_nit').value = null;
                    document.getElementById('file_fundaempresa').value = null;
                    document.getElementById('file_other').value = null;
                    toastr.success('Operacion exitosa', 'Proveedor Registrado');
                    
                }).catch(error => {
                    console.log(error.response.data);
                    this.errors = error.response.data.errors;
                    toastr.error('¡Error!', 'Verifique los datos por favor')
                });
            },
            deleteProvider(provider, index){
                axios.delete('/provider_company/'+provider.id).then(response => {
                    this.providers.splice(index, 1);
                    const providers = response.data;
                    this.providers = providers;
                    toastr.success('Operacion exitosa', 'Proveedor Eliminado');
                }).catch(error => {
                    toastr.error('¡Error!', 'No se pudo eliminar');
                });
            },
            updateProvider(provider, index){
                const file_identity_card = 'file_identity_card_update'+provider.id;
                const file_nit = 'file_nit_update'+provider.id;
                const file_fundaempresa = 'file_fundaempresa_update'+provider.id;
                const file_others = 'file_others_update'+provider.id;
                let data = new FormData();
                data.append('_method', 'PATCH');
                data.append('code', provider.code);
                data.append('name', provider.name);
                data.append('nit', provider.nit);
                data.append('fundaempresa', provider.fundaempresa);
                data.append('economic_activity', provider.economic_activity);
                data.append('residence_city', provider.residence_city);
                data.append('phone', provider.phone);
                data.append('address', provider.address);
                data.append('last_name', provider.last_name);
                data.append('first_name', provider.first_name);
                data.append('identity_card', provider.identity_card);
                data.append('city_id', provider.city_id);
                data.append('nationality', provider.nationality);
                data.append('personal_residence_city', provider.personal_residence_city);
                data.append('personal_phone', provider.personal_phone);
                data.append('personal_address', provider.personal_address);
                data.append('email', provider.email);
                data.append('nro_acount', provider.nro_acount);
                data.append('file_identity_card_update', document.getElementById(file_identity_card).files[0]);
                data.append('file_nit_update', document.getElementById(file_nit).files[0]);
                data.append('file_fundaempresa_update', document.getElementById(file_fundaempresa).files[0]);
                data.append('file_others_update', document.getElementById(file_others).files[0]);
                axios.post('/provider_company/'+provider.id, data).then(response => {
                    const providers = response.data;
                    this.providers = providers;
                    document.getElementById(file_identity_card).value = null;
                    document.getElementById(file_nit).value = null;
                    document.getElementById(file_fundaempresa).value = null;
                    document.getElementById(file_others).value = null;
                    this.errors = [];
                    toastr.success('Operacion exitosa', 'Proveedor Actualizado');
                }).catch(error => {
                    toastr.error('¡Error!', 'No se pudo actualizar');
                });
                
            },
            getProvider(){
                axios.get('/provider_company/search/'+this.print.code).then(response => {
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
                axios.post('/provider_company/pdf', data, {
                    responseType: 'blob'
                }).then(response => {
                    toastr.warning('Generando archivo', 'Pdf Guardado con exito');
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
                axios.post('/provider_company/pdf', data, {
                    responseType: 'arraybuffer'
                }).then(response => {
                    var pdfFile = new Blob([response.data], {
                        type: "application/pdf"
                    });
                    var pdfUrl = URL.createObjectURL(pdfFile);
                    printJS(pdfUrl);
                });
            },
            addPartner(){
                const partner = {};
                this.provider.partners.push(partner);
            },
            deletePartner(index){
                this.provider.partners.splice(index, 1);
            },
            delPartner(partner, index){
                axios.delete('/partner/'+partner.id).then(response => {
                    const providers = response.data;
                    this.providers = providers;
                });
            },
        }
        
    });
</script>
@endsection
