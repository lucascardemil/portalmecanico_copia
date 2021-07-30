export default { //methods
    /******************************* */
    /*************seccion de vehiculos***************** */
    getVehicles(context, data) {
        context.commit('getVehicles', data.page)
    },
    getVehiclesUser(context, data) {
        context.commit('getVehiclesUser', data.page)
    },
    createVehicle(context) {
        context.commit('createVehicle')
        setTimeout(function () {
            context.commit('getVehicles', 1)
        }, 1000)

    },
    createVehicleUser(context) {
        context.commit('createVehicle')
        setTimeout(function () {
            context.commit('getVehicles', 1)
        }, 1000)

    },
    editVehicle(context, data) {
        context.commit('editVehicle', data.vehicleLocal)
    },
    updateVehicle(context, data) {
        context.commit('updateVehicle', data.id)
        setTimeout(function () {
            context.commit('getClientVehicles', 1)
        }, 1000)
    },
    updateVehicleUser(context, data) {
        context.commit('updateVehicle', data.id)
        setTimeout(function () {
            context.commit('getVehicles', 1)
        }, 1000)
    },
    deleteVehicle(context, data) {
        context.commit('deleteVehicle', data.id)
        setTimeout(function () {
            context.commit('getVehicles', 1)
        }, 1000)
    },
    deleteVehicleUser(context, data) {
        context.commit('deleteVehicle', data.id)
        setTimeout(function () {
            context.commit('getVehicles', 1)
        }, 1000)
    },
    changePageVehicle(context, data) {
        context.commit('paginate', data.page)
        context.commit('getVehicles', data.page)
    },
    detailVehicle(context, data) {
        context.commit('detailVehicle', data.vehicleLocal)
        setTimeout(function () {
            context.commit('getDetails', data.vehicleLocal)
        }, 200)
    },
    modalDetailVehicle(context, data) {
        context.commit('modalDetailVehicle', data.vehicleLocal)
    },
    createDetailVehicle(context) {
        context.commit('createDetailVehicle')
    },
    createProductsPagos(context) {
        context.commit('createProductsPagos')
        setTimeout(function () {
            context.commit('getProducts', 1)
        }, 1000)
    },
    
    modalRequestParts(context, data) {
        context.commit('modalRequestParts', data.vehicleLocal)
    },
    requestPartsVehicle(context) {
        context.commit('requestPartsVehicle')
    },
    getDetails(context) {
        context.commit('getDetails')
    },
    getVehiculoTipos(context, data) {
        context.commit('getVehiculoTipos', data)
    },
    createVehiculoTipo(context) {
        context.commit('createVehiculoTipo')
        setTimeout(function () {
            context.commit('getVehiculoTipos', 1)
        }, 1000)

    },
    editVehiculoTipo(context, data) {
        context.commit('editVehiculoTipo', data.vehiculoTipoLocal)
    },
    updateVehiculoTipo(context, data) {
        context.commit('updateVehiculoTipo', data.id)
        setTimeout(function () {
            context.commit('getVehiculoTipos', 1)
        }, 1000)
    },
    changePageVehiculoTipo(context, data) {
        context.commit('paginate', data.page)
        context.commit('getVehiculoTipos', data.page)
    },
    getVehicleBrands(context, data) {
        context.commit('getVehicleBrands', data)
    },
    createVehicleBrand(context) {
        context.commit('createVehicleBrand')
        setTimeout(function () {
            context.commit('getVehicleBrands', 1)
        }, 1000)

    },
    editVehicleBrand(context, data) {
        context.commit('editVehicleBrand', data.vehiclebrandLocal)
    },
    updateVehicleBrand(context, data) {
        context.commit('updateVehicleBrand', data.id)
        setTimeout(function () {
            context.commit('getVehicleBrands', 1)
        }, 1000)
    },
    changePageVehicleBrand(context, data) {
        context.commit('paginate', data.page)
        context.commit('getVehicleBrands', data.page)
    },
    getVehicleModels(context, data) {
        context.commit('getVehicleModels', data.page)
    },
    createVehicleModel(context) {
        context.commit('createVehicleModel')
        setTimeout(function () {
            context.commit('getVehicleModels', 1)
        }, 1000)

    },
    editVehicleModel(context, data) {
        context.commit('editVehicleModel', data.vehiclemodelLocal)
    },
    updateVehicleModel(context, data) {
        context.commit('updateVehicleModel', data.id)
        setTimeout(function () {
            context.commit('getVehicleModels', 1)
        }, 1000)
    },
    changePageVehicleModel(context, data) {
        context.commit('paginate', data.page)
        context.commit('getVehicleModels', data.page)
    },

    createVehicleYear(context) {
        context.commit('createVehicleYear')
        setTimeout(function () {
            context.commit('getVehicleYears', 1)
        }, 1000)

    },
    editVehicleYear(context, data) {
        context.commit('editVehicleYear', data.vehicleyearLocal)
    },
    updateVehicleYear(context, data) {
        context.commit('updateVehicleYear', data.id)
        setTimeout(function () {
            context.commit('getVehicleYears', 1)
        }, 1000)
    },

    getVehicleYears(context, data) {
        context.commit('getVehicleYears', data.page)
    },

    changePageVehicleYear(context, data) {
        context.commit('paginate', data.page)
        context.commit('getVehicleYears', data.page)
    },

    createVehicleMotor(context, data) {
        context.commit('createVehicleMotor', data.id)
        setTimeout(function () {
            context.commit('getVehiculoMotors', 1)
        }, 1000)

    },
    editVehiculoMotor(context, data) {
        context.commit('editVehiculoMotor', data.vehiculoMotorLocal)
    },
    updateVehicleMotor(context, data) {
        context.commit('updateVehicleMotor', data.id)
        setTimeout(function () {
            context.commit('getVehiculoMotors', 1)
        }, 1000)
    },
    getVehiculoMotors(context, data) {
        context.commit('getVehiculoMotors', data)
    },

    changePageVehiculoMotor(context, data) {
        context.commit('paginate', data.page)
        context.commit('getVehiculoMotors', data.page)
    },
    /********************************** */
    fileChange(context, data) {
        context.commit('fileChange', data.evt)
    },
    onFileChange(context, data) {
        context.commit('onFileChange', data.evt)
    },
    getPhotos(context, data) {
        context.commit('getPhotos', data.id)
    },
    deleteImage(context, data) {
        context.commit('deleteImage', data.id)
        setTimeout(function () {
            context.commit('getPhotos', null)
        }, 1000)
    },
    /******************************** */
    /******************************** */
    /******************************* */
    /**********seccion de notas********** */
    getNotes(context, data) {
        context.commit('getNotes', data.page)
    },
    createNote(context) {
        context.commit('createNote')
        setTimeout(function () {
            context.commit('getNotes', 1)
        }, 1000)

    },
    editNote(context, data) {
        context.commit('editNote', data.noteLocal)
    },
    updateNote(context, data) {
        context.commit('updateNote', data.id)
        setTimeout(function () {
            context.commit('getNotes', 1)
        }, 1000)
    },
    deleteNote(context, data) {
        context.commit('deleteNote', data.id)
        setTimeout(function () {
            context.commit('getNotes', 1)
        }, 1000)
    },
    changePageNote(context, data) {
        context.commit('paginate', data.page)
        context.commit('getNotes', data.page)
    },
    /******************************** */
    /******************************** */
    /******************************* */
    /**********seccion de cotizaciones********** */
    getQuotations(context, data) {
        context.commit('getQuotations', data.page)
    },
    getQuotationDetails(context) {
        context.commit('getQuotationDetails')
    },
    createQuotation(context) {
        context.commit('createQuotation')
        setTimeout(function () {
            context.commit('getQuotations', 1)
        }, 1000)

    },
    editQuotation(context, data) {
        context.commit('editQuotation', data.quotationLocal)
    },
    updateQuotation(context, data) {
        context.commit('updateQuotation', data.id)
        setTimeout(function () {
            context.commit('getQuotations', 1)
        }, 1000)
    },
    deleteQuotation(context, data) {
        context.commit('deleteQuotation', data.id)
        setTimeout(function () {
            context.commit('getQuotations', 1)
        }, 1000)
    },
    pdfQuotation(context) {
        context.commit('pdfQuotation')
    },
    changePageQuotation(context, data) {
        context.commit('paginate', data.page)
        context.commit('getPendingQuotations', data.page)
    },
    /******************************** */
    /******************************* */
    /**********seccion de cotizaciones para clientes********** */
    getQuotationclients(context, data) {
        context.commit('getQuotationclients', data.page)
    },
    getQuotationclientsform(context, data) {
        context.commit('getQuotationclientsform', data.page)
    },

    getQuotationlinkenvio(context, data) {
        context.commit('getQuotationlinkenvio', data)
    },

    getQuotationShipping(context, data) {
        context.commit('getQuotationShipping', data)
    },
    
    createQuotationclient(context) {
        context.commit('createQuotationclient')
        setTimeout(function () {
            context.commit('getQuotationclients', 1)
        }, 1000)

    },
    editQuotationclient(context, data) {
        context.commit('editQuotationclient', data.quotationclient)
    },
    updateQuotationclient(context, data) {
        context.commit('updateQuotationclient', data.id)
        setTimeout(function () {
            context.commit('getQuotationclients', 1)
        }, 1000)
    },
    showModalDeleteQuotationclient(context, data) {
        context.commit('showModalDeleteQuotationclient', data.id)
    },
    showdeleteQuotationShipping(context, data) {
        context.commit('showdeleteQuotationShipping', data.id)
    },
    showQuotationShipping(context, data) {
        context.commit('showQuotationShipping', data.id)
    },
    deleteQuotationclient(context, data) {
        context.commit('deleteQuotationclient', data.id)
        setTimeout(function () {
            context.commit('getQuotationclients', 1)
        }, 1000)
    },
    deleteQuotationShipping(context, data) {
        context.commit('deleteQuotationShipping', data.id)
        setTimeout(function () {
            context.commit('getQuotationShipping', 1)
        }, 1000)
    },
    generarRecibo(context, data) {
        context.commit('generarRecibo' , data.id)
    },
    pdfQuotationclient(context) {
        context.commit('pdfQuotationclient')
    },
    pdfQuotationShipping(context, data) {
        context.commit('pdfQuotationShipping' , data.id)
    },
    pdfIvaQuotationclient(context) {
        context.commit('pdfIvaQuotationclient')
    },
    changePageQuotationclient(context, data) {
        context.commit('paginate', data.page)
        context.commit('getQuotationclients', data.page)
    },
    changePageQuotationclientForm(context, data) {
        context.commit('paginate', data.page)
        context.commit('getQuotationclientsform', data.page)
    },
    changePageSales(context, data) {
        context.commit('paginate', data.page)
        context.commit('allSalesCalendar', data.page)
    },
    /******************************** */
    /******************************* */
    /**********seccion de importaciones********** */
    getImports(context, data) {
        context.commit('getImports', data.page)
    },
    getImportDetails(context) {
        context.commit('getImportDetails')
    },
    getTotalImport(context) {
        context.commit('getTotalImport')
    },
    createImport(context) {
        context.commit('createImport')
        setTimeout(function () {
            context.commit('getImports', 1)
        }, 1000)

    },
    editImport(context, data) {
        context.commit('editImport', data.localImport)
    },
    updateImport(context, data) {
        context.commit('updateImport', data.id)
        setTimeout(function () {
            context.commit('getImports', 1)
        }, 1000)
    },
    showModalDeleteImport(context, data) {
        context.commit('showModalDeleteImport', data.id)
    },
    deleteImport(context, data) {
        context.commit('deleteImport', data.id)
        setTimeout(function () {
            context.commit('getImports', 1)
        }, 1000)
    },
    pdfImport(context) {
        context.commit('pdfimport')
    },
    excelImport(context, data) {
        context.commit('excelImport', data.id)
    },
    changePageImport(context, data) {
        context.commit('paginate', data.page)
        context.commit('getImports', data.page)
    },
    /******************************** */
    /******************************* */
    /******seccion de detalle****** */
    getQuotationforms(context) {
        context.commit('getQuotationforms')
    },
    showModalDetail(context, data) {
        context.commit('showModalDetail', data.id)
        context.commit('getQuotationforms')
    },
    showModalDetailMechanic(context, data) {
        context.commit('showModalDetailMechanic', data.id)
        context.commit('getQuotationforms')
    },
    showModalDetailUserMechanic(context, data) {
        context.commit('showModalDetailUserMechanic' , data.id)
    },
    createDetail(context) {
        context.commit('createDetail')
        setTimeout(function () {
            context.commit('getQuotationDetails')
        }, 1000)
    },
    editDetail(context, data) {
        context.commit('editQuotation', data.detailLocal)
    },
    updateDetail(context, data) {
        context.commit('updateDetail', data.id)
        setTimeout(function () {
            context.commit('getQuotationDetails')
        }, 1000)
    },
    deleteDetail(context, data) {
        context.commit('deleteDetail', data.id)
        setTimeout(function () {
            context.commit('getQuotationDetails')
        }, 1000)
    },
    /******************************** */
    /******************************* */
    /******seccion de detalle de un cliente****** */
    getQuotationclientDetails(context) {
        context.commit('getQuotationclientDetails')
    },
    showModalDetailclient(context, data) {
        context.commit('showModalDetailclient', data.id)
        setTimeout(function () {
            context.commit('getQuotationclientDetails')
        }, 500)
    },
    showModalDetailclientMechanic(context, data) {
        context.commit('showModalDetailclientMechanic', data.id)
        setTimeout(function () {
            context.commit('getQuotationclientDetails')
        }, 500)
    },
    createDetailclient(context) {
        context.commit('createDetailclient')
        setTimeout(function () {
            context.commit('getQuotationclientDetails')
        }, 1000)
    },
    editDetailclient(context, data) {
        context.commit('editDetailclient', data.detailLocal)
    },
    editDetailclientMechanic(context, data) {
        context.commit('editDetailclientMechanic', data.detailLocal)
    },
    updateDetailclient(context, data) {
        context.commit('updateDetailclient', data.id)
        setTimeout(function () {
            context.commit('getQuotationclientDetails')
        }, 1000)
    },
    deleteDetailclient(context, data) {
        context.commit('deleteDetailclient', data.id)
        setTimeout(function () {
            context.commit('getQuotationclientDetails')
        }, 1000)
    },
    /******************************************** */
    /********************************************* */
    /******seccion de detalle de una importación****** */
    showModalDetailimport(context, data) {
        context.commit('showModalDetailimport', data.id)
        setTimeout(function () {
            context.commit('getImportDetails')
        }, 1000)
        setTimeout(function () {
            context.commit('showImport')
        }, 1500)
    },
    createDetailimport(context) {
        context.commit('createDetailimport')
        setTimeout(function () {
            context.commit('getImportDetails')
            //context.commit('allProductsImport')
            context.commit('allProductimports')
        }, 1000)
        setTimeout(function () {
            context.commit('distributionImport')
        }, 3000)
        setTimeout(function () {
            context.commit('sumTotalImport')
        }, 4000)
        setTimeout(function () {
            context.commit('finishDetailimport')
        }, 5000)
    },
    editDetailimport(context, data) {
        context.commit('editDetailimport', data.detailLocal)
    },
    updateDetailimport(context, data) {
        context.commit('updateDetailimport', data.id)
        setTimeout(function () {
            context.commit('getImportDetails')
        }, 1000)
        setTimeout(function () {
            context.commit('distributionImport')
        }, 3000)
        setTimeout(function () {
            context.commit('sumTotalImport')
        }, 4000)
        setTimeout(function () {
            context.commit('finishDetailimport')
        }, 5000)
    },
    deleteDetailimport(context, data) {
        context.commit('deleteDetailimport', data.id)
        setTimeout(function () {
            context.commit('getImportDetails')
        }, 1000)
        setTimeout(function () {
            context.commit('distributionImport')
        }, 3000)
        setTimeout(function () {
            context.commit('sumTotalImport')
        }, 4000)
        setTimeout(function () {
            context.commit('finishDetailimport')
        }, 5000)
    },
    finishDetailimport(context) {
        context.commit('finishDetailimport')
    },
    /******************************************** */
    /********************************************* */
    /******seccion de detalle de una cotización de la importación****** */
    showQuotationimport(context, data) {
        context.commit('showQuotationimport', data.id)
        setTimeout(function () {
            context.commit('getImportDetails')
        }, 1000)
    },
    createQuotationimport(context, data) {
        context.commit('createQuotationimport', data.id)
    },
    /******************************** */
    /******************************** */
    /******************************* */
    /*************seccion de clientes***************** */
    getClients(context, data) {
        context.commit('getClients', data.page)
    },
    detailClient(context, data) {
        context.commit('detailClient', data.clientLocal)
    },
    createClient(context) {
        context.commit('createClient')
        setTimeout(function () {
            context.commit('getClients', 1)
        }, 500)

    },
    editClient(context, data) {
        context.commit('editClient', data.clientLocal)
    },
    updateClient(context, data) {
        context.commit('updateClient', data.id)
        setTimeout(function () {
            context.commit('getClients', 1)
        }, 500)
    },
    modalDeleteClient(context, data) {
        context.commit('modalDeleteClient', data.id)
    },
    deleteClient(context) {
        context.commit('deleteClient')
        setTimeout(function () {
            context.commit('getClients', 1)
        }, 500)
    },
    changePageClient(context, data) {
        context.commit('paginate', data.page)
        context.commit('getClients', data.page)
    },
    /******************************** */
    /******************************* */
    /*************seccion de productos***************** */

    createTipoPago(context) {
        context.commit('createTipoPago')
        context.commit('getTiposPagos')
    },
    getTiposPagos(context, data) {
        context.commit('getTiposPagos', data)
    },
    editTiposPagos(context, data) {
        context.commit('editTiposPagos', data.tipospagosLocal)
    },
    updateTiposPagos(context, data) {
        context.commit('updateTiposPagos', data.id)
        setTimeout(function () {
            context.commit('getTiposPagos')
        }, 500)
    },
    updateUtilidad(context, data) {
        context.commit('updateUtilidad', data.id)
        setTimeout(function () {
            context.commit('getTiposPagos')
            context.commit('getProducts', 1)
        }, 500)
    },
    getProducts(context, data) {
        context.commit('getProducts', data.page)
    },
    createProduct(context) {
        context.commit('createProduct')
        setTimeout(function () {
            context.commit('getCodes', 1)
            context.commit('getProducts', 1)
            context.commit('allProducts')
        }, 1000)

    },
    editProduct(context, data) {
        context.commit('editProduct', data.productLocal)
    },
    updateProduct(context, data) {
        context.commit('updateProduct', data.id)
        setTimeout(function () {
            context.commit('getProducts', 1)
        }, 500)
    },
    modalDeleteProduct(context, data) {
        context.commit('modalDeleteProduct', data.id)
    },
    deleteProduct(context) {
        context.commit('deleteProduct')
        setTimeout(function () {
            context.commit('getProducts', 1)
        }, 500)
    },
    changePageProduct(context, data) {
        context.commit('paginate', data.page)
        context.commit('getProducts', data.page)
    },
    /************************************************* */
    /************************************************* */
    /*************seccion de codigos***************** */
    getCodes(context, data) {
        context.commit('getCodes', data.page)
    },
    createCode(context) {
        context.commit('createCode')
        setTimeout(function () {
            context.commit('getCodes', 1)
        }, 500)
    },
    editCode(context, data) {
        context.commit('editCode', data.codeLocal)
    },
    updateCode(context, data) {
        context.commit('updateCode', data.id)
        setTimeout(function () {
            context.commit('getCodes', 1)
        }, 500)
    },
    modalDeleteCode(context, data) {
        context.commit('modalDeleteCode', data.id)
    },
    deleteCode(context) {
        context.commit('deleteCode')
        setTimeout(function () {
            context.commit('getCodes', 1)
        }, 500)
    },
    changePageCode(context, data) {
        context.commit('paginate', data.page)
        context.commit('getCodes', data.page)
    },
    getCodeInventories(context) {
        context.commit('getCodeInventories')
    },
    updateUtilidadDefect(context) {
        context.commit('updateUtilidadDefect')
        setTimeout(function () {
            context.commit('getCodes', 1)
        }, 500)
    },

    /************************************************* */
    /************************************************ */
    /*************seccion de inventariado************* */
    modalInventory(context, data) {
        context.commit('modalInventory', data.id)
        setTimeout(function () {
            context.commit('getCodeInventories')
        }, 1000)
    },
    createInventory(context) {
        context.commit('createInventory')
        setTimeout(function () {
            context.commit('getCodeInventories')
        }, 500)
    },
    modalDeleteInventory(context, data) {
        context.commit('modalDeleteInventory', data.id)
    },
    deleteInventory(context) {
        context.commit('deleteInventory')
        setTimeout(function () {
            context.commit('getCodeInventories')
        }, 500)
    },
    allInventories(context) {
        context.commit('allInventories')
    },
    /************************************************* */
    /************************************************* */
    /************************************************* */
    /*************seccion de usuarios***************** */
    getUsers(context, data) {
        context.commit('getUsers', data.page)
    },

    getRolesQuotation(context, data) {
        context.commit('getRolesQuotation', data)
    },


    showUser(context, data) {
        context.commit('showUser')
    },
    createUser(context) {
        context.commit('createUser')
        setTimeout(function () {
            context.commit('getUsers', 1)
            context.commit('getQuotationclientsform', 1)
        }, 500)

    },
    editUser(context, data) {
        context.commit('editUser', data.userLocal)
    },
    updateUserShow(context, data) {
        context.commit('updateUserShow', data.id)
        setTimeout(function () {
            context.commit('showUser')
        }, 500)
    },
    updateUser(context, data) {
        context.commit('updateUser', data.id)
        setTimeout(function () {
            context.commit('getUsers', 1)
        }, 500)
    },
    updateCantCliVehi(context, data) {
        context.commit('updateCantCliVehi', data.id)
        setTimeout(function () {
            context.commit('getUsers', 1)
        }, 500)
    },

    updateCantVehicle(context, data) {
        context.commit('updateCantVehicle', data.id)
        setTimeout(function () {
            context.commit('getMechanicClients', 1)
            context.commit('getTotalVehi')
            context.commit('getSumaVehi')
        }, 500)
    },
    updateMechanicClient(context, data) {
        context.commit('updateUser', data.id)
        setTimeout(function () {
            context.commit('getMechanicClients')
        }, 500)
    },
    modalDeleteUser(context, data) {
        context.commit('modalDeleteUser', data.id)
    },
    deleteUser(context) {
        context.commit('deleteUser')
        setTimeout(function () {
            context.commit('getUsers', 1)
        }, 500)
    },
    changePageUser(context, data) {
        context.commit('paginate', data.page)
        context.commit('getUsers', data.page)
    },
    /************************************************* */
    /************************************************* */
    /************************************************* */
    /*************seccion de empresas***************** */
    showCompany(context, data) {
        context.commit('showCompany')
    },
    createCompany(context) {
        context.commit('createCompany')
        setTimeout(function () {
            context.commit('showCompany')
        }, 1000)
    },
    editCompany(context, data) {
        context.commit('editCompany', data.userLocal)
    },
    updateCompany(context, data) {
        context.commit('updateCompany', data.id)
        setTimeout(function () {
            context.commit('showCompany')
        }, 1000)
    },
    modalDeleteCompany(context, data) {
        context.commit('modalDeleteCompany', data.id)
    },
    deleteCompany(context) {
        context.commit('deleteCompany')
        setTimeout(function () {
            context.commit('showCompany')
        }, 1000)
    },
    /******************************************* */
    /**************seccion de asignación de roles a usuarios */
    getRoles(context, data) {
        context.commit('getRoles', data.page)
    },
    createRole(context) {
        context.commit('createRole')
        context.commit('getRoles', 1)
    },
    editRole(context, data) {
        context.commit('editRole', data.roleLocal)
        context.commit('getAllPermissions')
    },
    updateRole(context, data) {
        context.commit('updateRole', data.id)
        context.commit('getRoles', 1)
    },
    updateProductsUtilidad(context, data) {
        context.commit('updateProductsUtilidad', data)
        context.commit('getProducts', 1)
    },
    deleteRole(context, data) {
        context.commit('deleteRole', data.id)
        context.commit('getRoles', 1)
    },
    getAllRoles(context) {
        context.commit('getAllRoles')
    },
    getAllPermissions(context) {
        context.commit('getAllPermissions')
    },
    // getUserRoles(context, data) {
    //     context.commit('getUserRoles', data.id)
    // },

    editCantCliVehi(context, data) {
        context.commit('editCantCliVehi', data.userLocal)
        //context.commit('getTotalCliAdmin', data.userLocal)
        context.commit('getTotalVehiAdmin', data.userLocal)
    },
    editCantVehicle(context, data) {
        context.commit('editCantVehicle', data.userLocal)
    },
    editarUtilidad(context, data) {
        context.commit('editarUtilidad', data.productLocal)
    },
    editUserRoles(context, data) {
        context.commit('editUserRoles', data.userLocal)
    },
    updateUserRoles(context, data) {
        context.commit('updateUserRoles', data.id)
        context.commit('getUsers', 1)
    },
    updateQuotationShipping(context, data) {
        context.commit('updateQuotationShipping', data.id)
        setTimeout(function () {
            context.commit('getQuotationShipping', 1)
        }, 1000)
    },
    /************ Sección de consultar para los selects************* */
    setPagos(context, data) {
        context.commit('setPagos', data)
    },
    allPagos(context) {
        context.commit('allPagos')
    },
    utilidadDefect(context) {
        context.commit('utilidadDefect')
    },
    allUsers(context) {
        context.commit('allUsers')
    },
    setUser(context, data) {
        context.commit('setUser', data)
    },
    allClients(context, data) {
        setTimeout(function () {
            context.commit('allClients', data.type)
        }, 500)
    },
    setClient(context, data) {
        context.commit('setClient', data)
    },
    allVehicleBrands(context, data) {
        context.commit('allVehicleBrands', data)
    },
    allTiposVehiculos(context, data) {
        context.commit('allTiposVehiculos', data)
    },
    allVehicleMotors(context, data) {
        context.commit('allVehicleMotors', data)
    },
    allVehicleYears(context, data) {
        context.commit('allVehicleYears', data)
    },
    setVehicleBrand(context, data) {
        context.commit('setVehicleBrand', data)
        context.commit('allVehicleModels', data)
    },
    allVehicleModels(context, data) {
        context.commit('allVehicleModels', data)
    },
    setVehicleModel(context, data) {
        context.commit('setVehicleModel', data)
    },
    setVehiculoTipo(context, data) {
        context.commit('setVehiculoTipo', data)
    },
    setVehicleMotor(context, data) {
        context.commit('setVehicleMotor', data)
    },
    setVehicleYear(context, data) {
        context.commit('setVehicleYear', data)
    },
    /*************SELECT RELACIONADOS ****************/
    allVBR(context, data) {
        context.commit('allVBR', data)
    },
    setVBR(context, data) {
        context.commit('setVBR', data)
        context.commit('setVMR', {
            label: '',
            value: ''
        })
        context.commit('allVMR', data)
    },
    allVMR(context, data) {
        context.commit('allVMR', data)
    },
    setVMR(context, data) {
        context.commit('setVMR', data)
        context.commit('allVMR', data)
    },

    allMM(context, data) {
        context.commit('allMM', data)
    },
    setMM(context, data) {
        context.commit('setMM', data)
        context.commit('setYM', {
            label: '',
            value: ''
        })
        context.commit('allYM', data)
    },
    allYM(context, data) {
        context.commit('allYM', data)
    },
    setYM(context, data) {
        context.commit('setYM', data)
        context.commit('allYM', data)
    },
    /*************seccion formulario de cotizacion  ****************/

    setCiudad(context, data) {
        context.commit('setCiudad', data)
    },
    allCiudad(context, data) {
        context.commit('allCiudad', data)
    },
    allVBrands(context, data) {
        context.commit('allVBrands', data)
    },
    setVBrand(context, data) {
        context.commit('setVBrand', data)
        context.commit('setVModel', {
            label: '',
            value: ''
        })
        context.commit('setVYear', {
            label: '',
            value: ''
        })
        context.commit('setVEngine', {
            label: '',
            value: ''
        })
        context.commit('allVModels', data)
    },
    allVModels(context, data) {
        context.commit('allVModels', data)
    },
    setVModel(context, data) {
        context.commit('setVModel', data)
        context.commit('setVYear', {
            label: '',
            value: ''
        })
        context.commit('setVEngine', {
            label: '',
            value: ''
        })
        context.commit('allVYears', data)
    },
    allVYears(context, data) {
        context.commit('allVYears', data)
    },
    setVYear(context, data) {
        context.commit('setVYear', data)
        context.commit('setVEngine', {
            label: '',
            value: ''
        })
        context.commit('allVEngines', data)
    },
    allVEngines(context, data) {
        context.commit('allVEngines', data)
    },
    setVEngine(context, data) {
        context.commit('setVEngine', data)
    },
    createQuotationUser(context, data) {
        context.commit('createQuotationUser', data)
        /*         context.commit('setVBrand', {label:'', value:''})
                context.commit('setVModel', {label:'', value:''})
                context.commit('setVYear', {label:'', value:''})
                context.commit('setVEngine', {label:'', value:''}) 
                */

    },
    createQuotationEnvio(context, data) {
        context.commit('createQuotationEnvio', data)
    },

    createQuotationUserExpress(context, data) {
        context.commit('createQuotationUserExpress', data)
    },
    getPendingQuotations(context, data) {
        context.commit('getPendingQuotations', data)
    },
    /**************************************************************/
    allProducts(context) {
        context.commit('allProducts')
    },
    setProduct(context, data) {
        context.commit('setProduct', data)
        
        // context.commit('setCode', { label:'', value:'' })
        // context.commit('allCodes')
    },
    allProductsSale(context) {
        context.commit('allProductsSale')
    },
    setProductSale(context, data) {
        context.commit('setProductSale', data)
    },
    allProductimports(context) {
        context.commit('allProductimports')
    },
    setProductimport(context, data) {
        context.commit('setProductimport', data)
    },
    /*allProductsImport(context){
        context.commit('allProductsImport')
    },
    setProductImport(context, data){
        context.commit('setProductImport', data)
    },*/
    /******************************** */
    searchSii(context) {
        context.commit('searchSii')
    },
    sumTotalProductMechanic(context) {
        context.commit('sumTotalProductMechanic')
    },
    sumTotalEditProductMechanic(context) {
        context.commit('sumTotalEditProductMechanic')
    },
    sumTotalProduct(context) {
        context.commit('sumTotalProduct')
    },
    sumTotalProductSale(context) {
        context.commit('sumTotalProductSale')
    },
    sumTotalProductSale(context) {
        context.commit('sumTotalProductSale')
    },
    distributionImport(context) {
        context.commit('distributionImport')
        context.commit('sumTotalImport')
        setTimeout(function () {
            context.commit('finishDetailimport')
        }, 1500)
    },
    sumUtility(context) {
        context.commit('sumUtility')
        context.commit('sumTotalImport')
    },

    uploadBill(context, data) {
        context.commit('uploadBill', data.evt)
        context.commit('getCodes', {
            page: 1
        })
        context.commit('allInventories')
    },

    addToCart(context, data) {
        context.commit('addToCart', data)
    },

    setCode(context, data) {
        context.commit('setCode', data)
        context.commit('setPrice', {
            label: '',
            value: ''
        })
        context.commit('allPrices', data)
    },

    allCodes(context) {
        context.commit('allCodes')
    },

    allPrices(context) {
        context.commit('allPrices')
    },

    setPrice(context, data) {
        context.commit('setPrice', data)
    },
    updateUtility(context, data) {
        context.commit('updateUtility', data)
        context.commit('updateTotal')
    },
    updateQuantity(context, data) {
        context.commit('updateQuantity', data)
        context.commit('updateTotal')
    },
    updateTotal(context, data) {
        context.commit('updateTotal', data)
    },

    newSale(context, data) {
        context.commit('newSale', data)
        setTimeout(function () {
            context.commit('allSalesCalendar')
        }, 1000)
    },
    

    allSalesCalendar(context, data) {
        context.commit('allSalesCalendar', data.page)
        
    },

    cierreCajaZ(context) {
        context.commit('cierreCajaZ')
    },
    
    allSales(context, data) {
        context.commit('allSales', data.page)
    },

    calendar(context) {
        context.commit('calendar')
    },    

    searchCode(context) {
        context.commit('searchCode')
        setTimeout(function () {
            context.commit('updateCodeFields')
        }, 150)
    },

    updateCodeFields(context) {
        context.commit('updateCodeFields')
    },

    removeFromCart(context, data) {
        context.commit('removeFromCart', data)
    },

    getMechanicClients(context) {
        context.commit('getMechanicClients');
    },


    getTotalVehi(context) {
        context.commit('getTotalVehi');
    },

    getTotalCli(context) {
        context.commit('getTotalCli');
    },

    getSumaVehi(context) {
        context.commit('getSumaVehi');
    },

    getTotalCliAdmin(context) {
        context.commit('getTotalCliAdmin');
    },
    getTotalVehiAdmin(context) {
        context.commit('getTotalVehiAdmin');
    },

    createMechanicClient(context) {
        context.commit('createMechanicClient')
        setTimeout(function () {
            context.commit('getQuotationclients', 1)
        }, 500)
    },

    createMechanicClient2(context) {
        context.commit('createMechanicClient2')
        setTimeout(function () {
            context.commit('getMechanicClients')
            //context.commit('getTotalCli')
            //context.commit('getTotalVehi')
        }, 500)
    },

    getClientVehicles(context) {
        context.commit('getClientVehicles')
    },

    editVehicleMechanic(context) {
        context.commit('editVehicleMechanic', data.vehicleLocal)
    },

    updateVehicleMechanic(context, data) {
        context.commit('updateVehicle', data.id)
        setTimeout(function () {
            context.commit('getClientVehicles')
        }, 500)
    },

    setMechanicClient(context, data) {
        context.commit('setMechanicClient', data)
    },

    createVehicleMechanicClient(context) {
        context.commit('createVehicleMechanicClient')
        setTimeout(function () {
            context.commit('getClientVehicles')
        }, 1000)
    },

    updateVehicleMechanic(context) {
        context.commit('updateVehicleMechanic')
        setTimeout(function () {
            context.commit('getClientVehicles')
        }, 500)
    },

    getQuotationUsers(context, data) {
        context.commit('getQuotationUsers')
    },
    getQuotationUsersMechanic(context) {
        context.commit('getQuotationUsersMechanic')
    },
    modalCreateUserFromQuotation(context, data) {
        context.commit('modalCreateUserFromQuotation', data.id)
        context.commit('getQuotationUsers')
    },

    /******************************************************************PROCESO DE BOLETA*/
    juntarDatos(context) {
        context.commit('juntarDatos')
    },
    crearArreglo(context) {
        context.commit('crearArreglo')
    },
}
