<template>

    <div class="col-lg-12">

        <!--<h5 class="text-white">
            Nueva Marca
            <a href="#" class="btn btn-success pull-right btn-sm" data-toggle="modal" data-target="#createBrand"
                title="Agregar">
                <i class="fas fa-plus-circle"></i>
            </a>
        </h5>-->

        <div class="row">
            <div class="col-xl-6 col-md-12">
                <div id="accordion">
                    <div class="card">

                        <div class="card-header p-0" id="headingOne">
                        <h5 class="mb-0">
                            <button id="btn-brand-card" class="btn btn-block text-left p-3" data-toggle="collapse" data-target="#nueva_marca"
                                aria-expanded="true" aria-controls="collapseOne">
                            Nueva Marca
                            <span class="text-right"><i class="fas fa-arrows-alt-v"></i></span>
                            </button>
                        </h5>
                        </div>

                        <div id="nueva_marca" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <form action="POST" v-on:submit.prevent="createVehicleBrand">
                                    <div class="row">

                                        <div class="col">

                                            <label for="marca">Marca</label>
                                            <input v-validate="'required|min:2|max:190'"
                                                    :class="{'input': true, 'is-invalid': errors.has('marca') }"
                                                    type="text"
                                                    name="marca"
                                                    class="form-control" v-model="newVehicleBrand.brand">
                                            <p v-show="errors.has('marca')" class="text-danger">{{ errors.first('marca') }}</p>

                                            <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                                                <p>{{ error.brand }}</p>
                                            </div>
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
            <div class="col-xl-6 col-md-12">
                <div id="accordion">
                    <div class="card">

                        <div class="card-header p-0" id="headingOne">
                        <h5 class="mb-0">
                            <button id="btn-type-card" class="btn btn-block text-left p-3" data-toggle="collapse" data-target="#nuevo_tipo"
                                aria-expanded="true" aria-controls="collapseOne">
                            Nuevo Tipo de vehiculo
                            <span class="text-right"><i class="fas fa-arrows-alt-v"></i></span>
                            </button>
                        </h5>
                        </div>

                        <div id="nuevo_tipo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <form action="POST" v-on:submit.prevent="createVehiculoTipo">
                                    <div class="row">

                                        <div class="col">

                                            <label for="tipo_vehiculo">Nombre</label>
                                            <input v-validate="'required|min:2|max:190'"
                                                    :class="{'input': true, 'is-invalid': errors.has('tipo_vehiculo') }"
                                                    type="text"
                                                    name="tipo_vehiculo"
                                                    class="form-control" v-model="newVehiculoTipo.tipo_vehiculo">
                                            <p v-show="errors.has('tipo_vehiculo')" class="text-danger">{{ errors.first('tipo_vehiculo') }}</p>

                                            <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                                                <p>{{ error.tipo_vehiculo }}</p>
                                            </div>
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
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mt-3 table-sm text-white bg-dark">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Marca</th>
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

                            <tr v-for="vehiclebrandLocal in vehiclebrands" :key="vehiclebrandLocal.id">
                                <td width="10px">{{ vehiclebrandLocal.id }}</td>
                                <td>{{ vehiclebrandLocal.brand }}</td>
                                <td width="10px">
                                    <a href="#" class="btn btn-warning btn-sm"
                                        @click.prevent="editVehicleBrand( { vehiclebrandLocal } )"
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
                            <a class="page-link" href="#" @click.prevent="changePageVehicleBrand({page: 1})">
                                <span>Primera</span>
                            </a>
                        </li>

                        <li class="page-item" v-if="pagination.current_page > 1">
                            <a class="page-link" href="#" @click.prevent="changePageVehicleBrand({page: pagination.current_page - 1})">
                                <span>Atrás</span>
                            </a>
                        </li>

                        <li class="page-item" v-for="page in pagesNumber"
                            v-bind:class="[ page == isActived ? 'active' : '' ]" :key="page">
                            <a class="page-link" href="#" @click.prevent="changePageVehicleBrand({page})">
                                {{ page }}
                            </a>
                        </li>

                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link" href="#" @click.prevent="changePageVehicleBrand({page: pagination.current_page + 1})">
                                <span>Siguiente</span>
                            </a>
                        </li>

                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link" href="#"  @click.prevent="changePageVehicleBrand({page:pagination.last_page})">
                                <span>Última</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mt-3 table-sm text-white bg-dark">
                        <thead>
                            <tr>
                                <th>ID</th>
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

                            <tr v-for="vehiculoTipoLocal in vehiculotipos" :key="vehiculoTipoLocal.id">
                                <td width="10px">{{ vehiculoTipoLocal.id }}</td>
                                <td>{{ vehiculoTipoLocal.tipo_vehiculo }}</td>
                                
                                <td width="10px">
                                    <a href="#" class="btn btn-warning btn-sm"
                                        @click.prevent="editVehiculoTipo( { vehiculoTipoLocal } )"
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
                            <a class="page-link" href="#" @click.prevent="changePageVehiculoTipo({page: 1})">
                                <span>Primera</span>
                            </a>
                        </li>

                        <li class="page-item" v-if="pagination.current_page > 1">
                            <a class="page-link" href="#" @click.prevent="changePageVehiculoTipo({page: pagination.current_page - 1})">
                                <span>Atrás</span>
                            </a>
                        </li>

                        <li class="page-item" v-for="page in pagesNumber"
                            v-bind:class="[ page == isActived ? 'active' : '' ]" :key="page">
                            <a class="page-link" href="#" @click.prevent="changePageVehiculoTipo({page})">
                                {{ page }}
                            </a>
                        </li>

                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link" href="#" @click.prevent="changePageVehiculoTipo({page: pagination.current_page + 1})">
                                <span>Siguiente</span>
                            </a>
                        </li>

                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                            <a class="page-link" href="#"  @click.prevent="changePageVehiculoTipo({page:pagination.last_page})">
                                <span>Última</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-12">
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
            </div>
        </div>

        <!--<AgregarMarca></AgregarMarca>-->
        <EditarMarca></EditarMarca>
        <EditarTipo></EditarTipo>
        <EditarModelo></EditarModelo>
    </div>

