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
                        <div class="form-group">
                            <label for="cliente">Proveedor</label>
                            <SelectProvider></SelectProvider>
                        </div>
                        <div class="form-group">
                            <label for="producto">Producto</label>
                            <SelectProduct></SelectProduct>
                        </div>
                        <div class="form-group">
                            <label for="codigo">Código</label>
                            <input required
                                    
                                    type="text"
                                    name="codigo"
                                    class="form-control" v-model="fillCode.codebar">
                        </div>
                        <div class="form-group">
                            <label for="atributo">Atributo</label>
                            <input required
                            type="number"
                            name="atributo"
                            class="form-control" v-model="fillCode.atributo">
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
import SelectProduct from './SelectProduct'
import SelectProvider from './SelectProvider'

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
