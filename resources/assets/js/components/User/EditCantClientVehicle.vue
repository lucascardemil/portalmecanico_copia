<template>

    <form action="POST" v-on:submit.prevent="updateCantCliVehi({ id: fillCantCliVehi.id })">
        <div id="editCantCliVehi" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Editar clientes y vehiculos</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <div class="row">
                            <div class="col-12">
                                <table class="table table-striped table-sm text-white bg-dark">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="text-center">Crear</th>
                                            <th class="text-center">Ocupados</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="totalcliadminLocal in totalcliadmin" :key="totalcliadminLocal.id">
                                            <th>Clientes</th>
                                            <td class="text-center">{{ totalcliadminLocal }}</td>
                                            <td class="text-center">{{ cantCliVehiAdmin.cant_client - totalcliadminLocal }}</td>
                                            <td class="text-center">{{ cantCliVehiAdmin.cant_client }}</td>
                                        </tr>
                                        <tr v-for="totalvehiadminLocal in totalvehiadmin" :key="totalvehiadminLocal.id">
                                            <th>Vehiculos</th>
                                            <td class="text-center">{{ totalvehiadminLocal }}</td>
                                            <td class="text-center">{{ cantCliVehiAdmin.cant_vehicle - totalvehiadminLocal }}</td>
                                            <td class="text-center">{{ cantCliVehiAdmin.cant_vehicle }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
                        <div class="form-group" v-if="fillCantCliVehi.rol == 'mechanic' || fillCantCliVehi.rol == 'admin'">
                            <label for="cant_client">Clientes</label>
                            <select class="form-control" name="cant_client" v-model="fillCantCliVehi.cant_client">
                                <option disabled value="0">Seleccione Cantidad</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="30">30</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <!-- <input required
                                    type="number"
                                    name="cant_client"
                                    class="form-control" v-model="fillCantCliVehi.cant_client"> -->
                            
                        </div>
                        <!-- <div class="form-group">
                            <label for="cant_vehicle">Vehiculos</label>
                            <input required
                                    type="number"
                                    name="cant_vehicle"
                                    class="form-control" v-model="fillCantCliVehi.cant_vehicle">
                        </div> -->

                        <div class="form-group">
                            <label for="cant_vehicle">Vehiculos</label>
                            <select class="form-control" name="cant_vehicle" v-model="fillCantCliVehi.cant_vehicle">
                                <option disabled value="0">Seleccione Cantidad</option>
                                <option value="5">1 - 5</option>
                                <option value="10">1 - 10</option>
                                <option value="30">1 - 30</option>
                                <option value="50">1 - 50</option>
                                <option value="100">1 - 100</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer d-block">
                        <div class="row align-items-center">
                            <!-- <div class="col-6" v-for="totalvehiadminLocal in totalvehiadmin" :key="totalvehiadminLocal.id">
                                <h6>Vehiculos asignados: {{ cantCliVehiAdmin.cant_vehicle }}</h6>
                            </div> -->
                            <div class="col-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</template>

<script>
import { loadProgressBar } from 'axios-progress-bar'
import { mapState, mapGetters, mapActions } from 'vuex';

export default {
    computed:{
        ...mapState(['totalvehiadmin' ,'fillCantCliVehi', 'cantCliVehiAdmin', 'errorsLaravel']),
        //...mapState(['totalcliadmin', 'totalvehiadmin' ,'fillCantCliVehi', 'cantCliVehiAdmin', 'errorsLaravel']),
        ...mapGetters([])
    },
    methods:{
        ...mapActions(['getTotalVehiAdmin','updateCantCliVehi'])
        //...mapActions(['getTotalCliAdmin', 'getTotalVehiAdmin','updateCantCliVehi'])
    },
    
    
}
</script>
