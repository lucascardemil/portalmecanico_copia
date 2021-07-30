<template>

<div>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="pills-product-exist-tab" data-toggle="pill" href="#pills-product-exist" role="tab" aria-controls="pills-product-exist" aria-selected="true">Producto Existente</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-new-product-tab" data-toggle="pill" href="#pills-new-product" role="tab" aria-controls="pills-new-product" aria-selected="false">Nuevo Producto</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-utility-tab" data-toggle="pill" href="#pills-utility" role="tab" aria-controls="pills-utility" aria-selected="false">Utilidad Por Defecto</a>
        </li>
    </ul>
    <div class="tab-content bg-white p-3" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-product-exist" role="tabpanel" aria-labelledby="pills-product-exist-tab">
            <form action="POST" v-on:submit.prevent="createCode">
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="producto">Producto</label>
                        <SelectProduct></SelectProduct>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="cliente">Proveedor</label>
                        <SelectProvider></SelectProvider>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="codigo">Código</label>
                        <input required
                        type="text"
                        name="codigo"
                        class="form-control" v-model="newCode.codebar">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="atributo">Atributo</label>
                        <input required
                        type="number"
                        name="atributo"
                        class="form-control" v-model="newCode.atributo">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-plus-square"></i> Guardar
                </button>
            </form>
        </div>
        <div class="tab-pane fade" id="pills-new-product" role="tabpanel" aria-labelledby="pills-new-product-tab">
            <form action="POST" v-on:submit.prevent="createProduct">
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="nombre">*Nombre</label>
                        <input required
                                type="text"
                                name="nombre"
                                class="form-control" v-model="newProduct.name">
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="detalle">*Detalle</label>
                        <input required
                                type="text"
                                name="detalle"
                                class="form-control" v-model="newProduct.detail">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-6">
                        <label for="cliente">*Proveedor</label>
                        <SelectProvider></SelectProvider>
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="codigo">*Código</label>
                        <input required
                                type="text"
                                name="codigo"
                                class="form-control" v-model="newProduct.codebar">
                    </div>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-plus-square"></i> Guardar
                </button>
            </form>
        </div>
        
        <div class="tab-pane fade" id="pills-utility" role="tabpanel" aria-labelledby="pills-utility-tab">
            <form action="POST" v-on:submit.prevent="updateUtilidadDefect">
                <div class="form-row">
                    <!-- <div class="form-group">
                        <input type="file" class="form-control"  id="input-file-import" name="file_import" ref="import_file" accept=".xlsx, .xls" @change="onFileChange({ evt: $event})">
                        <input required id="files" type="file" name="import_file" class="form-control" accept=".xlsx, .xls" @change="onFileChange({ evt: $event})">
                    </div> -->
                    <!-- <div class="form-group">
                        <label for="empresa">Empresa</label>
                        <SelectProvider></SelectProvider>
                    </div> -->
                    <div class="form-group col-lg-6">
                        <label for="utilidad">Utilidad</label>
                        <UtilidadDefect></UtilidadDefect>
                        
                    </div>

                </div>
            
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-plus-square"></i> Guardar
                </button>
                            
                        
            </form>
        </div>
        
    </div>
    <div class="row mt-3">
        <div class="col-lg-6">
          <input type="text" v-model="search" class="form-control" placeholder="Filtrar Producto...">
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-striped mt-3 table-sm text-white bg-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Detalle</th>
                    <th>Cliente</th>
                    <th>Código</th>
                    <th>Fecha</th>
                    <th>%Utilidad</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="codeLocal in rows" :key="codeLocal.id">
                    <td width="30px">{{ codeLocal.id }}</td>
                    <td>{{ codeLocal.product.name }}</td>
                    <td>{{ codeLocal.product.detail }}</td>
                    <td>{{ codeLocal.client.name }}</td>
                    <td>{{ codeLocal.codebar }}</td>
                    <td>{{ codeLocal.created_at | moment('DD/MM/YYYY') }}</td>
                    <td v-if="codeLocal.productpagos != null">{{ codeLocal.productpagos.utilidad }}%</td>
                    <td v-else></td>
                    <td width="150px">
                        <a href="#" class="btn btn-warning btn-sm"
                        @click.prevent="editCode( { codeLocal } )"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Editar">
                        <i class="far fa-edit"></i>
                        </a>
                        <a href="#" class="btn btn-danger btn-sm"
                        @click.prevent="modalDeleteCode( { id: codeLocal.id } )"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Eliminar">
                        <i class="fas fa-ban"></i>
                        </a>
                        <a href="#" class="btn btn-info btn-sm"
                        @click.prevent="modalInventory( { id: codeLocal.id } )"
                        data-toggle="tooltip"
                        data-placement="top"
                        title="Inventariado">
                        <i class="fas fa-boxes"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <nav>
        <ul class="pagination">
            <li class="page-item" v-if="pagination.current_page > 1">
                <a class="page-link border-light bg-dark" href="#" @click.prevent="changePageCode({page: 1})"><span>Primera</span></a>
            </li>
            <li class="page-item" v-if="pagination.current_page > 1">
                <a class="page-link border-light bg-dark" href="#" @click.prevent="changePageCode({page: pagination.current_page - 1})"><span>Atrás</span></a>
            </li>
            <li class="page-item" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '' ]" :key="page">
                <a class="page-link border-light bg-dark" href="#" @click.prevent="changePageCode({page})">{{ page }}</a>
            </li>
            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                <a class="page-link border-light bg-dark" href="#" @click.prevent="changePageCode({page: pagination.current_page + 1})"><span>Siguiente</span></a>
            </li>
            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                <a class="page-link border-light bg-dark" href="#" @click.prevent="changePageCode({page:pagination.last_page})"><span>Última</span></a>
            </li>
        </ul>
    </nav>
    <EditarCode></EditarCode>
    <EliminarCode></EliminarCode>
    <Inventory></Inventory>
    <EliminarInventory></EliminarInventory>
</div>

</template>

<script>
import { loadProgressBar } from 'axios-progress-bar'
import { mapState, mapActions, mapGetters } from 'vuex'
import SelectProduct from '../Product/Select'
import SelectProvider from '../Provider/Select'
import EditarCode from './EditarCode'
import EliminarCode from './EliminarCode'
import Inventory from './Inventory'
import EliminarInventory from './EliminarInventory'
import UtilidadDefect from '../Utilidad/UtilidadDefect'

export default {
  data() {
    return {
      search: ''
    }
  },
  components: { SelectProduct, SelectProvider, EditarCode, EliminarCode, Inventory, EliminarInventory, UtilidadDefect},
  computed:{
      rows() {
        return this.codes.filter(code => {
          return code.product.name.toLowerCase().includes(this.search.toLowerCase())
        })
      },
      ...mapState(['codes', 'selectedPago','newProduct', 'newCode', 'pagination', 'offset', 'errorsLaravel', 'allInventory']),
      ...mapGetters(['isActived', 'pagesNumber'])
  },
  methods:{
      ...mapActions(['updateUtilidadDefect','createProduct', 'getCodes', 'createCode', 'editCode','modalDeleteCode', 'modalInventory', 'changePageCode'])
  },
  created(){
      loadProgressBar()
      this.$store.dispatch('getCodes', { page: 1 })
      this.$store.dispatch('allInventories')
  }
}
</script>

<style>
</style>
