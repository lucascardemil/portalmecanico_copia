<template>  
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-6 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Formulario de Envio</h5>
                        <hr>
                        <form action="POST" v-on:submit.prevent="createQuotationEnvio">
                            <div class="form-group">
                                <p v-if="errorsLaravel.length">
                                    <b class="text-danger pb-2">Por favor, corrija los siguientes errores:</b>
                                    <ul class="text-danger" >
                                        <li v-for="(error) in errorsLaravel" :key="error.key">
                                            {{error.msg}}
                                        </li>
                                    </ul>
                                </p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-light">Nombre*</label>
                                <input v-validate="'required|min:3|max:60'" 
                                        :class="{'input': true, 'is-invalid': errors.has('nombre')}"
                                        class="form-control"
                                        type="text"
                                        name="nombre"
                                        v-model="formQuotationShipping.nombre" />
                                <p v-show="errors.has('nombre')" class="text-danger">{{ errors.first('nombre') }}</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-light">RUT*</label>
                                <input v-validate="'required|min:3|max:60'" 
                                        :class="{'input': true, 'is-invalid': errors.has('rut')}"
                                        class="form-control"
                                        type="text"
                                        name="rut"
                                        v-model="formQuotationShipping.rut" />
                                <p v-show="errors.has('rut')" class="text-danger">{{ errors.first('rut') }}</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-light">Telefono*</label>
                                <input v-validate="'required|min:3|max:60'" 
                                        :class="{'input': true, 'is-invalid': errors.has('telefono')}"
                                        class="form-control"
                                        type="text"
                                        name="telefono"
                                        v-model="formQuotationShipping.telefono" />
                                <p v-show="errors.has('telefono')" class="text-danger">{{ errors.first('telefono') }}</p>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-light">Ciudad*</label>
                                <CiudadSelector></CiudadSelector>        
                            </div>
                            <div class="form-group">
                                <label class="font-weight-light">Sucursal</label>
                                <input
                                        class="form-control"
                                        type="text"
                                        name="sucursal"
                                        v-model="formQuotationShipping.sucursal" />
                                
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1" v-model="formQuotationShipping.envio">
                                <label class="form-check-label" for="exampleCheck1">Envió a domicilio</label>
                            </div>
                            <div class="form-group" :class="formQuotationShipping.envio === true ? 'd-block' : 'd-none'">
                                <small>Si requiere entrega a domicilio, debemos simular previamente el valor de la encomienda y el cliente
                                       transferirnos el monto para pagar el servicio, ya que los transportes no permiten entregas a domicilio por pagar.
                                </small>
                            </div>
                            <div class="form-group" :class="formQuotationShipping.envio === true ? 'd-block' : 'd-none'">
                                <label class="font-weight-light">Dirección</label>
                                <input v-validate="'required|min:3|max:60'" 
                                        :class="{'input': true, 'is-invalid': errors.has('direccion')}"
                                        class="form-control"
                                        type="text"
                                        name="direccion"
                                        v-model="formQuotationShipping.direccion" />
                                <p v-show="errors.has('direccion')" class="text-danger">{{ errors.first('direccion') }}</p>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { loadProgressBar } from 'axios-progress-bar'
import { mapState, mapActions, mapGetters } from 'vuex'
import CiudadSelector from './CiudadSelector'

export default {
    components: { CiudadSelector },
    computed:{
        ...mapState([
            'errorsLaravel','formQuotationShipping'
        ])
    },
    methods:{
        ...mapActions([
            'createQuotationEnvio'
        ])
    },
}
</script>