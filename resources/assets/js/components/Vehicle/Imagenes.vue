<template>

    <form>
        <div id="photo" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Lista de Archivos</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 mb-2" v-for="imageLocal in images" :key="imageLocal.id">
                                <button class="btn btn-danger btn-lg btn-block"
                                    @click.prevent="deleteImage( { id: imageLocal.id } )">Eliminar Imagen
                                </button>
                                <div class="mt-2">
                                    <img :src="imageLocal.url" width="100%">
                                </div>
                            </div>

                            <div class="col-lg-12 col-sm-12 mb-2" v-for="(docLocal, index) in docs" :key="docLocal.id">
                                <a :href="docLocal.url" target="_blank">Documento {{ index + 1 }} </a>
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
import { mapState, mapActions, mapGetters } from 'vuex'

export default {
    components: { },
    computed:{
        ...mapState(['images', 'docs']),
        ...mapGetters([])
    },
    methods:{
        ...mapActions(['deleteImage', 'getPhotos'])
    },
    created(){
        loadProgressBar()
    }
}

</script>

<style>

</style>

