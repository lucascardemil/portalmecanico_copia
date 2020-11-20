<template>

    <div class="col-lg-12">

        <h5 class="text-white">
            Nuevo Modelo
            <a href="#" class="btn btn-success pull-right btn-sm" data-toggle="modal" data-target="#createModel"
                title="Agregar">
                <i class="fas fa-plus-circle"></i>
            </a>
        </h5>
        <div class="table-responsive">
            <table class="table table-hover table-striped mt-3 table-sm text-white bg-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr v-for="vehiclemodelLocal in vehiclemodels" :key="vehiclemodelLocal.id">
                        <td width="10px">{{ vehiclemodelLocal.id }}</td>
                        <td>{{ vehiclemodelLocal.brand }}</td>
                        <td>{{ vehiclemodelLocal.model }}</td>
                        
                        <td width="10px">
                            <a href="#" class="btn btn-warning btn-sm"
                                @click.prevent="editVehicleModel( { vehiclemodelLocal } )"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Editar">
                                <i class="far fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <nav>
            <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link" href="#" @click.prevent="changePageVehicleModel({page: 1})">
                        <span>Primera</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link" href="#" @click.prevent="changePageVehicleModel({page: pagination.current_page - 1})">
                        <span>Atrás</span>
                    </a>
                </li>

                <li class="page-item" v-for="page in pagesNumber"
                    v-bind:class="[ page == isActived ? 'active' : '' ]" :key="page">
                    <a class="page-link" href="#" @click.prevent="changePageVehicleModel({page})">
                        {{ page }}
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link" href="#" @click.prevent="changePageVehicleModel({page: pagination.current_page + 1})">
                        <span>Siguiente</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link" href="#"  @click.prevent="changePageVehicleModel({page:pagination.last_page})">
                        <span>Última</span>
                    </a>
                </li>
            </ul>
        </nav>

        <AgregarModelo></AgregarModelo>
        <EditarModelo></EditarModelo>
    </div>

</template>


<script>

import { loadProgressBar } from 'axios-progress-bar'
import AgregarModelo from './AgregarModelo'
import EditarModelo from './EditarModelo'
import { mapState, mapActions, mapGetters } from 'vuex'

export default {
    components: { AgregarModelo, EditarModelo },
    computed:{
        ...mapState(['vehiclemodels', 'pagination', 'offset', 'searchVehicleModel']),
        ...mapGetters(['isActived', 'pagesNumber'])
    },
    methods:{
        ...mapActions(['getVehicleModels', 'editVehicleModel','changePageVehicleModel'])
    },
    created(){
        loadProgressBar();
        this.$store.dispatch('getVehicleModels', { page: 1 })
    }
}

</script>

<style>

</style>
