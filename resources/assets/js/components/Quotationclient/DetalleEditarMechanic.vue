<template>

    <form action="POST" v-on:submit.prevent="updateDetailclient({ id: fillDetailclient.id })">
        <div id="editDetailClientMechanic" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Editar Producto Cotización Formal</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <label for="producto">Producto</label>
                        <input v-validate="'min:2'"
                                :class="{'input': true, 'is-invalid': errors.has('producto') }"
                                type="text"
                                name="producto"
                                class="form-control" v-model="fillDetailclient.product">
                        <p v-show="errors.has('producto')" class="text-danger">{{ errors.first('producto') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.product }}</p>
                        </div>

                        <label for="precio">Precio</label>
                        <input v-validate="''"
                                :class="{'input': true, 'is-invalid': errors.has('precio') }"
                                type="number"
                                name="precio"
                                class="form-control" v-model="fillDetailclient.price"
                                @keyup="sumTotalEditProductMechanic">
                        <p v-show="errors.has('precio')" class="text-danger">{{ errors.first('precio') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.price }}</p>
                        </div>

                        <label for="dias">Días de Plazo</label>
                        <input v-validate="''"
                                :class="{'input': true, 'is-invalid': errors.has('dias') }"
                                type="text"
                                name="dias"
                                class="form-control" v-model="fillDetailclient.days">
                        <p v-show="errors.has('transporte')" class="text-danger">{{ errors.first('dias') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.days }}</p>
                        </div>

                        <label for="total_neto">Total neto</label>
                        <input v-validate="''"
                                :class="{'input': true, 'is-invalid': errors.has('total_neto') }"
                                type="number"
                                name="total_neto"
                                class="form-control" v-model="fillDetailclient.total" disabled>
                        <p v-show="errors.has('total_neto')" class="text-danger">{{ errors.first('total_neto') }}</p>

                        <label for="total_IVA">Total + IVA</label>
                        <input v-validate="''"
                                :class="{'input': true, 'is-invalid': errors.has('total_IVA') }"
                                type="number"
                                name="total_IVA"
                                class="form-control" v-model="fillDetailclient.totalIVA" disabled>
                        <p v-show="errors.has('total_IVA')" class="text-danger">{{ errors.first('total_IVA') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.total }}</p>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex';

export default {
    computed:{
        ...mapState(['fillDetailclient', 'errorsLaravel']),
        ...mapGetters([])
    },
    methods:{
        ...mapActions(['updateDetailclient', 'sumTotalEditProductMechanic'])
    },
}
</script>
