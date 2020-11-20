export default { //computed propeties
    completeVehicleCreate(state, getters){
        return state.selectedVBrand.label !== '' &&
               state.selectedVModel.label !== '' &&
               state.selectedVYear.label !== '' &&
               state.selectedVEngine.label !== ''
    },
    completeDetailVehicleCreate(state, getters){
        return state.newDetailVehicle.km.length >= 1 &&
                state.newDetailVehicle.note.length >= 4
    },
    completeVehicleEdit(state, getters){
        return state.fillVehicle.name.length >= 4
    },
    isActived(state, getters){
        return state.pagination.current_page
    },
    pagesNumber(state, getters){
        if(!state.pagination.to){
            return [];
        }

        var from = state.pagination.current_page - state.offset
        if(from < 1){
            from = 1;
        }

        var to = from + (state.offset * 2);
        if(to >= state.pagination.last_page){
            to = state.pagination.last_page;
        }

        var pagesArray = [];
        while(from <= to){
            pagesArray.push(from);
            from++;
        }

        return pagesArray;
    },
    getVehicle(state, getters){
        return state.vehicle
    },
    getVehicleBrand(state, getters){
        return state.vehiclebrand
    },
    getVehiculoTipo(state, getters){
        return state.vehiculotipo
    },
    getVehicleModel(state, getters){
        return state.vehiclebrand
    },
    getUser(state, getters){
        return state.user
    },
    getClient(state, getters){
        return state.client
    },
    getProduct(state, getters){
        return state.product
    },
    /*******seccion de roles ************/
    /************************************ */
    completeRoleCreate(state, getters){
        return state.newRole.name.length >= 3
    },
    completeRoleEdit(state, getters){
        return state.fillRole.name.length >= 3
    },
}
