<template>

    <!-- <form action="POST" v-on:submit.prevent="updateCantVehicle({ id: fillCantVehicle.id })"> -->
        <div id="editCantVehicle" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Detalle</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-sm text-white bg-dark">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="text-center">Puede crear</th>
                                            <th class="text-center">Creados</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Vehiculos</th>
                                            <td class="text-center">1 - {{ fillCantVehicle.cant_vehicle }}</td>
                                            <td class="text-center">{{ totalvehi }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <!-- <div class="form-group">
                            <input required
                                    type="number"
                                    name="cant_vehicle"
                                    class="form-control" v-model="fillCantVehicle.cant_vehicle">
                        </div> -->

                        <!-- <div class="form-group">
                            <label for="cant_vehicle">Vehiculos</label>
                            <select class="form-control" name="cant_vehicle" v-model="fillCantVehicle.cant_vehicle">
                                <option disabled value="0">Seleccione Cantidad</option>
                                <option value="10">10</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </div> -->
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div> -->
                </div>
            </div>
        </div>
    <!-- </form> -->

</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex';

export default {
    computed:{
        ...mapState(['totalvehi', 'fillCantVehicle', 'errorsLaravel']),
        ...mapGetters([])
    },
    methods:{
        ...mapActions(['getTotalVehi'])
    }
    
}
</script>
