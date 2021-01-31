<template>
    <div class="pl-0">
        <v-select
            :class="{'input': true, 'is-invalid': errors.has('cliente_product') }"
            name="cliente"
            placeholder="Seleccionar Cliente"
            @input="setClient"
            :options="optionsClient"
            :value="selectedClient"></v-select>
        <p v-show="errors.has('cliente_product')" class="text-danger">{{ errors.first('cliente_product') }}</p>
        <div v-for="(error, index) in errorsLaravel" class="text-danger" :key="index">
            <p>{{ error.cliente_product }}</p>
        </div>
    </div>
</template>

<script>

import { mapState, mapGetters, mapActions } from 'vuex'

export default {
    computed:{
        ...mapState(['optionsClient', 'selectedClient', 'errorsLaravel']),
        ...mapGetters(['getClient'])
    },
    methods:{
        ...mapActions(['setClient'])
    },
    created(){
        this.$store.dispatch('allClients', { type: 'Proveedor' })
    }
}
</script>

<style>

</style>
