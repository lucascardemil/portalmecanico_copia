<template>

    <form action="POST" v-on:submit.prevent="updateProduct({ id: fillProduct.id })">
        <div id="edit" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Editar Nota</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">

                            <label for="nombre">Nombre</label>
                            <input required
                                    type="text"
                                    name="nombre"
                                    class="form-control" v-model="fillProduct.name">
                        </div>
                        <div class="form-group">
                            <label for="detalle">Detalle</label>
                            <input required
                                    name="detalle"
                                    class="form-control" v-model="fillProduct.detail">
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
        ...mapState(['fillProduct', 'errorsLaravel']),
        ...mapGetters([])
    },
    methods:{
        ...mapActions(['updateProduct'])
    },
}
</script>
