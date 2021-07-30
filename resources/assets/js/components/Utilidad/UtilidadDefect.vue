<template>
    <div>

        <input required
                type="number"
                name="utilidad"
                class="form-control" v-model="newUtilidad.utilidad">
    </div>
</template>

<script>

import { mapState, mapGetters, mapActions } from 'vuex'

export default {
    computed:{
        ...mapState(['newUtilidad'])
    },
    created(){
        this.$store.dispatch('utilidadDefect')
    }
}
</script>
