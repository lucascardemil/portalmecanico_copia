<template>

    <div>

        <h3>Asignar Roles a Usuario</h3>

        <div class="table-responsive">
            <table class="table table-bordered table-striped mt-3 table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>
                            <input type="text" class="form-control form-control-sm"
                                    v-model="searchUser.rut" @keyup="getUsers">
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm"
                                    v-model="searchUser.name" @keyup="getUsers">
                        </td>
                        <td></td>
                    </tr>
                    <tr v-for="userLocal in users" :key="userLocal.id">
                        <td width="10px">{{ userLocal.id }}</td>
                        <td>{{ userLocal.rut }}</td>
                        <td>{{ userLocal.name }}</td>
                        <td>{{ userLocal.email }}</td>
                        <td>
                            <button class="btn btn-secondary btn-rounded btn-sm"
                                    @click.prevent="getUserRoles({id: userLocal.id})"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Agregar">
                                    <i class="fas fa-eye"></i>
                            </button>

                            <button class="btn btn-success btn-rounded btn-sm"
                                    @click.prevent="editUserRoles({userLocal})"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Editar">
                                    <i class="fas fa-user-plus"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <nav>
            <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link" href="#" @click.prevent="changePageUser({page: 1})">
                        <span>Primera</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link" href="#" @click.prevent="changePageUser({page: pagination.current_page - 1})">
                        <span>Atrás</span>
                    </a>
                </li>

                <li class="page-item" v-for="page in pagesNumber"
                    v-bind:class="[ page == isActived ? 'active' : '' ]" :key="page">
                    <a class="page-link" href="#" @click.prevent="changePageUser({page})">
                        {{ page }}
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link" href="#" @click.prevent="changePageUser({page: pagination.current_page + 1})">
                        <span>Siguiente</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link" href="#"  @click.prevent="changePageUser({page: pagination.last_page})">
                        <span>Última</span>
                    </a>
                </li>
            </ul>
        </nav>

        <ShowUserRoles></ShowUserRoles>
        <UpdateUserRoles></UpdateUserRoles>

    </div>

</template>


<script>

import { loadProgressBar } from 'axios-progress-bar'
import UpdateUserRoles from './UpdateUserRoles'
import ShowUserRoles from './ShowUserRoles'
import { mapState, mapActions, mapGetters } from 'vuex'

export default {
    components: { UpdateUserRoles, ShowUserRoles },
    computed:{
        ...mapState(['users', 'searchUser', 'pagination', 'offset']),
        ...mapGetters(['isActived', 'pagesNumber']),
    },
    methods:{
        ...mapActions(['getUsers', 'getUserRoles', 'editUserRoles', 'changePageUser'])
    },
    created(){
        loadProgressBar()
        this.$store.dispatch('getUsers', { page: 1 })
    },
}

</script>

<style>

</style>
