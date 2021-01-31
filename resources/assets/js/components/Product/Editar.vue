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

                        <label for="nombre">Nombre</label>
                        <input v-validate="'required|min:1'"
                                :class="{'input': true, 'is-invalid': errors.has('nombre_edit') }"
                                type="text"
                                name="nombre"
                                class="form-control" v-model="fillProduct.name">
                        <p v-show="errors.has('nombre_edit')" class="text-danger">{{ errors.first('nombre_edit') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.nombre_edit }}</p>
                        </div>

                        <label for="detalle">Detalle</label>
                        <input v-validate="'required|min:1'"
                                :class="{'input': true, 'is-invalid': errors.has('detalle_edit') }"
                                name="detalle"
                                class="form-control" v-model="fillProduct.detail">
                        <p v-show="errors.has('detalle_edit')" class="text-danger">{{ errors.first('detalle_edit') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.detalle_edit }}</p>
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
