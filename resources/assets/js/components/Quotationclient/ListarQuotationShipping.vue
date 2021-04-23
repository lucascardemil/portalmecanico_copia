<template>
    <div class="table-responsive">
        <table class="table table-striped mt-3 text-white bg-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>RUT</th>
                    <th>Telefono</th>
                    <th>Ciudad</th>
                    <th>Dirección</th>
                    <th>Sucursal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr>
                    <td>
                        <input type="text" class="form-control" style="width : 60px"
                                v-model="searchQuotationClientForm.id" @keyup="getQuotationclientsform">
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>    
                        <input type="text" class="form-control"
                                v-model="searchQuotationClientForm.razonSocial" @keyup="getQuotationclientsform">
                    </td>
                    <td>
                        <input type="text" class="form-control"
                                v-model="searchQuotationClientForm.client" @keyup="getQuotationclientsform">
                    </td>
                    <td>
                        <input type="text" class="form-control"
                                v-model="searchQuotationClientForm.vehicle" @keyup="getQuotationclientsform">
                    </td>
                    <td>
                        <div class="form-inline">
                            <input type="text" class="form-control" style="width : 50px"
                                v-model="searchQuotationClientForm.day" @keyup="getQuotationclientsform">
                            <h5>/</h5>
                            <input type="text" class="form-control" style="width : 50px" 
                                v-model="searchQuotationClientForm.month" @keyup="getQuotationclientsform">
                            <h5>/</h5>
                            <input type="text" class="form-control" style="width : 60px"
                                v-model="searchQuotationClientForm.year" @keyup="getQuotationclientsform">
                        </div>
                    </td>
                    <td></td>
                    <td></td>
                </tr> -->
                <tr>
                    <td colspan="7">
                        <input type="text" class="form-control" v-model="linkenvio.url" readonly=readonly>
                        <input type="hidden" id="testing-code" :value="linkenvio.url">
                    </td>
                    <td>
                        <span class="btn btn-info btn-block" @click.stop.prevent="copyTestingCode">Copiar</span>
                    </td>
                </tr>
                <tr v-for="quotationshippingLocal in quotationshipping" :key="quotationshippingLocal.id">

                    <td width="10px">{{ quotationshippingLocal.id }}</td>
                    <td>{{ quotationshippingLocal.nombre }}</td>
                    <td>{{ quotationshippingLocal.rut }}</td>
                    <td>{{ quotationshippingLocal.telefono }}</td>
                    <td>{{ quotationshippingLocal.ciudad }}</td>
                    <td>{{ quotationshippingLocal.direccion }}</td>
                    <td>{{ quotationshippingLocal.sucursal }}</td>
                    <td>
                        <a class="btn btn-secondary" href="#" role="button"
                            @click.prevent="pdfQuotationShipping({ id: quotationshippingLocal.id })"><i class="far fa-file-alt"></i> Generar
                        </a>
                        <a class="btn btn-danger" href="#" role="button"
                            @click.prevent="showdeleteQuotationShipping({ id: quotationshippingLocal.id })"><i class="far fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- <nav>
            <ul class="pagination">
                <li class="page-item" v-if="pagination_form.current_page > 1">
                    <a class="page-link border-light bg-dark" href="#"
                    @click.prevent="changePageQuotationclientForm({page: 1})">
                        <span>Primera</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination_form.current_page > 1">
                    <a class="page-link border-light bg-dark" href="#"
                    @click.prevent="changePageQuotationclientForm({page: pagination_form.current_page - 1})">
                        <span>Atrás</span>
                    </a>
                </li>

                <li class="page-item" v-for="page in pagesNumber_form"
                    v-bind:class="[ page == isActived_form ? 'active' : '' ]" :key="page">
                    <a class="page-link border-light bg-dark" href="#"
                    @click.prevent="changePageQuotationclientForm({page})">
                        {{ page }}
                    </a>
                </li>

                <li class="page-item" v-if="pagination_form.current_page < pagination_form.last_page">
                    <a class="page-link border-light bg-dark" href="#"
                    @click.prevent="changePageQuotationclientForm({page: pagination_form.current_page + 1})">
                        <span>Siguiente</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination_form.current_page < pagination_form.last_page">
                    <a class="page-link border-light bg-dark" href="#"
                    @click.prevent="changePageQuotationclientForm({page:pagination_form.last_page})">
                        <span>Última</span>
                    </a>
                </li>
            </ul>
        </nav> -->
        <EliminarShipping></EliminarShipping>
    </div>
</template>

<script>

import EliminarShipping from '../QuotationShipping/EliminarShipping'
import { loadProgressBar } from 'axios-progress-bar'
import { mapState, mapActions, mapGetters } from 'vuex'
import toastr from 'toastr'

export default {
    components: { EliminarShipping },
    computed:{
        ...mapState(['quotationshipping','linkenvio','errorsLaravel']),
    },
    methods:{
        ...mapActions(['getQuotationShipping','pdfQuotationShipping','showdeleteQuotationShipping']),
        copyTestingCode () {
          let testingCodeToCopy = document.querySelector('#testing-code')
          testingCodeToCopy.setAttribute('type', 'text')    // 不是 hidden 才能複製
          testingCodeToCopy.select()

          try {
            var successful = document.execCommand('copy');
            var msg = successful ? ' con exito' : ' sin exito';
            toastr.success('Se copio el link' + msg)
          } catch (err) {
            toastr.error('No se pudo copiar el link')
          }

          /* unselect the range */
          testingCodeToCopy.setAttribute('type', 'hidden')
          window.getSelection().removeAllRanges()
        },
    },
    created(){
        this.$store.dispatch('getQuotationShipping'),
        this.$store.dispatch('getQuotationlinkenvio')
    }

}
</script>