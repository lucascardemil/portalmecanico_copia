<template>

<div class="container">
  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
      <a class="nav-link active" id="pills-home-tab" data-toggle="pill"
      href="#pills-home" role="tab" aria-controls="pills-home"
      aria-selected="true">Producto Existente</a>
  </li>
  <li class="nav-item">
      <a class="nav-link" id="pills-profile-tab" data-toggle="pill"
      href="#pills-profile" role="tab" aria-controls="pills-profile"
      aria-selected="false">Nuevo Producto</a>
  </li>
  </ul>
  <div class="tab-content bg-white p-3" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
      <form action="POST" v-on:submit.prevent="createCode">
        <div class="row">
          <div class="col-lg-5">
              <label for="producto">Producto</label>
              <SelectProduct></SelectProduct>
          </div>
          <div class="col-lg-5">
              <label for="cliente">Proveedor</label>
              <SelectProvider></SelectProvider>
          </div>
          <div class="col-lg-5">
            <label for="codigo">Código</label>
            <input v-validate="'min:2|max:100'"
              :class="{'input': true, 'is-invalid': errors.has('codigo') }"
              type="text"
              name="codigo"
              class="form-control" v-model="newCode.codebar">
            <p v-show="errors.has('codigo')" class="text-danger">{{ errors.first('codigo') }}</p>
            <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
              <p>{{ error.codebar }}</p>
            </div>
          </div>
          <div class="col-lg-5 mt-2">
              <label></label>
              <button type="submit" class="btn btn-success form-control btn-block">
                  <i class="fas fa-plus-square"></i> Guardar
              </button>
          </div>
        </div>
      </form>
    </div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
      <form action="POST" v-on:submit.prevent="createProduct">
        <div class="row">
          <div class="col-lg-5">
            <label for="nombre">*Nombre</label>
            <input v-validate="'min:4|max:190'"
                    :class="{'input': true, 'is-invalid': errors.has('nombre') }"
                    type="text"
                    name="nombre"
                    class="form-control" v-model="newProduct.name">
            <p v-show="errors.has('nombre')" class="text-danger">{{ errors.first('nombre') }}</p>
            <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                <p>{{ error.name }}</p>
            </div>
          </div>
          <div class="col-lg-5">
            <label for="detalle">*Detalle</label>
            <input v-validate="'max:190'"
              :class="{'input': true, 'is-invalid': errors.has('detalle') }"
              type="text"
              name="detalle"
              class="form-control" v-model="newProduct.detail">
            <p v-show="errors.has('detalle')" class="text-danger">{{ errors.first('detalle') }}</p>
            <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
              <p>{{ error.detail }}</p>
            </div>
          </div>
          <div class="col-lg-5">
              <label for="cliente">*Proveedor</label>
              <SelectProvider></SelectProvider>
          </div>
          <div class="col-lg-5">
            <label for="codigo">*Código</label>
            <input v-validate="'min:2|max:100'"
              :class="{'input': true, 'is-invalid': errors.has('codigo') }"
              type="text"
              name="codigo"
              class="form-control" v-model="newCode.codebar">
            <p v-show="errors.has('codigo')" class="text-danger">{{ errors.first('codigo') }}</p>
            <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
              <p>{{ error.codebar }}</p>
            </div>
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
  <div class="row mt-3">
    <div class="col-lg-3">
      <input type="text" v-model="search" class="form-control" placeholder="Filtrar Producto...">
    </div>
    <div class="col">
      <nav>
        <ul class="pagination">
          <li class="page-item" v-if="pagination.current_page > 1">
            <a class="page-link border-light bg-dark" href="#"
              @click.prevent="changePageCode({page: 1})">
              <span>Primera</span>
            </a>
          </li>
          <li class="page-item" v-if="pagination.current_page > 1">
            <a class="page-link border-light bg-dark" href="#"
              @click.prevent="changePageCode({page: pagination.current_page - 1})">
              <span>Atrás</span>
            </a>
          </li>
          <li class="page-item" v-for="page in pagesNumber"
            v-bind:class="[ page == isActived ? 'active' : '' ]" :key="page">
            <a class="page-link border-light bg-dark" href="#"
              @click.prevent="changePageCode({page})">
              {{ page }}
            </a>
          </li>
          <li class="page-item" v-if="pagination.current_page < pagination.last_page">
            <a class="page-link border-light bg-dark" href="#"
                @click.prevent="changePageCode({page: pagination.current_page + 1})">
                <span>Siguiente</span>
            </a>
          </li>
          <li class="page-item" v-if="pagination.current_page < pagination.last_page">
            <a class="page-link border-light bg-dark" href="#"
              @click.prevent="changePageCode({page:pagination.last_page})">
              <span>Última</span>
            </a>
          </li>
        </ul>
      </nav>
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
        <a class="page-link border-light bg-dark" href="#"
          @click.prevent="changePageCode({page: 1})">
          <span>Primera</span>
        </a>
      </li>
      <li class="page-item" v-if="pagination.current_page > 1">
        <a class="page-link border-light bg-dark" href="#"
          @click.prevent="changePageCode({page: pagination.current_page - 1})">
          <span>Atrás</span>
        </a>
      </li>
      <li class="page-item" v-for="page in pagesNumber"
        v-bind:class="[ page == isActived ? 'active' : '' ]" :key="page">
        <a class="page-link border-light bg-dark" href="#"
          @click.prevent="changePageCode({page})">
          {{ page }}
        </a>
      </li>
      <li class="page-item" v-if="pagination.current_page < pagination.last_page">
        <a class="page-link border-light bg-dark" href="#"
            @click.prevent="changePageCode({page: pagination.current_page + 1})">
            <span>Siguiente</span>
        </a>
      </li>
      <li class="page-item" v-if="pagination.current_page < pagination.last_page">
        <a class="page-link border-light bg-dark" href="#"
          @click.prevent="changePageCode({page:pagination.last_page})">
          <span>Última</span>
        </a>
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

export default {
  data() {
    return {
      search: ''
    }
  },
  components: { SelectProduct, SelectProvider, EditarCode, EliminarCode, Inventory, EliminarInventory },
  computed:{
      rows() {
        return this.codes.filter(code => {
          return code.product.name.toLowerCase().includes(this.search.toLowerCase())
        })
      },
      ...mapState(['codes', 'newProduct', 'newCode', 'pagination', 'offset', 'errorsLaravel', 'allInventory']),
      ...mapGetters(['isActived', 'pagesNumber'])
  },
  methods:{
      ...mapActions(['createProduct', 'getCodes', 'createCode', 'editCode', 'modalDeleteCode', 'modalInventory', 'changePageCode'])
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
