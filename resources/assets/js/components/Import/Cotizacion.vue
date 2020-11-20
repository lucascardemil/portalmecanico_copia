<template>

    <form action="POST" v-on:submit.prevent="">
        <div id="modalQuotationImport" class="modal fade modal-fullscreen" style="overflow-y: auto;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header  bg-dark text-white">
                        <h4>Cotización de Importación</h4>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-lg-12">
                                <div id="accordion">
                                    <div class="card">

                                        <div class="card-header p-0" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button id="btn-quotationimport-card"
                                                class="btn btn-block text-left p-3"
                                                data-toggle="collapse" data-target="#collapseTwo"
                                                aria-expanded="true" aria-controls="collapseTwo">
                                            Datos Cliente
                                            <span class="text-right"><i class="fas fa-arrows-alt-v"></i></span>
                                            </button>
                                        </h5>
                                        </div>

                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                            data-parent="#accordion">
                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-lg-4">
                                                        <label for="cliente">Cliente</label>
                                                        <SelectClient></SelectClient>
                                                    </div>

                                                    <div class="col-lg-5">
                                                        <label for="pago">Forma de Pago</label>
                                                        <input v-validate="'min:4'"
                                                                :class="{'input': true, 'is-invalid': errors.has('pago') }"
                                                                type="text"
                                                                name="pago"
                                                                class="form-control" v-model="newQuotationimport.payment">
                                                        <p v-show="errors.has('pago')" class="text-danger">{{ errors.first('pago') }}</p>
                                                    </div>

                                                    <div class="col-lg-2 mt-2">
                                                        <label></label>
                                                        <a href="#" class="btn btn-danger form-control"
                                                            @click.prevent="createQuotationimport"
                                                            data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="Cotización">
                                                            <i class="fas fa-file-pdf"></i>
                                                            Generar Cotización
                                                        </a>
                                                    </div>

                                                </div>

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
                                            <th>Valor Neto (clp)</th>
                                            <th>Cantidad</th>
                                            <th>Adicional (clp)</th>
                                            <th>% (aprox.)</th>
                                            <th>Costo Imp.</th>
                                            <th>Costo Total(clp)</th>
                                            <th>Valor Total (clp)</th>
                                            <th>Unitario (clp)</th>
                                            <th>Precio Venta Chile (clp)</th>
                                            <th>Utilidad (clp)</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr v-for="(detailLocal, index) in detailimports" :key="detailLocal.id">
                                            <td width="10px">{{ index + 1 }}</td>
                                            <td>{{ detailLocal.product  }}</td>
                                            <td>{{ detailLocal.detail }}</td>
                                            <td>{{ detailLocal.price_dolar | currency('$', 0, { thousandsSeparator: '.' }) }}</td>
                                            <td>{{ detailLocal.quantity }}</td>
                                            <td>{{ detailLocal.aditional | currency('$', 0, { thousandsSeparator: '.' }) }}</td>
                                            <td>{{ detailLocal.percentage }}</td>
                                            <td width="100px">
                                                {{ detailLocal.internacional | currency('$', 0, { thousandsSeparator: '.' }) }}
                                            </td>
                                            <td>{{ detailLocal.costTotal | currency('$', 0, { thousandsSeparator: '.' }) }}</td>
                                            <td>{{ detailLocal.total | currency('$', 0, { thousandsSeparator: '.' }) }}</td>
                                            <td>{{ detailLocal.unitario | currency('$', 0, { thousandsSeparator: '.' }) }}</td>
                                            <td width="100px">
                                                <input type="number"
                                                class="form-control form-control-sm"
                                                v-model="detailLocal.valueChile"
                                                @keyup="distributionImport">
                                            </td>
                                            <td width="120px">
                                                <input type="number"
                                                class="form-control form-control-sm"
                                                v-model="detailLocal.utility">
                                            </td>

                                            <td>
                                                <a href="#" class="btn btn-warning btn-sm"
                                                    @click.prevent="editDetailimport( { detailLocal } )"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <!--<a href="#" class="btn btn-danger btn-sm"
                                                    @click.prevent="deleteDetailimport( { id: detailLocal.id } )"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Eliminar">
                                                    <i class="fas fa-ban"></i>
                                                </a>-->

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
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Total: {{ totalImport }}</td>
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
                                            <td>Total + IVA: {{ totalImportIVA }}</td>
                                            <td></td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>

                        </div>

                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success"
                            @click.prevent="finishDetailimport">
                            Finalizar
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
import SelectClient from '../Client/Select'

export default {
    components: { SelectClient },
    computed:{
        ...mapState(['detailimports', 'detailImport', 'detailImportNacional', 'totalImport',
                    'totalImportIVA', 'newDetailimport', 'newQuotationimport', /*'totalDetailimport',*/ 'errorsLaravel']),
        ...mapGetters([])
    },
    methods:{
        ...mapActions(['createDetailimport', 'editDetailimport', 'deleteDetailimport', 'utilityImport',
                    'pdfImport', 'distributionImport', 'finishDetailimport', 'createQuotationimport' /*, 'sumTotalImport'*/])
    },
}
</script>

