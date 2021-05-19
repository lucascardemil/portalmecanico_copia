<template>

    <div>

        <div class="col-lg-12">
            <h5 class="text-white">
                Administración de Usuarios
				
            </h5>
        
            <div id="accordion">
                <div class="card">
                    <div class="card-header p-0" id="headingOne">
                    <h5 class="mb-0">
                        <button id="btn-user-card" class="btn btn-block text-left p-3" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                        Nuevo Usuario
                        <span class="text-right"><i class="fas fa-arrows-alt-v"></i></span>
                        </button>
                    </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form action="POST" v-on:submit.prevent="createUser">
                                <div class="row">

                                    <div class="form-group col-12">
                                        <input 
                                                type="checkbox" 
                                                name="mecanico"
                                                v-model="newUser.mecanico">
                                        <label for="mecanico">Mecanico</label>
                                        
                                    </div>

                                    <div class="form-group col-lg-2">
                                        <label for="nombre">Nombre</label>
                                        <input required
                                          
                                                type="text"
                                                name="nombre"
                                                class="form-control" v-model="newUser.name">
                                       
                                    </div>

                                    <div class="form-group col-lg-3">
                                        <label for="correo">Email</label>
                                        <input required
                                                
                                                type="email"
                                                name="correo"
                                                class="form-control" v-model="newUser.email">
                                       
                                    </div>

                                    <div class="form-group col-lg-2">
                                        <label for="password">Contraseña</label>
                                        <input required
                                                
                                                type="password"
                                                name="password"
                                                class="form-control" v-model="newUser.password">
                                        
                                    </div>


                                    <div class="form-group col-lg-1" v-bind:hidden="newUser.mecanico === true ? false : true">
                                        <label for="cant_client">Clientes</label>
                                        <input required
                                                type="number"
                                                name="cant_client"
                                                class="form-control" v-model="newUser.cant_client">
                                    </div>
                                    <div class="form-group col-lg-1" v-bind:hidden="newUser.mecanico === true ? false : true">
                                        <label for="cant_vehicle">Vehiculos</label>
                                        <input required
                                                type="number"
                                                name="cant_vehicle"
                                                class="form-control" v-model="newUser.cant_vehicle">
                                    </div>

                                    <div class="col-lg-3 mt-2" v-bind:hidden="newUser.mecanico === true ? true : false">
                                        <label></label>
                                        <button type="submit" class="btn btn-block btn-success form-control">
                                            <i class="fas fa-plus-square"></i> Guardar
                                        </button>
                                    </div>

                                    <div class="col-lg-3 mt-2" v-bind:hidden="newUser.mecanico === true ? false : true">
                                        <label></label>
                                        <button type="submit" class="btn btn-success form-control">
                                            <i class="fas fa-plus-square"></i> Guardar
                                        </button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        

            <div class="table-responsive">
                <table class="table table-sm text-white bg-dark mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="userLocal in users" :key="userLocal.id">
                            <td>{{ userLocal.id }}</td>
                            <td>{{ userLocal.name }}</td>
                            <td>{{ userLocal.email }}</td>
                            <td class="text-right">

                                <button class="btn btn-success"
                                        @click.prevent="editUserRoles({userLocal})"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Asignar Rol">
                                        <i class="fas fa-user-cog"></i>
                                </button>



                                
                                
                                <button class="btn btn-secondary" v-if="!userLocal.roles.length == 0 && userLocal.roles[0].name == 'mechanic'"
                                        @click.prevent="editCantCliVehi({userLocal})"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Cantidad de clientes y vehiculos">
                                        <i class="fas fa-cogs"></i>
                                </button>
                                   

                                

                                <!-- <button class="btn btn-secondary"
                                        @click.prevent="getUserRoles({id: userLocal.id})"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Ver Roles del Usuario">
                                        <i class="fas fa-eye"></i>
                                </button> -->

                                <a href="#" class="btn btn-warning"
                                    @click.prevent="editUser({ userLocal } )"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Editar">
                                    <i class="far fa-edit"></i>
                                </a>

                                <a href="#" class="btn btn-danger"
                                    @click.prevent="modalDeleteUser( { id: userLocal.id } )"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Eliminar">
                                    <i class="fas fa-ban"></i>
                                </a>

                            </td>
                        </tr>
                    </tbody>
                </table>

                <nav>
                    <ul class="pagination">
                        <li class="page-item" v-if="pagination.current_page > 1">
                            <a class="page-link border-light bg-dark" href="#" @click.prevent="changePageUser({page: 1})">
                                <span>Primera</span>
                            </a>
                        </li>

                        <li class="page-item" v-if="pagination.current_page > 1">
                            <a class="page-link border-light bg-dark" href="#" @click.prevent="changePageUser({page: pagination.current_page - 1})">
                                <span>Atrás</span>
                            </a>
                        </li>

                        <li class="page-item" v-for="page in pagesNumber"
                            v-bind:class="[ page == isActived ? 'active' : '' ]" :key="page">
                            <a class="page-link border-light bg-dark" href="#" @click.prevent="changePageUser({page})">
                                {{ page }}
                            </a>
                        </li>

                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link border-light bg-dark" href="#" @click.prevent="changePageUser({page: pagination.current_page + 1})">
                                <span>Siguiente</span>
                            </a>
                        </li>

                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link border-light bg-dark" href="#"  @click.prevent="changePageUser({page:pagination.last_page})">
                                <span>Última</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
        </div>

        <EditUser></EditUser>
        <DeleteUser></DeleteUser>

        <!-- <ShowUserRoles></ShowUserRoles> -->
        <EditCantClientVehicle></EditCantClientVehicle>
        <UpdateUserRoles></UpdateUserRoles>

    </div>

</template>


<script>

import { loadProgressBar } from 'axios-progress-bar'
import { mapState, mapActions, mapGetters } from 'vuex'
import EditUser from './Edit'
import DeleteUser from './Delete'

import UpdateUserRoles from '../Roles/UpdateUserRoles'
// import ShowUserRoles from '../Roles/ShowUserRoles'
import EditCantClientVehicle from './EditCantClientVehicle'

export default {
    components: { EditUser, DeleteUser, UpdateUserRoles, EditCantClientVehicle },
    computed:{
        ...mapState(['users', 'newUser', 'pagination', 'offset', 'errorsLaravel']),
        ...mapGetters(['isActived', 'pagesNumber'])
    },
    methods:{
        ...mapActions(['getUsers', 'createUser',
        'editUser', 'modalDeleteUser', 'deleteUser', 'changePageUser', 'editCantCliVehi', 'editUserRoles', 'changePageUser'])
    },
    created(){
        loadProgressBar()
        this.$store.dispatch('getUsers', { page: 1 })
    }
}

</script>

<style>

</style>
