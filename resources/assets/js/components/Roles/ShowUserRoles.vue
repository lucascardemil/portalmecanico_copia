<template>

<div id="showRoles" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6>Lista de Roles</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped mt-3 table-sm">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="userRolesLocal in userRoles" :key="userRolesLocal.id">
                                <td width="10px">{{ userRolesLocal.id }}</td>
                                <td>{{ userRolesLocal.name }}</td>
                                <td>{{ userRolesLocal.description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

</template>


<script>

import { loadProgressBar } from 'axios-progress-bar'
import { mapState, mapActions, mapGetters } from 'vuex'

export default {
    computed:{
        ...mapState(['userRoles']),
    },
    methods:{
    },
    created(){
        loadProgressBar()
        //this.$store.dispatch('getUserRoles')
    },
}

</script>

<style>

</style>
