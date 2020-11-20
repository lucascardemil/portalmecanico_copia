<template>
  <div class="">
    <div class="card text-xs">
      <div class="card-body p-3">
        <form action="POST" v-on:submit.prevent="searchCode">
          <div class="row">
            <div class="col-lg-3">
              <label for="product-name">Nombre</label>
              <input type="text" class="form-control" v-model.lazy="productForm.product">
            </div>
            <div class="col-lg-3">
              <label for="code">Código</label>
              <input id="code-code" type="text" class="form-control" @change="updateCodeFields" v-model="productForm.code">
            </div>
            <!-- <div class="col-lg-2">
              <label />
              <button :disabled="!productForm.code" type="submit" class="btn btn-success form-control">
                Buscar
              </button>
            </div> -->
            <div class="col-lg-2">
              <label for="price">Precio</label>
              <input id="code-price" class="form-control" type="number" v-model.lazy="productForm.price" disabled>
            </div>
            <div class="col-lg-2">
              <label for="utility">Utilidad (%)</label>
              <input id="code-utility" class="form-control" type="number" @change="updateCodeFields" v-model.lazy="productForm.utility" >
            </div>
            <div class="col-lg-2">
              <label for="quantity">Cantidad</label>
              <input id="code-quantity" class="form-control" type="number" min="1" :max="productForm.max_quantity"  @change="updateCodeFields" v-model.lazy="productForm.quantity">
            </div>
            <div class="col-lg-5">
              <label for="value">Valor Neto</label>
              <input id="code-value" class="form-control" type="number" v-model.lazy="productForm.value" disabled>
            </div>
            <div class="col-lg-5">
              <label for="total">Valor Total (Neto + IVA)</label>
              <input id="code-total" class="form-control" type="number" v-model.lazy="productForm.total" disabled>
            </div>
            <div class="col-lg-2 mt-2">
              <label />
              <button :disabled="!productForm.value" v-on:click="addToCartFromCode" class="btn btn-success form-control">
                Agregar
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import { mapState, mapGetters, mapActions } from 'vuex'
import SelectProduct from '../Product/Select'
export default {
    components: { SelectProduct },
    computed: { 
        ...mapState(['productForm'])    
    },
    methods: {
        ...mapActions(['searchCode', 'addToCartFromCode', 'updateCodeFields']),
        selectAll() {
            this.$refs.input.select();
        }
    }
}
</script>