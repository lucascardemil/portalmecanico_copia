<template>

    <form action="POST" v-on:submit.prevent="">
        <div id="inventory" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Gestión de Inventario</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="">
                            <div id="accordion">
                                <div class="card">

                                    <div class="card-header p-0" id="headingOne">
                                    <h5 class="mb-0">
                                        <button id="btn-inventory-card" class="btn btn-block text-left p-3"
                                                data-toggle="collapse" data-target="#collapseOne"
                                            aria-expanded="true" aria-controls="collapseOne">
                                            Nuevo Inventario
                                        <span class="text-right"><i class="fas fa-arrows-alt-v"></i></span>
                                        </button>
                                    </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <form action="POST" v-on:submit.prevent="createInventory">
                                                <label for="precio">Precio</label>
                                                <input v-validate="'min:1|max:20'"
                                                        :class="{'input': true, 'is-invalid': errors.has('precio') }"
                                                        type="number"
                                                        name="codigo"
                                                        class="form-control" v-model="newInventory.price">
                                                <p v-show="errors.has('precio')" class="text-danger">{{ errors.first('precio') }}</p>

                                                <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                                                    <p>{{ error.price }}</p>
                                                </div>

                                                <label for="cantidad">Cantidad</label>
                                                <input v-validate="'min:1|max:20'"
                                                        :class="{'input': true, 'is-invalid': errors.has('cantidad') }"
                                                        type="number"
                                                        name="cantidad"
                                                        class="form-control" v-model="newInventory.quantity">
                                                <p v-show="errors.has('cantidad')" class="text-danger">{{ errors.first('cantidad') }}</p>

                                                <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                                                    <p>{{ error.quantity }}</p>
                                                </div>

                                                <label></label>
                                                <button type="submit" class="btn btn-success form-control">
                                                    <i class="fas fa-plus-square"></i> Guardar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-striped mt-3 table-sm text-white bg-dark">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        <!--th>Fecha</-->
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr v-for="inventoryLocal in inventories" :key="inventoryLocal.id">
                                        <td width="30px">{{ inventoryLocal.id }}</td>
                                        <td>{{ inventoryLocal.price }}</td>
                                        <td>{{ inventoryLocal.quantity }}</td>
                                        <td>{{ inventoryLocal.total }}</td>
                                        <!--td>{{ inventoryLocal.created_at |  moment('DD/MM/YYYY') }}</-->

                                        <td width="100px">
                                            <a href="#" class="btn btn-danger btn-sm"
                                                @click.prevent="modalDeleteInventory( { id: inventoryLocal.id } )"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Eliminar">
                                                <i class="fas fa-ban"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!--<pre>
                            {{ inventories || JSON }}
                        </pre>-->
                        <h4>
                            Total: {{ totalInventory | currency('', 0, { thousandsSeparator: '.' })  }}
                        </h4>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </form>

</template>

<script>
import { loadProgressBar } from 'axios-progress-bar'
import { mapState, mapGetters, mapActions } from 'vuex'

export default {
    computed:{
        ...mapState(['inventories', 'newInventory', 'errorsLaravel', 'totalInventory']),
        ...mapGetters([])
    },
    methods:{
        ...mapActions(['getCodeInventories', 'createInventory', 'modalDeleteInventory'])
    },
    created(){
    }
}
</script>
