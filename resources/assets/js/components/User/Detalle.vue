<template>
    <div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user"
                    role="tab" aria-controls="user" aria-selected="true">Datos Usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="company-tab" data-toggle="tab" href="#company"
                    role="tab" aria-controls="company" aria-selected="false">Datos Empresa</a>
            </li>
        </ul>
        <div class="tab-content bg-white" id="myTabContent">
            <div class="tab-pane fade show active pt-4 pb-4" id="user" role="tabpanel" aria-labelledby="user-tab">

                <div class="form-group row pl-3 pd-3">
                    <label for="nombre" class="col-2 col-form-label">Nombre</label>
                    <div class="col-6">
                        <input v-validate="'required'"
                            :class="{'input': true, 'is-invalid': errors.has('nombre') }"
                            type="text"
                            name="nombre"
                            class="form-control" v-model="fillUser.name">
                    </div>
                    <p v-show="errors.has('nombre')" class="text-danger">{{ errors.first('nombre') }}</p>
                </div>

                <div class="form-group row pl-3 pd-3">
                    <label for="email" class="col-2 col-form-label">Email</label>
                    <div class="col-6">
                        <input v-validate="'required'"
                            :class="{'input': true, 'is-invalid': errors.has('email') }"
                            type="text"
                            name="email"
                            class="form-control" v-model="fillUser.email">
                    </div>
                    <p v-show="errors.has('email')" class="text-danger">{{ errors.first('email') }}</p>
                </div>

                <!--<div class="form-group row pl-3 pd-3">
                    <label for="pass" class="col-2 col-form-label">Contraseña</label>
                    <div class="col-6">
                        <input v-validate="'required'"
                            :class="{'input': true, 'is-invalid': errors.has('pass') }"
                            type="password"
                            name="pass"
                            class="form-control" v-model="fillUser.pass">
                    </div>
                    <p v-show="errors.has('pass')" class="text-danger">{{ errors.first('pass') }}</p>
                </div>-->

                <!--<div class="form-group row pl-3 pd-3">
                    <label for="pass_2" class="col-2 col-form-label">Repetir Contraseña</label>
                    <div class="col-6">
                        <input v-validate="'required'"
                            :class="{'input': true, 'is-invalid': errors.has('pass_2') }"
                            type="password"
                            name="pass_2"
                            class="form-control" v-model="fillUser.pass_2">
                    </div>
                    <p v-show="errors.has('pass_2')" class="text-danger">{{ errors.first('pass_2') }}</p>
                </div>-->

                <div class="form-group row pl-3 pd-3">
                    <label for="logo" class="col-2 col-form-label">Logo Corporativo</label>
                    <div class="col-6">
                        <input v-validate="'required'"
                            :class="{'input': true, 'is-invalid': errors.has('logo') }"
                            type="text"
                            name="logo"
                            class="form-control" v-model="fillUser.logo">
                    </div>
                    <p v-show="errors.has('logo')" class="text-danger">{{ errors.first('logo') }}</p>
                </div>

                <div class="form-group row pl-3 pd-3">
                    <div class="col-12">
                        <a href="#" class="btn btn-warning"
                            @click="updateUserShow">
                            <i class="fas fa-edit"></i>
                            Editar
                        </a>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade p-4" id="company" role="tabpanel" aria-labelledby="company-tab">

                <div class="form-group row pl-3 pd-3">
                    <label for="rut" class="col-2 col-form-label">Rut</label>
                    <div class="col-6">
                        <input v-validate="'required'"
                            :class="{'input': true, 'is-invalid': errors.has('rut') }"
                            type="text"
                            name="rut"
                            class="form-control" v-model="newCompany.rut">
                    </div>
                    <p v-show="errors.has('rut')" class="text-danger">{{ errors.first('rut') }}</p>
                </div>

                <div class="form-group row pl-3 pd-3">
                    <label for="razon_social" class="col-2 col-form-label">Razón Social</label>
                    <div class="col-6">
                        <input v-validate="'required'"
                            :class="{'input': true, 'is-invalid': errors.has('razon_social') }"
                            type="text"
                            name="razon_social"
                            class="form-control" v-model="newCompany.razonSocial">
                    </div>
                    <p v-show="errors.has('razon_social')" class="text-danger">{{ errors.first('razon_social') }}</p>
                </div>

                <div class="form-group row pl-3 pd-3">
                    <label for="email" class="col-2 col-form-label">Email</label>
                    <div class="col-6">
                        <input v-validate="'required'"
                            :class="{'input': true, 'is-invalid': errors.has('email') }"
                            type="text"
                            name="email"
                            class="form-control" v-model="newCompany.email">
                    </div>
                    <p v-show="errors.has('email')" class="text-danger">{{ errors.first('email') }}</p>
                </div>

                <div class="form-group row pl-3 pd-3">
                    <label for="email" class="col-2 col-form-label">Dirección</label>
                    <div class="col-6">
                        <input v-validate="'required'"
                            :class="{'input': true, 'is-invalid': errors.has('email') }"
                            type="text"
                            name="email"
                            class="form-control" v-model="newCompany.email">
                    </div>
                    <p v-show="errors.has('email')" class="text-danger">{{ errors.first('email') }}</p>
                </div>

                <div class="form-group row pl-3 pd-3">
                    <label for="email" class="col-2 col-form-label">Comuna</label>
                    <div class="col-6">
                        <input v-validate="'required'"
                            :class="{'input': true, 'is-invalid': errors.has('email') }"
                            type="text"
                            name="email"
                            class="form-control" v-model="newCompany.email">
                    </div>
                    <p v-show="errors.has('email')" class="text-danger">{{ errors.first('email') }}</p>
                </div>

                <div class="form-group row pl-3 pd-3">
                    <label for="email" class="col-2 col-form-label">Giro</label>
                    <div class="col-6">
                        <input v-validate="'required'"
                            :class="{'input': true, 'is-invalid': errors.has('email') }"
                            type="text"
                            name="email"
                            class="form-control" v-model="newCompany.email">
                    </div>
                    <p v-show="errors.has('email')" class="text-danger">{{ errors.first('email') }}</p>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-plus-square"></i> Guardar
                    </button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>

import { loadProgressBar } from 'axios-progress-bar'
import { mapState, mapGetters, mapActions } from 'vuex';

export default {
    computed:{
        ...mapState(['fillUser', 'newCompany', 'fillCompany', 'errorsLaravel']),
        ...mapGetters([])
    },
    methods:{
        ...mapActions(['updateUserShow', 'updateCompany'])
    },
    created(){
        loadProgressBar()
        this.$store.dispatch('showUser')
    }
}
</script>

<style>

</style>
