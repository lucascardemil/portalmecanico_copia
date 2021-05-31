<template>

    <form action="POST" v-on:submit.prevent="updateCantVehicle({ id: fillCantVehicle.id })">
        <div id="editCantVehicle" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Cantidad de Vehiculos</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <div class="form-group">
                            <input required
                                    type="number"
                                    name="cant_vehicle"
                                    class="form-control" v-model="fillCantVehicle.cant_vehicle">
                        </div> -->

                        <div class="form-group">
                            <label for="cant_vehicle">Vehiculos</label>
                            <select class="form-control" name="cant_vehicle" v-model="fillCantVehicle.cant_vehicle">
                                <option disabled value="0">Seleccione Cantidad</option>
                                <option value="10">10</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus"></i>
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
        ...mapState(['fillCantVehicle', 'errorsLaravel']),
        ...mapGetters([])
    },
    methods:{
        ...mapActions(['updateCantVehicle'])
    }
    
}
</script>
