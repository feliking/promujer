@extends('layouts.app')

@section('title-content')
Administrador: Usuarios
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
                    <strong class="card-title">Lista de Usuarios</strong>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_user" title="Añadir Usuario"><i class="fa fa-plus"></i></button>
                </div>
                <div class="card-body text-left">
                    
                    <table id="bootstrap-data-table-export" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Opciones</th>
                                <th>Estado</th>
                                <th>Apellidos</th>
                                <th>Nombres</th>
                                <th>Género</th>
                                <th>Ciudad de residencia</th>
                                <th>Teléfono/Celular</th>
                                <th>Nombre de usuario</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user, index) in users">
                                <td>
                                    <button type="button" class="btn btn-info" title="Cambiar Contraseña" data-toggle="modal" :data-target="'#lock'+user.id"><i class="fa fa-lock"></i></button>
                                    <button type="button" class="btn btn-info" title="Permisos" data-toggle="modal" :data-target="'#permi'+user.id"><i class="fa fa-gear"></i></button>
                                    <button type="button" class="btn btn-info" title="Editar Usuario" data-toggle="modal" :data-target="'#edit'+user.id"><i class="fa fa-pencil"></i></button>
                                    <button type="button" class="btn btn-danger" title="Eliminar Usuario" data-toggle="modal" :data-target="'#del'+user.id"><i class="fa fa-trash-o"></i></button>
                                </td>
                                <td class="text-center">
                                    <button v-if="user.status" type="button" class="btn btn-success" @click.prevent="changeStatus(user)" title="Desactivar usuario"><i class="fa fa-check"></i></button>
                                    <button v-else type="button" class="btn btn-danger" @click.prevent="changeStatus(user)" title="Activar Usuario"><i class="fa fa-times"></i></button>
                                </td>
                                <td>@{{ user.last_name }}</td>
                                <td>@{{ user.first_name }}</td>
                                <td>@{{ user.gender == 'M' ? 'Masculino' : 'Femenino' }}</td>
                                <td>@{{ user.city.name }}</td>
                                <td>@{{ user.phone }}</td>
                                <td>@{{ user.username }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal de agregación --}}
    <div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal was-validated" @submit.prevent="addUser()">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Datos del nuevo usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class="form-control-label">Apellidos</label></div>
                                <div class="col-12 col-md-9"><input type="text" name="code" class="form-control" v-model="user.last_name" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nombres</label></div>
                                <div class="col-12 col-md-9"><input type="text" name="last_name" class="form-control" v-model="user.first_name" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Genero</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="city_id" class="form-control" v-model="user.gender" required>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="email-input" class=" form-control-label">Ciudad de residencia</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="city_id" class="form-control" v-model="user.city_id" required>
                                        <option v-for="(city, index) in cities" :value="city.id">@{{ city.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Telefono/Celular</label></div>
                                <div class="col-12 col-md-9"><input type="text" name="nit" class="form-control" v-model="user.phone" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nombre de usuario</label></div>
                                <div class="col-12 col-md-9"><input type="text" name="nationality" class="form-control" v-model="user.username" :class="errors.username ? 'is-invalid' : ''" required>
                                    <small v-if="errors.username" class="form-text text-danger">@{{ errors.username }}</small>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Contraseña</label></div>
                                <div class="col-12 col-md-9"><input type="password" name="economic_activity" class="form-control" v-model="user.password" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Repita la contraseña</label></div>
                                <div class="col-12 col-md-9"><input type="password" name="residence_city" class="form-control" :class="errors.password ? 'is-invalid' : ''" v-model="user.confirm" required>
                                    <small v-if="errors.password" class="form-text text-danger">@{{ errors.password }}</small>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Permisos</label></div>
                                <div class="col-12 col-md-9">
                                    <div v-for="(rol, index) in roles" class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" :id="rol.id" :value="rol.id" v-model="user.roles">
                                        <label class="custom-control-label" :for="rol.id">@{{ rol.module }}</label>
                                        <div class="invalid-feedback">@{{ rol.module }}</div>
                                    </div>
                                </div>  
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success">Registrar y activar usuario</button>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Fin de modal de agregación --}}
    {{-- Modal de eliminación de proveedor --}}
    <div v-for="(user, index) in users" class="modal fade" :id="'del'+user.id" tabindex="-1" role="dialog" aria-labelledby="staticModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content" :class="!auth ? 'bg-warning' : 'bg-success'">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticModalLabel">Eliminar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="authPassword()">
                <div class="modal-body">
                    <p class="text-danger" v-if="!auth">
                        <i class="fa fa-times"></i>Ingrese la contraseña del administrador
                   </p>
                   <div class="row form-group" v-if="!auth">
                        <div class="col col-md-12"><label for="text-input" class=" form-control-label">Contraseña</label></div>
                        <div class="col-12 col-md-12"><input type="password" name="economic_activity" class="form-control" v-model="password" required></div>
                    </div>
                   <p class="text-white" v-if="auth">
                       ¿Esta seguro que desea eliminar el registro?
                       <ul class="list-group" v-if="auth">
                           <li class="list-group-item">- Esta acción es irreversible</li>
                       </ul>
                   </p>
                </div>
                <div class="modal-footer text-center col-md-12 bg-white">
                    <button type="button" v-if="auth" class="btn btn-danger col-md-6" @click.prevent="deleteUser(user, index)" data-dismiss="modal">Si</button>
                    <button type="submit" v-else class="btn btn-success col-md-6">Verificar</button>
                    <button type="button" class="btn btn-warning col-md-6" data-dismiss="modal">Cancelar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
{{-- Fin de modal de eliminación --}}
    {{-- Modal de edición --}}
    <div v-for="(user, index) in users" class="modal fade" :id="'edit'+user.id" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form class="form-horizontal was-validated" @submit.prevent="updateUser(user, index)">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mediumModalLabel">Actualizar usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                            <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class="form-control-label">Apellidos</label></div>
                                <div class="col-12 col-md-9"><input type="text" name="code" class="form-control" v-model="user.last_name" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nombres</label></div>
                                <div class="col-12 col-md-9"><input type="text" name="last_name" class="form-control" v-model="user.first_name" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Genero</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="city_id" class="form-control" v-model="user.gender" required>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="email-input" class=" form-control-label">Ciudad de residencia</label></div>
                                <div class="col-12 col-md-9">
                                    <select name="city_id" class="form-control" v-model="user.city_id" required>
                                        <option v-for="(city, index) in cities" :value="city.id">@{{ city.name }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Telefono/Celular</label></div>
                                <div class="col-12 col-md-9"><input type="text" name="nit" class="form-control" v-model="user.phone" required></div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nombre de usuario</label></div>
                                <div class="col-12 col-md-9"><input type="text" name="nationality" class="form-control" v-model="user.username" :class="errors.username ? 'is-invalid' : ''" required>
                                    <small v-if="errors.username" class="form-text text-danger">@{{ errors.username }}</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-success">Actualizar usuario</button>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Fin de modal de edición --}}
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
                user:{
                    roles:[]
                },
                users: [],
                cities: {},
                errors:[],
                roles: [],
                auth:false,
                password: ''
            }
        },
        mounted() {
            axios.get('/user').then(response => {
                this.cities = response.data[0];
                this.users = response.data[1];
                this.roles = response.data[2];
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
            addUser(){
                if(this.user.password != this.user.confirm){
                    return this.errors = {
                        password: 'Las contraseñas no coinciden'
                    };
                }
                this.errors = [];
                axios.post('/user', this.user).then(response => {
                    const users = response.data;
                    this.users = users;
                    toastr.success('Operacion exitosa', 'Usuario activado');
                    this.user = {
                        roles:[]
                    };
                    this.errors = [];
                }).catch(error => {
                    this.errors = error.response.data.errors;
                    toastr.error('¡Error!', 'Verifique los datos por favor');
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
            changeStatus(user){
                const data = new FormData();
                data.append('id', user.id);
                data.append('status', !user.status);
                axios.post('/user/status', data).then(response => {
                    user.status = !user.status;
                    if(user.status){
                        toastr.success('Usuario activado', 'Operacion exitosa');
                    }
                    else{
                        toastr.warning('Usuario desactivado', 'Operacion exitosa');
                    }
                    
                }).catch(error => {
                    toastr.error('Ocurrio un error', 'Consulte con el administrador');
                });
            },
            authPassword(){
                const data = new FormData();
                data.append('password', this.password);
                axios.post('/user/verifica', data).then(response => {
                    this.auth = true;
                    this.password = '';
                }).catch(error => {
                    toastr.error('¡Error!', 'Contraseña incorrecta');
                });
            },
            deleteUser(user, index){
                axios.delete('/user/'+user.id).then(response => {
                    toastr.success('Operacion exitosa', 'Usuario eliminado');
                    this.users.splice(index, 1);
                    this.auth = false;
                }).catch(error => {
                    toastr.error('Ocurrio un error', 'Consulte con el desarrollador');
                })
            }
        }
        
    });
</script>
@endsection