<template>
    <div class="row">
        <div class="col-lg-12">
            
            <button type="submit" data-toggle="modal" data-target="#create" class="btn btn-success"><i class="fas fa-plus-circle"></i> Forma de Pagos</button>
            <button type="submit" data-toggle="modal" data-target="#createProducts" class="btn btn-success"><i class="fas fa-plus-circle"></i> Productos</button>
            <button type="submit" data-toggle="modal" data-target="#editProductsUtilidad" class="btn btn-warning"><i class="far fa-edit"></i> Editar Productos</button>

            <div class="table-responsive">
                <table class="table table-striped mt-3 table-sm text-white bg-dark">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Codigo</th>
                            <th>Forma de Pago</th>
                            <th>Utilidad</th>
                            <th></th>
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
                            <td></td>
                        </tr>

                        <tr v-for="productLocal in products" :key="productLocal.id">
                            <td width="10px">{{ productLocal.id }}</td>
                            <td>{{ productLocal.name }}</td>
                            <td v-if="productLocal.detail != null">{{ productLocal.detail }}</td>
                            <td v-else></td>
                            <td v-if="productLocal.productpagos != null">{{ productLocal.productpagos.forma_pago }}</td>
                            <td v-else></td>
                            <td v-if="productLocal.productpagos != null">{{ productLocal.productpagos.utilidad }}%</td>
                            <td v-else></td>
                            <td class="text-right">
                                <a href="#" class="btn btn-warning btn-sm"
                                    @click.prevent="editarUtilidad({ productLocal })"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    title="Editar">
                                    <i class="far fa-edit"></i>
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
        </div>
        <AgregarTiposPagos></AgregarTiposPagos>
        <AgregarProductos></AgregarProductos>
        <EditarUtilidad></EditarUtilidad>
        <EditProductsUtilidad></EditProductsUtilidad>
    </div>
</template>
<script>

import { loadProgressBar } from 'axios-progress-bar'
import { mapState, mapActions, mapGetters } from 'vuex'
import AgregarTiposPagos from './AgregarTiposPagos'
import AgregarProductos from './AgregarProductos'
import EditarUtilidad from './EditarUtilidad'
import EditProductsUtilidad from './EditProductsUtilidad'

export default {
    components: { AgregarTiposPagos, AgregarProductos, EditarUtilidad, EditProductsUtilidad },

    computed:{
        ...mapState(['products','searchProduct', 'pagination', 'offset' ]),
        ...mapGetters(['isActived', 'pagesNumber']),
    },
    methods:{
        ...mapActions(['getProducts', 'changePageProduct', 'editarUtilidad'])
    },
    created(){
        loadProgressBar();
        this.$store.dispatch('getProducts', { page: 1 })
        
    }
}
</script>

