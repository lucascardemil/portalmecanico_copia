<template>

    <div>

        <div class="col-lg-12">
            <h5 class="text-white">
                Administración de Clientes (Mecánico)
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
                            <form action="POST" v-on:submit.prevent="createMechanicClient2">
                                <div class="row">

                                    <div class="form-group col-lg-3">
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

                                    <div class="form-group col-lg-3">
                                        <label for="password">Contraseña</label>
                                        <input required
                                                type="password"
                                                name="password"
                                                class="form-control" v-model="newUser.password">
                                    </div>

                                    <!-- <div class="form-group col-lg-1">
                                        <label for="cant_vehicle">Vehiculos</label>
                                        <input required
                                                type="number"
                                                name="cant_vehicle"
                                                class="form-control" v-model="newUser.cant_vehicle">
                                    </div> -->

                                    <!-- <div class="form-group col-lg-2">
                                        <label for="cant_vehicle">Vehiculos</label>
                                        <select class="form-control" name="cant_vehicle" v-model="newUser.cant_vehicle">
                                            <option disabled value="0">Seleccione Cantidad</option>
                                            <option value="10">10</option>
                                            <option value="30">30</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div> -->

                                    <div class="col-lg-3 mt-2">
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

            <!-- <div class="row">
                <div class="col-6">
                    <div class="card text-white bg-success mt-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12" v-for="totalcliLocal in totalcli" :key="totalcliLocal.id">
                                    <h5 class="card-title mb-0">Total de clientes disponibles: {{ totalcliLocal }}</h5>
                                </div>
                                <div class="col-12" v-for="totalvehiLocal in totalvehi" :key="totalvehiLocal.id">
                                    <h5 class="card-title mb-0">Total de vehiculos disponibles: {{ totalvehiLocal }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="table-responsive">
                <table class="table table-striped table-sm text-white bg-dark mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Cantidad de vehiculos</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="userLocal in users" :key="userLocal.id">
                            <td width="10px">{{ userLocal.id }}</td>
                            <td>{{ userLocal.name }}</td>
                            <td>{{ userLocal.email }}</td>
                            <td>{{ userLocal.cant_vehicle }}</td>
                            <td class="text-right">

                                <!-- <button class="btn btn-secondary"
                                    @click.prevent="editCantVehicle({ userLocal })"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Cantidad de vehiculos">
                                    <i class="fas fa-car"></i>
                                </button> -->

                                <a href="#" class="btn btn-warning"
                                    @click.prevent="editUser({ userLocal } )"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Editar">
                                    <i class="far fa-edit"></i>
                                </a>

                            </td>
                        </tr>
                        <!-- <tr>
                            <td></td>
                            <td></td>
                            <th class="text-right">Total:</th>
                            <td>{{ sumavehi }}</td>
                            <td></td>
                        </tr> -->
                    </tbody>
                </table>

                <nav>
                    <ul class="pagination">
                        <li class="page-item" v-if="pagination.current_page > 1">
                            <a class="page-link" href="#" @click.prevent="changePageUser({page: 1})">
                                <span>Primera</span>
                            </a>
                        </li>

                        <li class="page-item" v-if="pagination.current_page > 1">
                            <a class="page-link" href="#" @click.prevent="changePageUser({page: pagination.current_page - 1})">
                                <span>Atrás</span>
                            </a>
                        </li>

                        <li class="page-item" v-for="page in pagesNumber"
                            v-bind:class="[ page == isActived ? 'active' : '' ]" :key="page">
                            <a class="page-link" href="#" @click.prevent="changePageUser({page})">
                                {{ page }}
                            </a>
                        </li>

                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link" href="#" @click.prevent="changePageUser({page: pagination.current_page + 1})">
                                <span>Siguiente</span>
                            </a>
                        </li>

                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link" href="#"  @click.prevent="changePageUser({page:pagination.last_page})">
                                <span>Última</span>
                            </a>
                        </li>
                    </ul>
                </nav>

            </div>
            <EditCantVehicle></EditCantVehicle>
            <EditUser></EditUser>
        </div>
    </div>

</template>


<script>

import { loadProgressBar } from 'axios-progress-bar'
import { mapState, mapActions, mapGetters } from 'vuex'
import EditUser from './EditUser'
import EditCantVehicle from './EditCantVehicle'

export default {
    components: { EditUser, EditCantVehicle },
    computed:{
        ...mapState(['totalvehi', 'sumavehi', 'users', 'newUser', 'pagination', 'offset', 'errorsLaravel']),
        //...mapState(['totalvehi', 'totalcli', 'users', 'newUser', 'pagination', 'offset', 'errorsLaravel']),
        ...mapGetters(['isActived', 'pagesNumber'])
    },
    methods:{
        ...mapActions(['getTotalVehi', 'getSumaVehi', 'getMechanicClients', 'createMechanicClient2', 'editUser', 'changePageUser','editCantVehicle'])
        //...mapActions(['getTotalVehi', 'getTotalCli', 'getMechanicClients', 'createMechanicClient2', 'editUser', 'changePageUser','editCantVehicle'])
    },
    created(){
        loadProgressBar()
        this.$store.dispatch('getMechanicClients', { page: 1 })
        this.$store.dispatch('getSumaVehi')
        this.$store.dispatch('getTotalVehi')
    }
}

</script>

<style>

</style>
