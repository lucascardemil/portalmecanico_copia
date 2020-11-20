<template>
    <v-select
        name="motor"
        placeholder="Seleccionar motor..."
        @input="setVEngine"
        :disabled="selectedVYear.label==''"
        :options="optionsVEngine"
        :searchable="false"
        :value="selectedVEngine">
    </v-select>
</template>

<script>
import { mapState, mapGetters, mapActions } from 'vuex'

export default {
    computed: { 
        ...mapState(['errorsLaravel', 'optionsVEngine', 'selectedVEngine', 'selectedVYear'])
    },
    methods: {
        ...mapActions(['setVEngine'])
    }
}
</script>