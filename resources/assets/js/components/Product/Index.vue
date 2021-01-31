<template>

    <div class="col-lg-12">

        <h5 class="text-white">
            Nuevo Producto
        </h5>

        <div class="">
            <div id="accordion">
                <div class="card">

                    <div class="card-header p-0" id="headingOne">
                    <h5 class="mb-0">
                        <button id="btn-product-card" class="btn btn-block text-left p-3" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                        Nuevo Producto
                        <span class="text-right"><i class="fas fa-arrows-alt-v"></i></span>
                        </button>
                    </h5>
                    </div>

                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form action="POST" v-on:submit.prevent="createProduct">
                                <div class="row">

                                    <div class="col-lg-5">
                                        <label for="nombre">*Nombre</label>
                                        <input v-validate="'min:4|max:190'"
                                                :class="{'input': true, 'is-invalid': errors.has('nombre_product') }"
                                                type="text"
                                                name="nombre"
                                                class="form-control" v-model="newProduct.name">
                                        <p v-show="errors.has('nombre_product')" class="text-danger">{{ errors.first('nombre_product') }}</p>

                                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                                            <p>{{ error.nombre_product }}</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <label for="detalle">*Detalle</label>
                                        <input v-validate="'max:190'"
                                                :class="{'input': true, 'is-invalid': errors.has('detalle_product') }"
                                                type="text"
                                                name="detalle"
                                                class="form-control" v-model="newProduct.detail">
                                        <p v-show="errors.has('detalle_product')"
                                            class="text-danger">{{ errors.first('detalle_product') }}</p>

                                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                                            <p>{{ error.detalle_product }}</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <label for="cliente">*Proveedor</label>
                                        <SelectProvider></SelectProvider>
                                    </div>

                                    <div class="col-lg-5">
                                        <label for="codigo">*Código</label>
                                        <input v-validate="'min:2|max:100'"
                                                :class="{'input': true, 'is-invalid': errors.has('codigo_product') }"
                                                type="text"
                                                name="codigo"
                                                class="form-control" v-model="newCode.codebar">
                                        <p v-show="errors.has('codigo_product')" class="text-danger">{{ errors.first('codigo_product') }}</p>

                                        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
                                            <p>{{ error.codigo_product }}</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-2 mt-2">
                                        <label></label>
                                        <button type="submit" class="btn btn-success form-control">
                                            <i class="fas fa-plus-square"></i> Guardar
                                        </button>
                                    </div>

                                </div>
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
                        <th>Producto</th>
                        <th>Detalle</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>
                            <input type="text" class="form-control form-control-sm"
                                    v-model="searchProduct.name" @keyup="getProducts">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>

                    <tr v-for="productLocal in products" :key="productLocal.id">
                        <td width="10px">{{ productLocal.id }}</td>
                        <td>{{ productLocal.name }}</td>
                        <td v-if="productLocal.detail != null">{{ productLocal.detail }}</td>
                        <td v-else>N/A</td>
                        <td>{{ productLocal.created_at |  moment('DD/MM/YYYY') }}</td>

                        <td width="100px">
                            <a href="#" class="btn btn-warning btn-sm"
                                @click.prevent="editProduct( { productLocal } )"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Editar">
                                <i class="far fa-edit"></i>
                            </a>

                            <a href="#" class="btn btn-danger btn-sm"
                                @click.prevent="modalDeleteProduct( { id: productLocal.id } )"
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
                    <a class="page-link border-light bg-dark" href="#"
                        @click.prevent="changePageProduct({page: 1})">
                        <span>Primera</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page > 1">
                    <a class="page-link border-light bg-dark" href="#"
                        @click.prevent="changePageProduct({page: pagination.current_page - 1})">
                        <span>Atrás</span>
                    </a>
                </li>

                <li class="page-item" v-for="page in pagesNumber"
                    v-bind:class="[ page == isActived ? 'active' : '' ]" :key="page">
                    <a class="page-link border-light bg-dark" href="#"
                        @click.prevent="changePageProduct({page})">
                        {{ page }}
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link border-light bg-dark" href="#"
                        @click.prevent="changePageProduct({page: pagination.current_page + 1})">
                        <span>Siguiente</span>
                    </a>
                </li>

                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                    <a class="page-link border-light bg-dark" href="#"
                        @click.prevent="changePageProduct({page:pagination.last_page})">
                        <span>Última</span>
                    </a>
                </li>
            </ul>
        </nav>

        <Editar></Editar>
        <Eliminar></Eliminar>

    </div>

</template>


<script>

import { loadProgressBar } from 'axios-progress-bar'
import Editar from './Editar'
import Eliminar from './Delete'
import SelectProvider from '../Provider/Select'
import { mapState, mapActions, mapGetters } from 'vuex'

export default {
    components: { Editar, Eliminar, SelectProvider },
    computed:{
        ...mapState(['products', 'newProduct', 'searchProduct', 'newCode', 'pagination', 'offset', 'errorsLaravel']),
        ...mapGetters(['isActived', 'pagesNumber'])
    },
    methods:{
        ...mapActions(['getProducts', 'createProduct', 'editProduct', 'modalDeleteProduct', 'changePageProduct'])
    },
    created(){
        loadProgressBar();
        this.$store.dispatch('getProducts', { page: 1 })
    }
}

</script>

<style>

</style>
