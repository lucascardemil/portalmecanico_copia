<template>

    <div class="col-lg-12">

        <h5 class="text-white">
            Nueva Nota
            <a href="#" class="btn btn-success pull-right btn-sm" data-toggle="modal" data-target="#create"
                title="Agregar">
                <i class="fas fa-plus-circle"></i>
            </a>
        </h5>
        <div class="col-lg-12 table-responsive">
            <table class="table table-hover table-striped mt-3 table-sm text-white bg-dark">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Precio</th>
                        <th>Detalle</th>
                        <th>Fecha</th>
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <!--<tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <input type="text" class="form-control form-control-sm"
                                    v-model="searchVehicle.name" @keyup="getVehicles">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>-->

                    <tr v-for="noteLocal in notes" :key="noteLocal.id">
                        <td width="10px">{{ noteLocal.id }}</td>
                        <td>{{ noteLocal.price }}</td>
                        <td><pre class="text-white">{{ noteLocal.detail }}</pre></td>
                        <td>{{ noteLocal.created_at |  moment('DD/MM/YYYY') }}</td>

                        <td width="10px">
                            <a href="#" class="btn btn-warning btn-sm"
                                @click.prevent="editNote( { noteLocal } )"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Editar">
                                <i class="far fa-edit"></i>
                            </a>
                        </td>

                        <td width="10px">
                            <a href="#" class="btn btn-danger btn-sm"
                                @click.prevent="deleteNote( { id: noteLocal.id } )"
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

        <nav>
            <ul class="pagination">
                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link border-light bg-dark" href="#" @click.prevent="changePageNote({page: 1})">
                        <span>Primera</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link border-light bg-dark" href="#" @click.prevent="changePageNote({page: pagination.current_page - 1})">
                        <span>Atrás</span>
                    </a>
                </li>

                <li class="page-item" v-for="page in pagesNumber"
                    v-bind:class="[ page == isActived ? 'active' : '' ]" :key="page">
                    <a class="page-link border-light bg-dark" href="#" @click.prevent="changePageNote({page})">
                        {{ page }}
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link border-light bg-dark" href="#" @click.prevent="changePageNote({page: pagination.current_page + 1})">
                        <span>Siguiente</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link border-light bg-dark" href="#"  @click.prevent="changePageNote({page:pagination.last_page})">
                        <span>Última</span>
                    </a>
                </li>
            </ul>
        </nav>

        <Agregar></Agregar>
        <Editar></Editar>

    </div>

</template>


<script>

import { loadProgressBar } from 'axios-progress-bar'
import Agregar from './Agregar'
import Editar from './Editar'
import { mapState, mapActions, mapGetters } from 'vuex'

export default {
    components: { Agregar, Editar },
    computed:{
        ...mapState(['notes', 'pagination', 'offset']),
        ...mapGetters(['isActived', 'pagesNumber'])
    },
    methods:{
        ...mapActions(['getNotes', 'editNote', 'deleteNote', 'changePageNote'])
    },
    created(){
        loadProgressBar();
        this.$store.dispatch('getNotes', { page: 1 })
    }
}

</script>

<style>

</style>
