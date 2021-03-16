<template>
  <div>
    <h5 class="text-white">
      Inventario
      <a 
        href="#" 
        class="btn btn-success pull-right btn-sm" 
        data-toggle="modal" 
        data-target="#create" 
        title="Agregar"
      >
        <i class="fas fa-plus-circle"></i>
      </a>
    </h5>
    <div class="row mt-3">
      <div class="col-lg-3">
        <input type="text" v-model="search" class="form-control" placeholder="Filtrar Producto...">
      </div>
      <!-- <div class="col">
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
      </div> -->
    </div>
    <table class="table table-borderless table-dark table-hover table-striped mt-3 table-sm">
      <thead>
        <tr>
          <th>ID</th>
          <th>Producto</th>
          <th>Código</th>
          <th>Proveedor</th>
          <th>Fecha Factura</th>
          <th>Precio</th>
          <th>Unidades</th>
          <th><a href="#" @click="sortBy">Total</a></th>
        </tr>
      </thead>
      <tbody v-for="codeLocal in rows" :key="codeLocal.id">
        <tr
          class="accordion-toggle" 
          data-toggle="collapse" 
          :data-target="'#stock'+codeLocal.id"
        >
          <td>{{ codeLocal.id }}</td>
          <td>{{ codeLocal.product.name }}</td>
          <td>{{ codeLocal.codebar }}</td>
          <td>{{ codeLocal.client.name }}</td>
          <td>{{ codeLocal.fecha_fact }}</td>
          <!-- <td>{{ codeLocal.inventories[0].price | currency('$', 0, { thousandsSeparator: '.' })}}</td>
          <td>{{ codeLocal.inventories[0].quantity }}</td>
          <td>{{ totalInventario(codeLocal.inventories[0]) | currency('$', 0, { thousandsSeparator: '.' })}}</td> -->
          <td></td>
          <td>{{ totalUnidades(codeLocal) }}</td>
          <td>{{ totalPrecio(codeLocal) | currency('$', 0, { thousandsSeparator: '.' })}}</td>
        </tr>
        <tr v-for="inventario in codeLocal.inventories" 
          :key="inventario.id" 
          :id="'stock'+inventario.code_id" 
          class="accordian-body collapse"
        >
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>{{ inventario.price | currency('$', 0, { thousandsSeparator: '.' }) }}</td>
          <td>{{ inventario.quantity }}</td>
          <td>{{ totalInventario(inventario) | currency('$', 0, { thousandsSeparator: '.' }) }}</td>
        </tr> 
      </tbody>
    </table>

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
    <!-- <div class="bg-dark col-lg-6 p-4">
        <h3 class="text-white">Total Cantidad Inventario: {{ allInventory.quantity | currency('', 0, { thousandsSeparator: '.' })  }}</h3>
        <h3 class="text-white">Total Costo Inventario: ${{ allInventory.price | currency('', 0, { thousandsSeparator: '.' })  }}</h3>
    </div> -->
    <Agregar />
  </div>
</template>

<script>
  import { loadProgressBar } from 'axios-progress-bar'
  import { mapState, mapActions, mapGetters } from 'vuex'
  import Agregar from './Agregar'

  export default {
    data() {
      return {
        search: '',
        sortMethod: 'asc'
      }
    },
    components: { Agregar },
    computed: {
      rows() {
        return this.codes
          .sort((a, b) => {
            let modifier = 1;
            if(this.sortMethod.localeCompare('desc')) modifier = -1;
            if(this.totalInventario(a.inventories[0]) < this.totalInventario(b.inventories[0])) return -1 * modifier;
            if(this.totalInventario(a.inventories[0]) > this.totalInventario(b.inventories[0])) return 1 * modifier;
            return 0;
          })
          .filter(code => {
            return code.product.name.toLowerCase().includes(this.search.toLowerCase())
          })
      },
      ...mapState(['codes', 'pagination', 'offset', 'errorsLaravel', 'allInventory']),
      ...mapGetters(['isActived', 'pagesNumber'])
    },
    methods:{
      sortBy() {
        this.sortMethod = this.sortMethod==='asc'?'desc':'asc';
      },
      ...mapActions(['crearInventarioUsuario', 'getCodes', 'changePageCode']),
      totalInventario(item){
        return item.price * item.quantity
      },
      totalUnidades(item){
        let total = 0
        for (let i = 0; i<item.inventories.length; i++){
          if (item.inventories[i].code_id == item.id){
            total += parseInt(item.inventories[i].quantity)
          }
        }
        return total
      },
      totalPrecio(item){
        let total = 0
        for (let i = 0; i<item.inventories.length; i++){
          if (item.inventories[i].code_id == item.id){
            total += parseInt(item.inventories[i].price * item.inventories[i].quantity)
          }
        }
        return total
      },
    },
    created(){
      loadProgressBar()
      this.$store.dispatch('getCodes', { page: 1 })
      // this.$store.dispatch('allInventories')
    }
}
</script>

<style scoped>



</style>