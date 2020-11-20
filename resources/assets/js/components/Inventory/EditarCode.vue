<template>

    <form action="POST" v-on:submit.prevent="updateCode({ id: fillCode.id })">
        <div id="edit" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Editar Código</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <label for="cliente">Proveedor</label>
                        <SelectProvider></SelectProvider>

                        <label for="producto">Producto</label>
                        <SelectProduct></SelectProduct>

                        <label for="codigo">Código</label>
                        <input v-validate="'required|min:1'"
                                :class="{'input': true, 'is-invalid': errors.has('codigo') }"
                                type="text"
                                name="codigo"
                                class="form-control" v-model="fillCode.codebar">
                        <p v-show="errors.has('codigo')" class="text-danger">{{ errors.first('codigo') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.codebar }}</p>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex'
import SelectProduct from '../Product/Select'
import SelectProvider from '../Client/Select'

export default {
    components: { SelectProduct, SelectProvider },
    computed:{
        ...mapState(['fillCode', 'errorsLaravel'])
    },
    methods:{
        ...mapActions(['updateCode'])
    },
}
</script>
