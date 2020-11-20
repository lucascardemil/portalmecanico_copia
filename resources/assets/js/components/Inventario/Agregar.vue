<template>
    <form action="POST" v-on:submit.prevent="submitFile()">
        <div id="create" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Ingresar Factura</h4>                    
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Subir Factura</label>
                            <input id="file" type="file" ref="file" class="form-control" accept="application/pdf"
                                v-on:change="handleFileUpload()"
                            >
                        </div>


                        <label></label>
                        <button type="submit" class="btn btn-success form-control">
                            <i class="fas fa-plus-square"></i> Guardar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>

import { mapState, mapGetters, mapActions } from 'vuex';
import SelectProduct from '../Product/Select'
import SelectProvider from '../Provider/Select'
import axios from 'axios'
import toastr from 'toastr'


export default {
    components: { SelectProduct, SelectProvider },
    computed: {
        ...mapState(['errorsLaravel'])
    },
    methods: { 
        ...mapActions(['uploadBill']),
        handleFileUpload(){
            this.file = this.$refs.file.files[0]
        },
        submitFile(){
            let $ = window.jQuery = require('jquery')
            let formData = new FormData()
            formData.append('file', this.file)

            axios.post('bill', formData, { headers: { 'Content-Type': 'multipart/form-data' } })
                .then(response => {
                    $('#create').modal('hide')
                    toastr.success('Factura ingresada con éxito!')
                    this.$store.dispatch('getCodes', { page: 1 })
                    this.$store.dispatch('allInventories')
                })
                .catch( error => {
                    $('#create').modal('hide')  
                    toastr.error("Error subiendo la factura, quizás ya la ingreso previamente o no se pudo leer el formato")
                })
        }
     },
     data() {
         return {
             file: ''
         }
     }
    
}
</script>