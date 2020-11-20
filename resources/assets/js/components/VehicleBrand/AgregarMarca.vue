<template>

    <form action="POST" v-on:submit.prevent="createVehicleBrand">
        <div id="createBrand" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Nueva Marca</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <label for="marca">Marca</label>
                        <input v-validate="'required|min:2|max:190'"
                                :class="{'input': true, 'is-invalid': errors.has('marca') }"
                                type="text"
                                name="marca"
                                class="form-control" v-model="newVehicleBrand.brand">
                        <p v-show="errors.has('marca')" class="text-danger">{{ errors.first('marca') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.brand }}</p>
                        </div>

                        <label for="model">Modelo</label>
                        <input v-validate="'required|min:2|max:190'"
                                :class="{'input': true, 'is-invalid': errors.has('model') }"
                                type="text"
                                name="model"
                                class="form-control" v-model="newVehicleBrand.model">
                        <p v-show="errors.has('model')" class="text-danger">{{ errors.first('model') }}</p>

                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                            <p>{{ error.model }}</p>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus-square"></i> Guardar
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
        ...mapState(['newVehicleBrand', 'errorsLaravel'])
    },
    methods:{
        ...mapActions(['createVehicleBrand','editVehicleBrand'])
    },
}
</script>

