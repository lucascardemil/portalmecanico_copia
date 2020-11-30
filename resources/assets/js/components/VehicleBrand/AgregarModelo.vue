<template>
    <div class="row">
        <div class="col-12">
            <div id="accordion">
                <div class="card">
                    <div class="card-header p-0" id="headingOne">
                    <h5 class="mb-0">
                        <button id="btn-type-card" class="btn btn-block text-left p-3" data-toggle="collapse" data-target="#nuevo_modelo"
                            aria-expanded="true" aria-controls="collapseOne">
                        Nuevo Modelo
                        <span class="text-right"><i class="fas fa-arrows-alt-v"></i></span>
                        </button>
                    </h5>
                    </div>

                    <div id="nuevo_modelo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form action="POST" v-on:submit.prevent="createVehicleModel">
                                <div class="row">

                                    <div class="col">

                                        <label for="model">Modelo</label>
                                        <input v-validate="'required|min:2|max:190'"
                                                :class="{'input': true, 'is-invalid': errors.has('model') }"
                                                type="text"
                                                name="model"
                                                class="form-control" v-model="newVehicleModelo.model">
                                        <p v-show="errors.has('model')" class="text-danger">{{ errors.first('model') }}</p>

                                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                                            <p>{{ error.model }}</p>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="model">Marca</label>
                                        <SelectBrand></SelectBrand>
                                    </div>

                                    <div class="col-12">
                                        <label for="model">Tipo de vehiculo</label>
                                        <TiposSelector></TiposSelector>
                                    </div>

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
        </div>
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover table-striped mt-3 table-sm text-white bg-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Modelo</th>
                            <th>Marca</th>
                            <th>Tipo de vehiculo</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr>
                            <td></td>
                            <td> 
                                <input type="text" class="form-control form-control-sm"
                                        v-model="searchVehicleBrand.brand" @keyup="getVehicleBrands">
                            </td>
                            <td></td>
                        </tr> -->

                        <tr v-for="vehiclemodelLocal in vehiclemodels" :key="vehiclemodelLocal.id">
                            <td width="10px">{{ vehiclemodelLocal.id }}</td>
                            <td>{{ vehiclemodelLocal.model }}</td>
                            <td>{{ vehiclemodelLocal.brand }}</td>
                            <td>{{ vehiclemodelLocal.tipo }}</td>
                            
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
                    <li class="page-item" v-if="pagination_modelo.current_page > 1">
                        <a class="page-link" href="#" @click.prevent="changePageVehicleModel({page: 1})">
                            <span>Primera</span>
                        </a>
                    </li>

                    <li class="page-item" v-if="pagination_modelo.current_page > 1">
                        <a class="page-link" href="#" @click.prevent="changePageVehicleModel({page: pagination_modelo.current_page - 1})">
                            <span>Atrás</span>
                        </a>
                    </li>

                    <li class="page-item" v-for="page in pagesNumber_modelo"
                        v-bind:class="[ page == isActived_modelo ? 'active' : '' ]" :key="page">
                        <a class="page-link" href="#" @click.prevent="changePageVehicleModel({page})">
                            {{ page }}
                        </a>
                    </li>

                    <li class="page-item" v-if="pagination_modelo.current_page < pagination_modelo.last_page">
                        <a class="page-link" href="#" @click.prevent="changePageVehicleModel({page: pagination_modelo.current_page + 1})">
                            <span>Siguiente</span>
                        </a>
                    </li>

                    <li class="page-item" v-if="pagination_modelo.current_page < pagination_modelo.last_page">
                        <a class="page-link" href="#"  @click.prevent="changePageVehicleModel({page:pagination_modelo.last_page})">
                            <span>Última</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <EditarModelo></EditarModelo>
    </div>
</template>
<script>

import { loadProgressBar } from 'axios-progress-bar'
import TiposSelector from './TiposSelector'
import SelectBrand from './SelectBrand'
import EditarModelo from '../VehicleModel/EditarModelo'
import { mapState, mapActions, mapGetters } from 'vuex'

export default {
    components: {EditarModelo, SelectBrand, TiposSelector},
    computed:{
        ...mapState(['newVehicleModelo', 'errorsLaravel', 'vehiclemodels', 'pagination_modelo', 'offset_modelo']),
        ...mapGetters(['isActived_modelo', 'pagesNumber_modelo'])
    },
    methods:{
        ...mapActions(['createVehicleModel','editVehicleModel', 'changePageVehicleModel'])
    },
    created(){
        loadProgressBar();
        this.$store.dispatch('getVehicleModels', { page: 1 })
    }
}
</script>