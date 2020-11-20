<template>
<v-select
    name="price"
    placeholder="Seleccionar Precio"
    @input="setPrice"
    :disabled="selectedCode.label==''"
    :options="optionsPrice"
    :searchable="false"
    :value="selectedPrice">
</v-select>
</template>

<script>

import { mapState, mapGetters, mapActions } from 'vuex'

export default {
    computed: {
        ...mapState(['selectedCode','optionsPrice', 'selectedPrice'])
    },
    methods: {
        ...mapActions(['setPrice'])
    },
    created() {
        this.$store.dispatch('allPrices')
    }
}
</script>