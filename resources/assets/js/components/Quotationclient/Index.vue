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
                                    <div class="col-6">
                                        <div class="col-12 mb-3">
                                            <input 
                                            
                                                   type="checkbox" 
                                                   name="cliente_part"
                                                   v-model="newQuotationclient.cliente_part">
                                            <label for="cliente">Cliente Particular</label>
                                            
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="cliente">Cliente</label>
                                            <SelectClient></SelectClient>
                                        </div>

                                        
                                    
                                        <div class="col-12 mb-3">
                                            <label for="nombre">Nombre Cliente</label>
                                            <input required
                                                    
                                                    type="text"
                                                    name="nombre"
                                                    class="form-control" v-model="newQuotationclient.client_text">
                                            
                                            
                                        </div>
                                        
                                        <div class="col-12 mb-3">
                                            <label for="url">URL</label>
                                            <input 
                                                    type="text"
                                                    name="url"
                                                    class="form-control" v-model="newQuotationclient.url">
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="pago">Forma de Pago</label>
                                            <input required
                                                    
                                                    type="text"
                                                    name="pago"
                                                    class="form-control" v-model="newQuotationclient.payment">
                                            
                                            
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success form-control">
                                                <i class="fas fa-plus-square"></i> Guardar
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="marca">Marca</label>
                                                <BrandSelector/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6 mb-3">
                                                <label for="modelo">Modelo</label>
                                                <ModelSelector/>
                                            </div>

                                            <div class="col-6">
                                                <label for="anio">Año</label>
                                                <YearSelector/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="engine">Motor</label>
                                                <EngineSelector/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="table-responsive">
            <table class="table table-striped mt-3 text-white bg-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Generado</th>
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
                            <input type="text" class="form-control" style="width : 60px"
                                    v-model="searchQuotationClient.id" @keyup="getQuotationclients">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>    
                            <input type="text" class="form-control"
                                    v-model="searchQuotationClient.razonSocial" @keyup="getQuotationclients">
                        </td>
                        <td>
                            <input type="text" class="form-control"
                                    v-model="searchQuotationClient.client" @keyup="getQuotationclients">
                        </td>
                        <td>
                            <input type="text" class="form-control"
                                    v-model="searchQuotationClient.vehicle" @keyup="getQuotationclients">
                        </td>
                        <td>
                            <div class="form-inline">
                                <input type="text" class="form-control" style="width : 50px"
                                    v-model="searchQuotationClient.day" @keyup="getQuotationclients">
                                <h5>/</h5>
                                <input type="text" class="form-control" style="width : 50px" 
                                    v-model="searchQuotationClient.month" @keyup="getQuotationclients">
                                <h5>/</h5>
                                <input type="text" class="form-control" style="width : 60px"
                                    v-model="searchQuotationClient.year" @keyup="getQuotationclients">
                            </div>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr v-for="quotationLocal in quotationclients" :key="quotationLocal.id">

                        <td width="10px">{{ quotationLocal.id }}</td>
                        <td>
                            <a v-if="quotationLocal.generado == 1" class="btn btn-warning btn-sm font-weight-bold">Sin Giro Comercial</a>
                            <a v-if="quotationLocal.generado == 2" class="btn btn-primary btn-sm font-weight-bold">Con Giro Comercial</a>
                            <!-- <a v-if="quotationLocal.generado == 3" class="btn btn-success btn-sm font-weight-bold" type="button" @click.prevent="showModalDetail({ id: quotationLocal.id })">Formulario Cotizar</a> -->
                            <a v-if="quotationLocal.generado == 4" class="btn btn-danger btn-sm font-weight-bold" type="button" @click.prevent="showModalDetailMechanic({ id: quotationLocal.id })">Repuestos A Solicitar</a>
                        </td>
                        <td>{{ quotationLocal.state }}</td>
                        <td>{{ quotationLocal.rut }}</td>
                        <td>{{ quotationLocal.razonSocial }}</td>
                        <td>{{ quotationLocal.client_text }}</td>
                        <td>{{ quotationLocal.vehicle }}</td>
                        <td>{{ quotationLocal.created_at |  moment('DD/MM/YYYY H:mm a') }}</td>
                        <td>

                            <a :href="quotationLocal.url" v-if="quotationLocal.url != ''" class="btn btn-primary btn-sm" target="_blank"
                                data-toggle="tooltip"
                                data-placeemnt="top"
                                title="Messenger">
                                <i class="fab fa-facebook-f"></i>
                            </a>

                            
                           
                            <a href="#" v-if="quotationLocal.generado_client == 0 && (quotationLocal.generado == 1 || quotationLocal.generado == 2)" class="btn btn-light btn-sm"
                                @click.prevent="modalCreateUserFromQuotation({ id: quotationLocal.id })"
                                data-toggle="tooltip"
                                data-placeemnt="top"
                                title="Crear Usuario">
                                <i class="fas fa-user"></i>
                            </a>
                            
                            <a href="#" v-if="quotationLocal.generado_client == 0 && quotationLocal.generado == 5" class="btn btn-light btn-sm"
                                @click.prevent="showModalDetailUserMechanic({ id: quotationLocal.id })"
                                data-toggle="tooltip"
                                data-placeemnt="top"
                                title="Crear Usuario">
                                <i class="fas fa-user"></i>
                            </a>
                             
            
                            <a href="#" v-if="quotationLocal.tipo_detalle == 0" class="btn btn-info btn-sm"
                                @click.prevent="showModalDetailclient({ id: quotationLocal.id })"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Detalle">
                                <i class="far fa-plus-square"></i>
                                Detalle
                            </a>

                            <a href="#" v-if="quotationLocal.tipo_detalle == 1" class="btn btn-info btn-sm"
                                @click.prevent="showModalDetailclientMechanic({ id: quotationLocal.id })"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Detalle">
                                <i class="far fa-plus-square"></i>
                                Detalle
                            </a>

                            <a href="#" class="btn btn-danger btn-sm"
                                @click.prevent="showModalDeleteQuotationclient( { id: quotationLocal.id } )"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Eliminar">
                                <i class="far fa-trash-alt"></i>
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

        
        <ListarClientesForm></ListarClientesForm>


        <CreateUser></CreateUser>
        <CreateUserMechanic></CreateUserMechanic>
        <DetalleCliente></DetalleCliente>
        <Detalle></Detalle>
        <DetalleMechanic></DetalleMechanic>
        <DetalleClienteMechanic></DetalleClienteMechanic>
        <DetalleEditarC></DetalleEditarC>
        <DetalleEditarCM></DetalleEditarCM>
        <EliminarCotizacionCliente></EliminarCotizacionCliente>

    </div>

