<template>

    <div class="col-lg-15">
            <div class="card">
                <div class="card-body">
                    <form action="POST" v-on:submit.prevent="addToCart">
                        <div class="row">
                            <div class="col-lg-2">
                                <label for="product">Producto</label>
                                <Select></Select>
                            </div>
                            <div class="col-lg-2">
                                <label for="code">Código</label>
                                <code-select></code-select>
                            </div>
                            <div class="col-lg-2">
                                <label for="price">Precio</label>
                                <price-select @change="updateTotal"></price-select>
                            </div>
                            <div class="col-lg-1">
                                <label for="utility">Utilidad (%)</label>
                                <input id="utility" class="form-control" type="number" @change="updateUtility" v-model="productForm.utility" >
                            </div>
                            <div class="col-lg-1">
                                <label for="quantity">Cantidad</label>
                                <input id="quantity" class="form-control" type="number" @change="updateQuantity" v-model="productForm.quantity">
                            </div>
                            <div class="col-lg-1">
                                <label for="value">Valor Neto</label>
                                <input id="value" class="form-control" type="number" v-model="productForm.value" disabled>
                            </div>
                            <div class="col-lg-1">
                                <label for="total">Valor Total</label>
                                <input id="total" class="form-control" type="number" v-model="productForm.total" disabled>
                            </div>
                            <div class="col-lg-2 mt-1">
                                <label></label>
                                <button type="submit" class="btn btn-success form-control">
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
import Select from '../Product/Select'
import CodeSelect from './CodeSelect'
import PriceSelect from './PriceSelect'

export default {
    components: { CodeSelect, PriceSelect, Select },
    computed: {
        ...mapState(['products', 'selectedProduct', 'selectedCode', 'selectedPrice', 'productForm'])
    },
    methods: {
        ...mapActions(['addToCart', 'updateUtility', 'updateQuantity', 'updateTotal']),
        // handlePrice( event ){
        //     this.form.price = selectedPrice.label
        //     this.handleTotal()
        // },
    }
}
</script>