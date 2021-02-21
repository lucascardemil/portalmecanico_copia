<template>
    <div class="container">
        <form action="POST" v-on:submit.prevent="createQuotationUserExpress">
            <div class="row">
                <h3>Formulario de Cotización Express</h3>
            </div>
            <div class="row">
                <p v-if="errorsLaravel.length">
                    <b class="text-danger">Por favor, corrija los siguientes errores:</b>
                    <ul v-for="(error) in errorsLaravel" class="text-danger" :key="error.key">
                        <li>
                            {{error.msg}}
                        </li>
                    </ul>
                </p>
            </div>
            <div class="row">
                <h4>Vehículo</h4>
                <div class="input-group input-group-icon">
                    <input v-validate="'required|min:6|max:60'" 
                        :class="{'input': true, 'is-invalid': errors.has('patente o chasis') }"
                        class="form-control"
                        type="text"
                        name="patente o chasis"
                        v-model="formCotizacionExpress.patentchasis" 
                        placeholder="Patente o Chasis *"/>
                    <div class="input-icon"><i class="fa fa-car"></i></div>
                    <p v-show="errors.has('patente o chasis')" class="text-danger">{{ errors.first('patente o chasis') }}</p>
                </div>
                <div class="row">
                    <div class="input-group">
                        <div><h4>Marca *</h4></div>
                        <BrandSelector></BrandSelector>
                    </div>
                    <div class="input-group">
                        <div><h4>Modelo *</h4></div>
                        <ModelSelector></ModelSelector>
                    </div>  
                    <div class="input-group">
                        <div><h4>Año *</h4></div>
                        <YearSelector></YearSelector>
                    </div>
                    <div class="input-group">
                        <div><h4>Motor *</h4></div>
                        <EngineSelector></EngineSelector>
                    </div>
                </div>
            </div>
            <div class="row">
                <h4>Repuestos a solicitar *</h4>
                <div class="input-group">
                    <textarea
                        :class="{'input': true, 'is-invalid': errors.has('repuestos a solicitar') }"
                        class="form-control"
                        v-validate="'required|min:6'" 
                        style="resize:none" 
                        name="repuestos a solicitar" 
                        id="description"
                        v-model="formCotizacionExpress.description"
                        placeholder="Repuestos..."
                        cols="30" 
                        rows="9">
                    </textarea>
                    <p v-show="errors.has('repuestos a solicitar')" class="text-danger">{{ errors.first('repuestos a solicitar') }}</p>
                </div>
            </div>
            <div class="row">
                <h4>(*): Campos Requeridos</h4>
            </div>
            <div class="row">
                <div class="input-group" style="text-align:center;">
                    <button 
                        type="submit"
                        class="btn btn-success"
                        @click="scrollToTop">
                        Enviar
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import { loadProgressBar } from 'axios-progress-bar'
import { mapState, mapActions, mapGetters } from 'vuex'
import BrandSelector from '../Quotationuser/BrandSelector'
import ModelSelector from '../Quotationuser/ModelSelector'
import YearSelector from '../Quotationuser/YearSelector'
import EngineSelector from '../Quotationuser/EngineSelector'

export default {
    components: { BrandSelector, ModelSelector, YearSelector, EngineSelector },
    computed:{
        ...mapState([
            'errorsLaravel','formCotizacionExpress'
        ])
    },
    methods:{
        ...mapActions([
            'createQuotationUserExpress'
        ]),
        scrollToTop() {
            window.scrollTo(0,0);
        }
    }
}
</script>