</template>


<script>

import { loadProgressBar } from 'axios-progress-bar'
import SelectClient from '../Client/Select'
import DetalleCliente from './DetalleCliente'
import DetalleMechanic from './DetalleMechanic'
import DetalleClienteMechanic from './DetalleClienteMechanic'
import Detalle from './Detalle'
import DetalleEditarC from './DetalleEditar'
import DetalleEditarCM from './DetalleEditarMechanic'
import CreateUserMechanic from './CreateUserMechanic'
import EliminarCotizacionCliente from './Eliminar'
import CreateUser from '../Quotation/CreateUser'
import ListarClientesForm from './ListarClientesForm'
import { mapState, mapActions, mapGetters } from 'vuex'


import BrandSelector from '../Quotationuser/BrandSelector'
import ModelSelector from '../Quotationuser/ModelSelector'
import YearSelector from '../Quotationuser/YearSelector'
import EngineSelector from '../Quotationuser/EngineSelector'

export default {
    components: { SelectClient, BrandSelector, ModelSelector, YearSelector, EngineSelector , DetalleCliente, Detalle, DetalleEditarC, DetalleEditarCM, EliminarCotizacionCliente, CreateUser, CreateUserMechanic, DetalleMechanic, DetalleClienteMechanic, ListarClientesForm },
    computed:{
        ...mapState(['quotationclients','quotationclientsform' ,'newQuotationclient', 'searchQuotationClient','pagination', 'offset', 'errorsLaravel']),
        ...mapGetters(['isActived', 'pagesNumber'])
    },
    methods:{
        ...mapActions(['getQuotationclients', 'getQuotationclientsform', 'createQuotationclient', 'showModalDetailclient', 'showModalDetail', 'showModalDetailMechanic', 'showModalDetailUserMechanic', 'showModalDetailclientMechanic',
                        'showModalDeleteQuotationclient', 'changePageQuotationclient', 'modalCreateUserFromQuotation'])
    },
    created(){
        loadProgressBar();
        this.$store.dispatch('getQuotationclients', { page: 1 })
    }

}
</script>

<style>
  .table th, .table td {
    vertical-align: middle;
}
</style>

