<template>
<div class="pl-0">
    <v-select
        name="code"
        placeholder="Seleccionar Código"
        @input="setCode"
        :disabled="selectedProduct.label==''"
        :options="optionsCode"
        :searchable="false"
        :value="selectedCode">
    </v-select>
</div>
    
</template>

<script>

import { mapState, mapGetters, mapActions } from 'vuex'

export default {

    computed: {
        ...mapState(['selectedProduct', 'selectedCode', 'optionsCode'])
    },
    methods: {
        ...mapActions(['setCode'])
    },
    created() {
        this.$store.dispatch('allCodes')
    },

    // data: function () {
    //     return {
    //         selected: '' || this.optionsCode[0]
    //     }
    // }
    
}
</script>