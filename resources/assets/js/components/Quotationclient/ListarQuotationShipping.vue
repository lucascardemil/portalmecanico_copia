<template>
    <div class="table-responsive">
        <table class="table table-striped table-sm text-white bg-dark mt-3">
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
                    <td width="15%">{{ quotationshippingLocal.direccion }}</td>
                    <td>{{ quotationshippingLocal.sucursal }}</td>
                    <td class="text-right">
                        <a class="btn btn-success btn-sm" href="#" role="button"
                            @click.prevent="showQuotationShipping({ id: quotationshippingLocal.id })"><i class="fas fa-shipping-fast"></i> Domicilio
                        </a>
                        <a class="btn btn-info btn-sm" href="#" role="button"
                            @click.prevent="pdfQuotationShipping({ id: quotationshippingLocal.id })"><i class="far fa-file-alt"></i> Generar
                        </a>
                        <a class="btn btn-danger btn-sm" href="#" role="button"
                            @click.prevent="showdeleteQuotationShipping({ id: quotationshippingLocal.id })"><i class="far fa-trash-alt"></i>
                        </a>
                        
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- <nav>
            <ul class="pagination">
                <li class="page-item" v-if="pagination_shipping.current_page > 1">
                    <a class="page-link border-light bg-dark" href="#"
                    @click.prevent="changePageQuotationShipping({page: 1})">
                        <span>Primera</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination_shipping.current_page > 1">
                    <a class="page-link border-light bg-dark" href="#"
                    @click.prevent="changePageQuotationShipping({page: pagination_shipping.current_page - 1})">
                        <span>Atrás</span>
                    </a>
                </li>

                <li class="page-item" v-for="page in pagesNumber_shipping"
                    v-bind:class="[ page == isActived_shipping ? 'active' : '' ]" :key="page">
                    <a class="page-link border-light bg-dark" href="#"
                    @click.prevent="changePageQuotationShipping({page})">
                        {{ page }}
                    </a>
                </li>

                <li class="page-item" v-if="pagination_shipping.current_page < pagination_shipping.last_page">
                    <a class="page-link border-light bg-dark" href="#"
                    @click.prevent="changePageQuotationShipping({ page: pagination_shipping.current_page + 1})">
                        <span>Siguiente</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination_shipping.current_page < pagination_shipping.last_page">
                    <a class="page-link border-light bg-dark" href="#"
                    @click.prevent="changePageQuotationShipping({ page:pagination_shipping.last_page})">
                        <span>Última</span>
                    </a>
                </li>
            </ul>
        </nav> -->
        <EliminarShipping></EliminarShipping>
        <EnvioShipping></EnvioShipping>
    </div>
</template>

<script>

import EliminarShipping from '../QuotationShipping/EliminarShipping'
import EnvioShipping from '../QuotationShipping/EnvioShipping'
import { loadProgressBar } from 'axios-progress-bar'
import { mapState, mapActions, mapGetters } from 'vuex'
import toastr from 'toastr'

export default {
    components: { EliminarShipping, EnvioShipping },
    computed:{
        ...mapState(['quotationshipping','linkenvio','errorsLaravel', 'pagination_shipping', 'offset_shipping']),
        ...mapGetters(['isActived_shipping', 'pagesNumber_shipping'])
    },
    methods:{
        ...mapActions(['getQuotationShipping','pdfQuotationShipping','showdeleteQuotationShipping', 'showQuotationShipping', 'changePageQuotationShipping']),
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
        // this.$store.dispatch('getQuotationShipping', { page: 1 }),
        this.$store.dispatch('getQuotationShipping'),
        this.$store.dispatch('getQuotationlinkenvio')
    }

}
</script>