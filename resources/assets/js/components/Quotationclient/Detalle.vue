<template>

    <form action="POST" v-on:submit.prevent="">
        <div id="modalQuotationclient" class="modal fade modal-fullscreen">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header  bg-dark text-white">
                        <h4>Administrar Cotización Formal</h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-lg-12">
                                <div id="accordion">
                                    <div class="card">

                                        <div class="card-header p-0" id="headingOne">
                                            <h5 class="mb-0">
                                                <button id="btn-detailclient-card"
                                                    class="btn btn-block text-left p-3"
                                                    data-toggle="collapse" data-target="#collapseOne"
                                                    aria-expanded="true" aria-controls="collapseOne">
                                                Nuevo Producto
                                                <span class="text-right"><i class="fas fa-arrows-alt-v"></i></span>
                                                </button>
                                            </h5>
                                        </div>

                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <form action="POST" v-on:submit.prevent="createDetailclient">

                                                    <div class="row">

                                                        <div class="col-lg-3">
                                                            <label for="cliente">Producto</label>
                                                            <SelectProduct></SelectProduct>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <label for="product">Nombre Producto</label>
                                                            <input 
                                                                type="text"
                                                                name="product"
                                                                class="form-control"
                                                                v-model="newDetailclient.product"
                                                            >
                                                        </div>

                                                         <div class="col-lg-3">
                                                            <label for="product">Código</label>
                                                            <input type="text" name="product" class="form-control"
                                                            v-model="newDetailclient.detail">
                                                        </div>

                                                        <div class="col-lg-1">
                                                            <label for="precio">Precio</label>
                                                            <input type="number" name="precio" class="form-control"
                                                                v-model="newDetailclient.price"
                                                                @keyup="sumTotalProduct">
                                                        </div>

                                                        <div class="col-lg-1">
                                                            <label for="cantidad">Cantidad</label>
                                                            <input type="number" name="quantity" class="form-control"
                                                                v-model="newDetailclient.quantity"
                                                                @keyup="sumTotalProduct">
                                                        </div>

                                                        <div class="col-lg-1">
                                                            <label for="percentage">%</label>
                                                            <input type="number" name="percentage" class="form-control"
                                                                v-model="newDetailclient.percentage"
                                                                @keyup="sumTotalProduct">
                                                        </div>

                                                        <div class="col-lg-1">
                                                            <label for="aditional">Adicional</label>
                                                            <input type="number" name="aditional" class="form-control"
                                                                v-model="newDetailclient.aditional"
                                                                @keyup="sumTotalProduct">
                                                        </div>

                                                        <div class="col-lg-1">
                                                            <label for="transport">Flete</label>
                                                            <input type="number" name="transport" class="form-control"
                                                                v-model="newDetailclient.transport"
                                                                @keyup="sumTotalProduct">
                                                        </div>

                                                        <div class="col-lg-1">
                                                            <label for="utilidad">Utilidad</label>
                                                            <input type="number" name="utilidad" class="form-control"
                                                                v-model="newDetailclient.utility" disabled>
                                                        </div>

                                                        <div class="col-lg-2">
                                                            <label for="plazo">Días de Plazo</label>
                                                            <input type="text" name="plazo" class="form-control"
                                                                v-model="newDetailclient.days">
                                                        </div>

                                                        <div class="col-lg-2">
                                                            <label for="total">Total</label>
                                                            <input type="number" name="total" class="form-control"
                                                                v-model="newDetailclient.total" disabled>
                                                        </div>

                                                        <div class="col-lg-2 mt-2">
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

                            <div class="col-lg-12 table-responsive">

                                <table class="table table-bordered table-striped mt-3 table-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Producto</th>
                                            <th>Código</th>
                                            <th>Plazo</th>
                                            <th>Valor Neto ($)</th>
                                            <th>Cantidad</th>
                                            <th>Porcentaje</th>
                                            <th>Adicional ($)</th>
                                            <th>Transporte ($)</th>
                                            <th>Utilidad ($)</th>
                                            <th>Total Neto ($)</th>
                                            <th>Total + IVA ($)</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <!--<tr>
                                            <td></td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm"
                                                        v-model="newDetail.product">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm"
                                                        v-model="newDetail.price">
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-sm"
                                                    @click.prevent="createDetail"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Crear">
                                                    <i class="fas fa-plus-square"></i>
                                                </a>
                                            </td>
                                        </tr>-->

                                        <tr v-for="(detailLocal, index) in detailclients" :key="detailLocal.id">
                                            <td width="10px">{{ index + 1 }}</td>
                                            <td>{{ detailLocal.product }}</td>
                                            <td>{{ detailLocal.detail }}</td>
                                            <td>{{ detailLocal.days }}</td>
                                            <td>{{ detailLocal.price | currency('', 0, { thousandsSeparator: '.' }) }}</td>
                                            <td>{{ detailLocal.quantity }}</td>
                                            <td>{{ detailLocal.percentage+'%' }}</td>
                                            <td>{{ detailLocal.aditional | currency('', 0, { thousandsSeparator: '.' }) }}</td>
                                            <td>{{ detailLocal.transport | currency('', 0, { thousandsSeparator: '.' }) }}</td>
                                            <td>{{ detailLocal.utility | currency('', 0, { thousandsSeparator: '.' }) }}</td>
                                            
                                            
                                            <td>{{ detailLocal.total | currency('', 0, { thousandsSeparator: '.' }) }}</td>
                                            <th>{{ Math.round(detailLocal.total * 1.19) | currency('', 0, { thousandsSeparator: '.' }) }}</th>

                                            <td>
                                                <a href="#" class="btn btn-warning btn-sm"
                                                    @click.prevent="editDetailclient( { detailLocal } )"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <a href="#" class="btn btn-danger btn-sm"
                                                    @click.prevent="deleteDetailclient( { id: detailLocal.id } )"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Eliminar">
                                                    <i class="fas fa-ban"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Total: {{ totalAdicional | currency('', 0, { thousandsSeparator: '.' }) }}</td>
                                            <td>Total: {{ totalTransporte | currency('', 0, { thousandsSeparator: '.' }) }}</td>
                                            <td>Total: {{ totalUtilidad | currency('', 0, { thousandsSeparator: '.' }) }}</td>
                                            <td>Total: {{ totalQuotationclient | currency('', 0, { thousandsSeparator: '.' }) }}</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Total + IVA: {{ totalQuotationclientIVA | currency('', 0, { thousandsSeparator: '.' }) }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-danger"
                            @click.prevent="pdfQuotationclient">
                            <i class="far fa-file-pdf"></i> PDF
                        </a>

                        <a class="btn btn-danger"
                            @click.prevent="pdfIvaQuotationclient">
                            <i class="far fa-file-pdf"></i> PDF IVA Incluido
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </form>

</template>

<script>

import { loadProgressBar } from 'axios-progress-bar'
import { mapState, mapGetters, mapActions } from 'vuex'
import SelectProduct from '../Product/Select'

export default {
    components: { SelectProduct },
    computed:{
        ...mapState(['detailclients', 'totalQuotationclient', 'totalUtilidad', 'totalTransporte', 'totalAdicional',
                    'totalQuotationclientIVA', 'newDetailclient', 'totalDetailclient', 'errorsLaravel']),
        ...mapGetters([])
    },
    methods:{
        ...mapActions(['createDetailclient', 'editDetailclient', 'deleteDetailclient',
                    'pdfQuotationclient', 'pdfIvaQuotationclient', 'sumTotalProduct'])
    },
}
</script>

