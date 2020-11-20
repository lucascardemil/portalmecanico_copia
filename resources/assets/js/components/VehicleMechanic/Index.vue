<template>

    <div class="col-lg-12">

        <h5 class="text-white">
            Nuevo Vehículo (Mecánico)
            <a href="#" class="btn btn-success pull-right btn-sm" data-toggle="modal" data-target="#create"
                title="Agregar">
                <i class="fas fa-plus-circle"></i>
            </a>
        </h5>

        <div class="table-responsive">
            <table class="table table-hover table-striped mt-3 table-sm text-white bg-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Patente</th>
                        <th>Chasis</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Motor</th>
                        <th>Color</th>
                        <th>Kilometraje</th>
                        <th>Fecha</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="vehicleLocal in vehicles" :key="vehicleLocal.id">
                        <td width="10px">{{ vehicleLocal.id }}</td>
                        <td>{{ vehicleLocal.user.name }}</td>
                        <td>{{ vehicleLocal.patent }}</td>
                        <td>{{ vehicleLocal.chasis }}</td>
                        <td>{{ vehicleLocal.name }}</td>
                        <td>{{ vehicleLocal.year }}</td>
                        <td>{{ vehicleLocal.engine }}</td>
                        <td>{{ vehicleLocal.color }}</td>
                        <td>{{ vehicleLocal.km }}</td>
                        <td>{{ vehicleLocal.created_at |  moment('DD/MM/YYYY') }}</td>

                        <!-- <td width="10px">
                            <a href="#" class="btn btn-warning btn-sm"
                                @click.prevent="editVehicle( { vehicleLocal } )"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Editar">
                                <i class="far fa-edit"></i>
                            </a>
                        </td> -->

                        <td width="10px">
                            <a href="#" class="btn btn-info btn-sm"
                                @click.prevent="detailVehicle( { vehicleLocal } )"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Detalle">
                                <i class="fas fa-info"></i>
                            </a>
                        </td>
                        <td width="10px">
                            <a href="#" class="btn btn-success btn-sm"
                                @click.prevent="modalDetailVehicle( { vehicleLocal } )"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Detalle">
                                <i class="fas fa-plus-circle"></i>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm"
                                @click.prevent="modalRequestParts( { vehicleLocal } )"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Cotizar Repuestos">
                                <i class="fas fa-cog"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <nav>
            <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link" href="#" @click.prevent="changePageVehicle({page: 1})">
                        <span>Primera</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link" href="#" @click.prevent="changePageVehicle({page: pagination.current_page - 1})">
                        <span>Atrás</span>
                    </a>
                </li>

                <li class="page-item" v-for="page in pagesNumber"
                    v-bind:class="[ page == isActived ? 'active' : '' ]" :key="page">
                    <a class="page-link" href="#" @click.prevent="changePageVehicle({page})">
                        {{ page }}
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link" href="#" @click.prevent="changePageVehicle({page: pagination.current_page + 1})">
                        <span>Siguiente</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link" href="#"  @click.prevent="changePageVehicle({page:pagination.last_page})">
                        <span>Última</span>
                    </a>
                </li>
            </ul>
        </nav>

        <Agregar></Agregar>
        <!-- <Editar></Editar> -->
        <Detalle></Detalle>
        <Imagenes></Imagenes>
        <AgregarDetalle></AgregarDetalle>
        <RequestParts></RequestParts>

    </div>

</template>


<script>

import { loadProgressBar } from 'axios-progress-bar'
import Agregar from './Agregar'
import Editar from './Editar'
import Detalle from '../Vehicle/Detalle'
import Imagenes from '../Vehicle/Imagenes'
import AgregarDetalle from '../Vehicle/AgregarDetalle'
import RequestParts from '../Vehicle/RequestParts'
import { mapState, mapActions, mapGetters } from 'vuex'

export default {
    components: { Agregar, Editar, Detalle, Imagenes, AgregarDetalle, RequestParts },
    computed:{
        ...mapState(['vehicles', 'pagination', 'offset', 'searchVehicle', 'errorsLaravel']),
        ...mapGetters(['isActived', 'pagesNumber'])
    },
    methods:{
        ...mapActions(['getClientVehicles', 'editVehicle', 'detailVehicle', 'modalDetailVehicle', 'changePageVehicle', 'modalRequestParts'])
    },
    created(){
        loadProgressBar();
        this.$store.dispatch('getClientVehicles')
    }
}

</script>

<style>

</style>
