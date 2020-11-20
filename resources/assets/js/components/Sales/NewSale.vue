<template>
  <form action="POST" v-on:submit.prevent="">
    <div id="create" class="modal fade modal-fullscreen">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-dark text-white">
            <h4>Nueva Venta</h4>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span>&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-2">
                <label for="select-product">Producto</label>
                <select-product />
              </div>
              <div class="col-lg-2">
                <label for="product">Nombre</label>
                <input 
                  type="text"
                  class="form-control"
                  v-model="productForm.product"
                >
              </div>
              <div class="col-lg-1">
                <label for="code">Código</label>
                <input 
                  type="text" 
                  class="form-control" 
                  v-model="productForm.code"
                >
              </div>

              <div class="col-lg-1">
                <label for="price">Valor Neto</label>
                <input 
                  class="form-control"
                  type="number"
                  v-model="productForm.price"
                >
              </div>
              <div class="col-lg-1">
                <label for="utility">Utilidad (%)</label>
                <input
                  class="form-control"
                  type="number"
                  v-model="productForm.utility"
                >
              </div>
              <div class="col-lg-1">
                <label for="quantity">Cantidad</label>
                <input 
                  class="form-control"
                  type="number"
                  min="1"
                  :max="productForm.max_quantity"
                  v-model="productForm.quantity"
                >
              </div>
              <div class="col-lg-1">
                <label for="value">Total Neto</label>
                <input
                  class="form-control"
                  type="number"
                  v-model="productForm.value"
                  disabled
                >
              </div>
              <div class="col-lg-2">
                <label for="total">Total + IVA</label>
                <input
                  class="form-control"
                  type="number"
                  v-model="productForm.total"
                  disabled
                >
              </div>
              <div class="col-lg-1 mt-2">
                <label />
                <button
                  :disabled="!productForm.value"
                  type="submit"
                  class="btn btn-info form-control"
                >
                  Agregar
                </button>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <h5 class="text-white">Productos</h5>
                <table class="table table-bordered table-striped mt-3 table-sm">
                  <thead>
                    <tr>
                      <th>Producto</th>
                      <th>Precio</th>
                      <th>Utilidad</th>
                      <th>Cantidad</th>
                      <th>Valor Neto</th>
                      <th>Valor Total</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="product in cart" :key="product.product">
                      <td>{{product.product.label}}</td>
                      <td>{{product.price.label | currency('$', 0, { thousandsSeparator: '.' })}}</td>
                      <td>{{product.utility+'%'}}</td>
                      <td>{{product.quantity}}</td>
                      <td>{{product.value | currency('$', 0, { thousandsSeparator: '.' })}}</td>
                      <td>{{product.total | currency('$', 0, { thousandsSeparator: '.' })}}</td>
                      <td>
                        <!-- <div class="col-lg-5 mt-1"> -->
                          <a 
                            href="#" 
                            class="btn btn-danger btn-sm"
                            @click.prevent="removeFromCart({ id: product.code.value })"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Eliminar"
                          >
                            <i class="fas fa-ban"></i>
                          </a>
                        <!-- </div> -->
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td>{{cartValue | currency('$', 0, { thousandsSeparator: '.' })}}</td>
                      <td>{{cartTotal | currency('$', 0, { thousandsSeparator: '.' })}}</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button 
              :disabled="cartValue===0" 
              v-on:click="newSale" 
              class="col-lg-1 btn btn-success form-control"
            >
              <i class="fas fa-check"></i> Venta
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>
<script>
import { loadProgressBar } from 'axios-progress-bar'
import { mapState, mapActions, mapMutations } from 'vuex'
import SelectProduct from '../Product/Select'

export default {
  components: { SelectProduct },
  computed: { 
    ...mapState(['productForm', 'cartValue', 'cartTotal', 'cart']),
    ...mapActions(['newSale']),
    ...mapMutations(['addToCart', 'removeFromCart'])
  }
}
</script>

<style scoped>
.dropdown > li > a{
  font-size: 0.8rem;
}
</style>