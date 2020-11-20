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
                                :class="{'input': true, 'is-invalid': errors.has('nombre') }"
                                type="text"
                                name="nombre"
                                class="form-control" v-model="fillProduct.name">
                        <p v-show="errors.has('nombre')" class="text-danger">{{ errors.first('nombre') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.name }}</p>
                        </div>

                        <label for="detalle">Detalle</label>
                        <input v-validate="'required|min:1'"
                                :class="{'input': true, 'is-invalid': errors.has('detalle') }"
                                name="detalle"
                                class="form-control" v-model="fillProduct.detail">
                        <p v-show="errors.has('detalle')" class="text-danger">{{ errors.first('detalle') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.detail }}</p>
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
