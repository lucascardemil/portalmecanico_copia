<template>

    <form>
        <div id="detail" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Detalle del Vehículo</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table class="table table-hover table-striped mt-3 table-sm bg-primary text-white">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kilometraje</th>
                                    <th>Nota</th>
                                    <th>Fecha</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="detailLocal in details" :key="detailLocal.id">
                                    <td width="10px">{{ detailLocal.id }}</td>
                                    <td>{{ detailLocal.km }}</td>
                                    <td>{{ detailLocal.note }}</td>
                                    <td>{{ detailLocal.created_at |  moment('DD/MM/YYYY') }}</td>
                                    <td width="10px">
                                        <a href="#" class="btn btn-info btn-sm"
                                            @click.prevent="getPhotos( { id: detailLocal.id } )"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Detalle">
                                            <i class="fas fa-camera-retro"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </form>

</template>

<script>

import { loadProgressBar } from 'axios-progress-bar'
import { mapState, mapActions, mapGetters } from 'vuex'

export default {
    components: { },
    computed:{
        ...mapState(['details']),
        ...mapGetters([])
    },
    methods:{
        ...mapActions(['getDetails', 'getPhotos'])
    },
    created(){
        loadProgressBar();
        //this.$store.dispatch('getDetails', { page: 1 })
    }
}

</script>

<style>

</style>

