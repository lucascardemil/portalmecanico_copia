<template>
    <div class="col-lg-12">
        <h5 class="text-white">
            Administración de Cotizaciones Formales
        </h5>

        <div class="">
            <div id="accordion">
                <div class="card">

                    <div class="card-header p-0" id="headingOne">
                    <h5 class="mb-0">
                        <button id="btn-quotation-card" class="btn btn-block text-left p-3" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                        Nueva Cotización Formal
                        <span class="text-right"><i class="fas fa-arrows-alt-v"></i></span>
                        </button>
                    </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form action="POST" v-on:submit.prevent="createQuotationclient">
                                <div class="row">

                                    <div class="col-lg-3">
                                        <label for="cliente">Cliente</label>
                                        <SelectClient></SelectClient>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="cliente">Nombre Cliente</label>
                                        <input v-validate="'min:2'"
                                                :class="{'input': true, 'is-invalid': errors.has('cliente') }"
                                                type="text"
                                                name="cliente"
                                                class="form-control" v-model="newQuotationclient.client_text">
                                        <p v-show="errors.has('cliente')" class="text-danger">{{ errors.first('cliente') }}</p>
                                    </div>

                                    <!--<div class="col-lg-3">
                                        <label for="vehiculo">Vehículo</label>
                                        <input v-validate="'min:2'"
                                                :class="{'input': true, 'is-invalid': errors.has('vehiculo') }"
                                                type="text"
                                                name="vehiculo"
                                                class="form-control" v-model="newQuotationclient.vehicle">
                                        <p v-show="errors.has('vehiculo')" class="text-danger">{{ errors.first('vehiculo') }}</p>
                                    </div>-->

                                    <div class="col-lg-3">
                                        <label for="vehiculo">Vehículo</label>
                                        <SelectVehicleClient></SelectVehicleClient>
                                    </div>

                                    <div class="col-lg-3">
                                        <label for="pago">Forma de Pago</label>
                                        <input v-validate="'min:4'"
                                                :class="{'input': true, 'is-invalid': errors.has('pago') }"
                                                type="text"
                                                name="pago"
                                                class="form-control" v-model="newQuotationclient.payment">
                                        <p v-show="errors.has('pago')" class="text-danger">{{ errors.first('pago') }}</p>
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

        <div class="table-responsive">
            <table class="table table-hover table-striped mt-3 table-sm text-white bg-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Estado</th>
                        <th>Rut</th>
                        <th>Razón Social</th>
                        <th>Cliente</th>
                        <th>Vehículo</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <input type="text" class="form-control form-control-sm"
                                    v-model="searchQuotationClient.id" @keyup="getQuotationclients">
                        </td>
                        <td></td>
                        <td></td>
                        <td>    
                            <input type="text" class="form-control form-control-sm"
                                    v-model="searchQuotationClient.client_text" @keyup="getQuotationclients">
                        </td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="form-inline">
                                <input type="text" class="form-control form-control-sm" style="width : 35px"
                                    v-model="searchQuotationClient.day" @keyup="getQuotationclients">
                                <h5>/</h5>
                                <input type="text" class="form-control form-control-sm" style="width : 35px" 
                                    v-model="searchQuotationClient.month" @keyup="getQuotationclients">
                                <h5>/</h5>
                                <input type="text" class="form-control form-control-sm" style="width : 60px"
                                    v-model="searchQuotationClient.year" @keyup="getQuotationclients">
                            </div>
                        </td>
                        <td></td>
                    </tr>

                    <tr v-for="quotationLocal in quotationclients" :key="quotationLocal.id">
                        <td width="10px">{{ quotationLocal.id }}</td>
                        <td>{{ quotationLocal.state }}</td>
                        <td>{{ quotationLocal.client.rut }}</td>
                        <td>{{ quotationLocal.client.razonSocial }}</td>
                        <td>{{ quotationLocal.client_text }}</td>
                        <td>{{ quotationLocal.vehicle }}</td>
                        <td>{{ quotationLocal.created_at |  moment('DD/MM/YYYY H:mm A') }}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm"
                                @click.prevent="showModalDetailclient({ id: quotationLocal.id })"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Editar">
                                <i class="fas fa-info-circle"></i>
                                Detalle
                            </a>

                            <a href="#" class="btn btn-danger btn-sm"
                                @click.prevent="showModalDeleteQuotationclient( { id: quotationLocal.id } )"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Eliminar">
                                <i class="fas fa-ban"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <nav>
            <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link border-light bg-dark" href="#"
                    @click.prevent="changePageQuotationclient({page: 1})">
                        <span>Primera</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link border-light bg-dark" href="#"
                    @click.prevent="changePageQuotationclient({page: pagination.current_page - 1})">
                        <span>Atrás</span>
                    </a>
                </li>

                <li class="page-item" v-for="page in pagesNumber"
                    v-bind:class="[ page == isActived ? 'active' : '' ]" :key="page">
                    <a class="page-link border-light bg-dark" href="#"
                    @click.prevent="changePageQuotationclient({page})">
                        {{ page }}
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link border-light bg-dark" href="#"
                    @click.prevent="changePageQuotationclient({page: pagination.current_page + 1})">
                        <span>Siguiente</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link border-light bg-dark" href="#"
                    @click.prevent="changePageQuotationclient({page:pagination.last_page})">
                        <span>Última</span>
                    </a>
                </li>
            </ul>
        </nav>

        <Detalle></Detalle>
        <DetalleEditarC></DetalleEditarC>
        <EliminarCotizacionCliente></EliminarCotizacionCliente>

    </div>

</template>


<script>

import { loadProgressBar } from 'axios-progress-bar'
import SelectClient from '../Client/Select'
import SelectVehicleClient from './SelectVehicleClient'
import Detalle from './Detalle'
import DetalleEditarC from './DetalleEditar'
import EliminarCotizacionCliente from './Eliminar'
import { mapState, mapActions, mapGetters } from 'vuex'

export default {
    components: { SelectClient, SelectVehicleClient, Detalle, DetalleEditarC, EliminarCotizacionCliente  },
    computed:{
        ...mapState(['quotationclients', 'newQuotationclient', 'searchQuotationClient', 'newQuotationclient',
                        'pagination', 'offset', 'errorsLaravel']),
        ...mapGetters(['isActived', 'pagesNumber'])
    },
    methods:{
        ...mapActions(['getQuotationclients', 'createQuotationclient', 'showModalDetailclient',
                        'showModalDeleteQuotationclient', 'changePageQuotationclient'])
    },
    created(){
        loadProgressBar();
        this.$store.dispatch('getQuotationclients', { page: 1 })
    }
}

</script>

<style>

</style>