</template>


<script>

import { loadProgressBar } from 'axios-progress-bar'
//import AgregarMarca from './AgregarMarca'
import TiposSelector from './TiposSelector'
import EditarMarca from './EditarMarca'
import EditarTipo from './EditarTipo'
import SelectBrand from './SelectBrand'
import EditarModelo from '../VehicleModel/EditarModelo'
import { mapState, mapActions, mapGetters } from 'vuex'

export default {
    //components: { AgregarMarca,EditarMarca, SelectBrand },
    components: {EditarMarca, EditarTipo, EditarModelo, SelectBrand, TiposSelector },
    computed:{
        ...mapState(['newVehicleModelo','newVehiculoTipo','newVehicleBrand', 'errorsLaravel' ,'vehiculotipos', 'vehiclebrands', 'vehiclemodels', 'pagination', 'offset', 'searchVehicleBrand']),
        ...mapGetters(['isActived', 'pagesNumber'])
    },
    methods:{
        ...mapActions(['createVehicleModel','createVehiculoTipo','createVehicleBrand', 'editVehicleBrand', 'editVehiculoTipo','editVehicleModel','changePageVehicleBrand', 'changePageVehiculoTipo'])
        //...mapActions(['createVehiculoTipo','createVehicleBrand','getVehicleBrands', 'editVehicleBrand','getVehiculoTipos', 'editVehiculoTipo','changePageVehicleBrand', 'changePageVehiculoTipo'])
    },
    created(){
        loadProgressBar();
        this.$store.dispatch('getVehicleBrands', { page: 1 })
        this.$store.dispatch('getVehiculoTipos', { page: 1 })
        this.$store.dispatch('getVehicleModels', { page: 1 })
    }
}

</script>

<style>

</style>
