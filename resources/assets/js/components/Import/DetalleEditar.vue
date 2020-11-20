<template>

    <form action="POST" v-on:submit.prevent="updateDetailimport({ id: fillDetailimport.id })">
        <div id="editDetailImport" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Editar Producto de la Importación</h4>
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
                                class="form-control" v-model="fillDetailimport.product">
                        <p v-show="errors.has('producto')" class="text-danger">{{ errors.first('producto') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.product }}</p>
                        </div>

                        <label for="codigo">Código</label>
                        <input v-validate="''"
                                :class="{'input': true, 'is-invalid': errors.has('codigo') }"
                                type="text"
                                name="codigo"
                                class="form-control" v-model="fillDetailimport.detail">
                        <p v-show="errors.has('codigo')" class="text-danger">{{ errors.first('codigo') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.detail }}</p>
                        </div>

                        <label for="valor">Valor (clp)</label>
                        <input v-validate="''"
                                :class="{'input': true, 'is-invalid': errors.has('valor') }"
                                type="number"
                                step="0.01"
                                name="valor"
                                class="form-control" v-model="fillDetailimport.price">
                        <p v-show="errors.has('valor')" class="text-danger">{{ errors.first('valor') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.price }}</p>
                        </div>

                        <label for="cantidad">Cantidad</label>
                        <input v-validate="''"
                                :class="{'input': true, 'is-invalid': errors.has('cantidad') }"
                                type="number"
                                name="cantidad"
                                class="form-control" v-model="fillDetailimport.quantity">
                        <p v-show="errors.has('cantidad')" class="text-danger">{{ errors.first('cantidad') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.quantity }}</p>
                        </div>

                        <label for="adicional">Adicional (clp)</label>
                        <input v-validate="''"
                                :class="{'input': true, 'is-invalid': errors.has('adicional') }"
                                type="number"
                                step="0.01"
                                name="adicional"
                                class="form-control" v-model="fillDetailimport.aditional">
                        <p v-show="errors.has('adicional')" class="text-danger">{{ errors.first('adicional') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.aditional }}</p>
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
        ...mapState(['fillDetailimport', 'errorsLaravel']),
        ...mapGetters([])
    },
    methods:{
        ...mapActions(['updateDetailimport'])
    },
}
</script>
