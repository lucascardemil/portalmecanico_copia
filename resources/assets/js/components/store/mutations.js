import axios from 'axios'
import toastr from 'toastr'
import printJS from 'print-js'

var $ = window.jQuery = require('jquery')

var urlUser = 'users'
var urlAllUser = 'users-all'
var urlRoles = 'roles'
var urlAllRoles = 'roles-all'
var urlUserRoles = 'usersRoles'
var urlAllPermissions = 'permissions'

var urlVehicle = 'vehicles'
var urlVehicleUser = 'vehicles-user'
var urlDetailVehicle = 'detailvehicles'
var urlUpload = 'upload'

var urlVehicleBrand = 'vehiclebrands'
var urlAllVehicleBrand = 'vehiclebrands-all'
var urlSelectVehiculoMarcas = 'select-marcas'

var urlVehiculoTipo = 'vehiculotipos'
var urlAllVehiculoTipo = 'vehiculotipos-all'
var urlSelectVehiculoTipo = 'select-tipos'

var urlVehicleModel = 'vehiclemodels'
var urlAllVehicleModel = 'vehiclemodels-all'


var urlVehicleYear = 'vehicleyears'

var urlVBrand = 'vbrands-all'
var urlVModel = 'vmodels-all'
var urlVYear = 'vyears-all'
var urlVEngine = 'vengines-all'

var urlCreateQuotationUser = 'quotationuser'
var urlPendingQuotations = 'pendingquotations'

var urlNote = 'notes'

var urlQuotation = 'quotations'
var urlQuotationDetails = 'quotation-details'
var urlQuotationclient = 'quotationclients'
var urlQuotationclientDetails = 'quotationclient-details'
var urlQuotationPdf = 'quotation-pdf'

var urlQuotationimport = 'quotationimports'
var urlQuotationimportPdf = 'quotationimport-pdf'

var urlDetail = 'details'
var urlDetailclient = 'detailclients'
var urlQuotationclientPdf = 'quotationclient-pdf'
var urlQuotationclientPdfIva = 'quotationclient-pdf-iva'

var urlImport = 'imports'
var urlImportDetails = 'import-details'
var urlDetailimport = 'detailimports'
var urlImportPdf = 'import-pdf'
var urlExportExcel = 'export-import'

var urlClient = 'clients'
var urlAllClient = 'clients-all'
var urlActivity = 'activities'

var urlProduct = 'products'
var urlAllProduct = 'products-all'

var urlProductimport = 'productimports'
var urlAllProductimport = 'productimports-all'

var urlCode = 'codes'
var urlCodeInventory = 'code-inventories'

var urlInventory = 'inventories'
var urlAllInventory = 'all-inventories'

var urlImages = 'images'

var urlUserId = 'user-id'
var urlCompany = 'companies'


export default { //used for changing the state
    /******************************* */
    /****** sección vehiculos **** */
    /******************************* */
    getVehicles(state, page) {
        var url = urlVehicle + '?page=' + page + '&patent=' + state.searchVehicle.patent + '&name=' + state.searchVehicle.name + '&year=' + state.searchVehicle.year
        axios.get(urlVehicle).then(response => {
            state.vehicles = response.data
            //state.vehicles = response.data.vehicles.data
            //state.pagination = response.data.pagination
        });
    },
    getVehiclesUser(state, page) {
        var url = urlVehicleUser + '?page=' + page
        axios.get(url).then(response => {
            state.vehicles = response.data.vehicles.data
            state.pagination = response.data.pagination
        });
    },
    getAllVehicles(state, page) {

    },
    createVehicle(state) {
        var id_user = null
        if (state.selectedUser != null) {
            id_user = state.selectedUser.value
        }
        var url = urlVehicle
        axios.post(url, {
            user_id: id_user,
            patent: state.newVehicle.patent,
            chasis: state.newVehicle.chasis,
            name: state.selectedVBrand.label + ' ' + state.selectedVModel.label,
            year: state.selectedVYear.label,
            // name: state.selectedVehicleBrand.label+' | '+state.selectedVehicleModel.label,
            // year: state.newVehicle.year,
            engine: state.selectedVEngine.label,
            color: state.newVehicle.color,
            km: state.newVehicle.km,
        }).then(response => {
            state.newVehicle.patent = ''
            state.newVehicle.chasis = ''
            // state.newVehicle.name = ''
            // state.newVehicle.year = ''
            state.newVehicle.color = ''
            state.newVehicle.km = ''
            state.errorsLaravel = []
            $('#create').modal('hide')
            toastr.success('Vehículo generado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editVehicle(state, vehicle) {
        state.fillVehicle.id = vehicle.id
        state.fillVehicle.user_id = vehicle.user_id
        state.selectedUser = {
            label: vehicle.user.name,
            value: vehicle.user_id
        }
        state.fillVehicle.patent = vehicle.patent
        state.fillVehicle.chasis = vehicle.chasis
        state.fillVehicle.name = vehicle.name
        state.fillVehicle.year = vehicle.year
        state.fillVehicle.color = vehicle.color
        state.fillVehicle.km = vehicle.km
        $("#edit").modal('show')
    },
    detailVehicle(state, vehicle) {
        state.details = []
        $("#detail").modal('show')
    },
    /***********************************
     * *******************************
     */
    modalRequestParts(state, vehicle) {
        // state.formCotizacion.name = vehicle.user.name
        // state.formCotizacion.email = vehicle.user.email
        // state.formCotizacion.phone = vehicle.user.phone
        state.formCotizacion.patentchasis = vehicle.patent + '/' + vehicle.chasis
        state.formCotizacion.brand = vehicle.name
        state.formCotizacion.model = ''
        state.formCotizacion.year = vehicle.year
        state.formCotizacion.engine = vehicle.engine

        $('#requestParts').modal('show')
    },

    requestPartsVehicle(state) {

        axios.post('quotation-mechanic', {
                patentchasis: state.formCotizacion.patentchasis.toUpperCase(),
                brand: state.formCotizacion.brand,
                model: state.formCotizacion.model,
                year: state.formCotizacion.year,
                engine: state.formCotizacion.engine,
                description: state.formCotizacion.description
            })
            .then(response => {
                $('#requestParts').modal('hide')
                toastr.success('Solicitud ingresada con éxito')
            })
            .catch(error => {
                toastr.success('No se pudo enviar la solicitud')
            })

        //formCotizacion: { name:'', email:'', phone:'', patentchasis:'', brand:'', model:'', year:'', engine:'', description:'' },


    },
    modalDetailVehicle(state, vehicle) {
        state.newDetailVehicle.vehicle_id = vehicle.id
        $("#createDetail").modal('show')
    },
    createDetailVehicle(state) {
        for (let i = 0; i < state.attachment.length; i++) {
            state.form.append('pics[]', state.attachment[i])
        }

        const config = {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }

        var url = urlDetailVehicle
        axios.post(url, {
            vehicle_id: state.newDetailVehicle.vehicle_id,
            km: state.newDetailVehicle.km,
            note: state.newDetailVehicle.note
        }).then(response => {
            state.newDetailVehicle.vehicle_id = ''
            state.newDetailVehicle.km = ''
            state.newDetailVehicle.note = ''
            state.details = []
            state.errorsLaravel = []

            var url2 = urlUpload
            $('#createDetail').modal('hide')
            toastr.success('Detalle del vehículo generado con éxito, subiendo imagen(es)')
            state.form.append('id', response.data)
            $("#files").val(null)
            if (state.attachment.length > 0) {
                axios.post(url2, state.form, config).then(response => {
                        toastr.success('Imagen(es) subida(s) con éxito')
                    })
                    .catch(response => {
                        //console.log(response)
                    })
            }

        }).catch(error => {
            state.errorsLaravel = error.response.data
        })

    },
    updateVehicle(state, id) {
        var url = urlVehicle + '/' + id
        axios.put(url, state.fillVehicle).then(response => {
            state.fillVehicle = {
                id: '',
                patent: '',
                chasis: '',
                name: '',
                year: '',
                color: '',
                km: ''
            }
            state.errorsLaravel = []
            $('#edit').modal('hide')
            toastr.success('Vehículo actualizado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    getDetails(state, detail) {
        var url = urlVehicle + '/' + detail.id
        axios.get(url).then(response => {
            state.details = response.data
            /*state.vehicleDetails = response.data
            state.vehicleDetails.forEach((detail) => {
                state.details = detail.detail_vehicles
            })*/
        })
    },
    fileChange(state, evt) {
        //console.log(e)
        //let selectedFile = e.target.files[0]
        state.form = new FormData()

        state.images = []
        state.attachment = []
        let selectedFiles = evt.target.files

        if (!selectedFiles.length) {
            return false
        }

        for (let i = 0; i < selectedFiles.length; i++) {
            state.attachment.push(selectedFiles[i])
        }
    },
    getPhotos(state, id) {
        if (id != null)
            state.idDetailvehicle = id
        var url = urlDetailVehicle + '/' + state.idDetailvehicle
        axios.get(url).then(response => {
            state.images = []
            state.docs = []
            state.records = response.data
            $('#detail').modal('hide')
            $('#photo').modal('show')
            state.records.forEach((record) => {
                var url = record.url
                if (url.includes(".jpeg") || url.includes(".jpg") || url.includes(".png"))
                    state.images.push(record)
                if (url.includes(".pdf") || url.includes(".doc") ||
                    url.includes(".docx") || url.includes(".docx") ||
                    url.includes(".xls") || url.includes(".xlsx"))
                    state.docs.push(record)
            })
            //state.vehicleDetails = response.data
            /*state.vehicleDetails.forEach((detail) => {
                state.details = detail.detail_vehicles
            })*/
        })
    },
    deleteImage(state, id) {
        var url = urlImages + '/' + id
        axios.delete(url).then(response => {
            toastr.success('Imagen eliminada con éxito')
        })
    },
    getVehiculoTipos(state, page_tipo) {
        var url = 'vehiculotipos-all?page=' + page_tipo
        axios.get(url).then(response => {
            state.vehiculotipos = response.data.vehiculotipos.data
            state.pagination_tipo = response.data.pagination_tipo
        })
    },
    createVehiculoTipo(state) {
        var url = 'newvehiculotipo'
        axios.post(url, {
            tipo_vehiculo: state.newVehiculoTipo.tipo_vehiculo.toUpperCase()
        }).then(response => {
            state.newVehiculoTipo = {
                tipo_vehiculo: ''
                },
                state.errorsLaravel = []
            $('#create').modal('hide')
            toastr.success('Tipo de vehiculo creado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editVehiculoTipo(state, vehiculotipo) {
        state.fillVehiculoTipo.id = vehiculotipo.id
        state.fillVehiculoTipo.tipo_vehiculo = vehiculotipo.tipo_vehiculo.toUpperCase()
        $("#edit_tipo").modal('show')
    },
    updateVehiculoTipo(state, id) {
        var url = urlVehiculoTipo + '/' + id
        axios.put(url, state.fillVehiculoTipo).then(response => {
            state.fillVehicle = {
                id: '',
                tipo_vehiculo: '',
            }
            state.errorsLaravel = []
            $('#edit_tipo').modal('hide')
            toastr.success('Tipo de vehiculo actualizada con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    getVehicleBrands(state, page) {
        var url = 'vehiclebrands-all?page=' + page
        axios.get(url).then(response => {
            state.vehiclebrands = response.data.vehiclebrands.data
            state.pagination_marca = response.data.pagination_marca
        })
    },
    createVehicleBrand(state) {
        var url = 'newvehiclebrand'
        axios.post(url, {
            brand: state.newVehicleBrand.brand.toUpperCase()
            //model: state.newVehicleBrand.model.toUpperCase(),
            //tipo_id: state.selectedVehiculoTipo.value
        }).then(response => {
            state.newVehicleBrand = {
                    brand: ''
                    //model: '',
                    //tipo_id: ''
                },
                state.errorsLaravel = []
            $('#create').modal('hide')
            toastr.success('Marca y Modelo generado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editVehicleBrand(state, vehiclebrand) {
        state.fillVehicleBrand.id = vehiclebrand.id
        state.fillVehicleBrand.brand = vehiclebrand.brand.toUpperCase()
        $("#edit").modal('show')
    },
    updateVehicleBrand(state, id) {
        var url = urlVehicleBrand + '/' + id
        axios.put(url, state.fillVehicleBrand).then(response => {
            state.fillVehicle = {
                id: '',
                brand: '',
                model: ''
            }
            state.errorsLaravel = []
            $('#edit').modal('hide')
            toastr.success('Marca actualizada con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    getVehicleModels(state, page) {
        var url = urlVehicleModel + '?page=' + page //+ '&model=' + state.searchVehicleBrand.model
        axios.get(url).then(response => {
            state.vehiclemodels = response.data.vehiclemodels.data
            state.pagination_modelo = response.data.pagination_modelo
        });
    },
    createVehicleModel(state) {
        var url = 'newvehiclemodelo'
        axios.post(url, {
            //brand_id: state.selectedVehicleBrand.value,
            model: state.newVehicleModelo.model.toUpperCase(),
            brand_id: state.selectedVehicleBrand.value,
            tipo_id: state.selectedVehiculoTipo.value
        }).then(response => {
            state.newVehicleModelo = {
                    model: '',
                    brand_id: '',
                    tipo_id: ''
                },
                state.errorsLaravel = []
            $('#create').modal('hide')
            toastr.success('Modelo generado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editVehicleModel(state, vehiclemodel) {
        state.optionsVehicleBrand.forEach(brand => {
            if (brand.label == vehiclemodel.brand) {
                state.selectedVehicleBrand = brand
            }
        })
        state.optionsTiposVehiculo.forEach(tipo_vehiculo => {
            if (tipo_vehiculo.label == vehiclemodel.tipo) {
                state.selectedVehiculoTipo = tipo_vehiculo
            }
        })
        state.fillVehicleModel.id = vehiclemodel.id
        state.fillVehicleModel.model = vehiclemodel.model.toUpperCase()
        $("#edit_modelo").modal('show')
    },
    updateVehicleModel(state, id) {
        var url = urlVehicleModel + '/' + id
        state.fillVehicleModel.brand_id = state.selectedVehicleBrand.value
        state.fillVehicleModel.tipo_id = state.selectedVehiculoTipo.value
        axios.put(url, state.fillVehicleModel).then(response => {
            state.fillVehicleModel = {
                    id: '',
                    model: '',
                    brand_id: '',
                    tipo_id: ''
                },
                state.errorsLaravel = []
            $('#edit_modelo').modal('hide')
            toastr.success('Modelo actualizado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },

    createVehicleYear(state) {
        var url = 'newvehicleyear'
        axios.post(url, {
            v_id: state.selectedVehicleModel.value,
            v_year: state.newVehicleYear.year.toUpperCase()
        }).then(response => {
            state.newVehicleYear = {
                v_id: '',
                v_year: ''
            },
            state.errorsLaravel = []
            $('#create').modal('hide')
            toastr.success('Modelo generado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editVehicleYear(state, vehicleyear) {
        state.optionsVehicleModel.forEach(model => {
            if (model.label == vehicleyear.model) {
                state.selectedVehicleModel = model
            }
        })
        state.fillVehicleYear.id = vehicleyear.id
        state.fillVehicleYear.v_year = vehicleyear.year
        $("#edit_year").modal('show')
    },
    updateVehicleYear(state, id) {
        var url = urlVehicleYear + '/' + id
        state.fillVehicleYear.model = state.selectedVehicleModel.value
        axios.put(url, state.fillVehicleYear).then(response => {
            state.fillVehicleYear = {
                id: '',
                v_year: '',
                model: ''
            },
                state.errorsLaravel = []
            $('#edit_year').modal('hide')
            toastr.success('Modelo actualizado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },

    getVehicleYears(state, page) {
        var url = 'vehicleyears-all?page=' + page
        axios.get(url).then(response => {
            state.vehicleyears = response.data.vehicleyears.data
            state.pagination_year = response.data.pagination_year
        });
    },

    createVehicleMotor(state, id) {
        var url = 'newvehiclemotor'
        axios.post(url, {
            v_engine: state.newVehicleMotor.v_engine.toUpperCase(),
            year_id: id
        }).then(response => {
            state.newVehicleMotor = {
                year_id: '',
                v_engine: ''
            },
            state.errorsLaravel = []
            $('#create').modal('hide')
            toastr.success('Motor agregado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },

    AgregarVehicleMotor(state, vehicleyear) {
        state.fillVehicleYear.id = vehicleyear.id
        $("#edit_motor").modal('show')
    },

    /******************************* */
    /****** sección notas **** */
    /******************************* */
    getNotes(state, page) {
        var url = urlNote + '?page=' + page
        axios.get(url).then(response => {
            state.notes = response.data.notes.data
            state.pagination = response.data.pagination
        });
    },
    createNote(state) {
        var url = urlNote
        axios.post(url, {
            price: state.newNote.price,
            detail: state.newNote.detail,
        }).then(response => {
            state.newNote.price = ''
            state.newNote.detail = ''
            state.errorsLaravel = []
            $('#create').modal('hide')
            toastr.success('Nota generada con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editNote(state, note) {
        state.fillNote.id = note.id
        state.fillNote.price = note.price
        state.fillNote.detail = note.detail
        $("#edit").modal('show')
    },
    updateNote(state, id) {
        var url = urlNote + '/' + id
        axios.put(url, state.fillNote).then(response => {
            state.fillNote = {
                id: '',
                price: '',
                detail: ''
            }
            state.errorsLaravel = []
            $('#edit').modal('hide')
            toastr.success('Nota actualizada con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    deleteNote(state, id) {
        var url = urlNote + '/' + id
        axios.delete(url).then(response => {
            toastr.success('Nota eliminada con éxito')
        })
    },
    /******************************* */
    /****** sección cotizaciones **** */
    /******************************* */
    getQuotations(state, page) {
        var url = urlQuotation + '?page=' + page
        axios.get(url).then(response => {
            state.quotations = response.data.quotations.data
            state.pagination = response.data.pagination
        });
    },
    getQuotationDetails(state) {
        var url = urlQuotationDetails + '/' + state.idQuotation
        axios.get(url).then(response => {
            state.details = response.data
            var total = 0
            state.details.forEach(detail => {
                total += parseInt(detail.price)
            })
            state.totalQuotation = total
            state.totalQuotationIVA = Math.round(total * 1.19)
        });
    },
    createQuotation(state) {
        var url = urlQuotation
        axios.post(url, {
            client: state.newQuotation.client,
            vehicle: state.newQuotation.vehicle,
            patent: state.newQuotation.patent,
            state: 'Pendiente',
        }).then(response => {
            state.newQuotation = {
                client: '',
                vehicle: '',
                patent: '',
                state: ''
            }
            state.errorsLaravel = []
            $('#create').modal('hide')
            $('#btn-quotation-card').click()
            toastr.success('Cotización generada con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editQuotation(state, quotation) {
        state.fillQuotation.id = quotation.id
        state.fillQuotation.client = quotation.client
        state.fillQuotation.vehicle = quotation.vehicle
        state.fillQuotation.patent = quotation.patent
        state.fillQuotation.state = quotation.state
        $("#edit").modal('show')
    },
    updateQuotation(state, id) {
        var url = urlQuotation + '/' + id
        axios.put(url, state.fillQuotation).then(response => {
            state.fillQuotation = {
                id: '',
                client: '',
                vehicle: '',
                patent: '',
                state: ''
            }
            state.errorsLaravel = []
            $('#edit').modal('hide')
            toastr.success('cotización actualizada con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    deleteQuotation(state, id) {
        var url = urlQuotation + '/' + id
        axios.delete(url).then(response => {
            toastr.success('cotización eliminada con éxito')
        })
    },
    pdfQuotation(state) {
        var url = urlQuotationPdf + '/' + state.idQuotation
        window.location.href = url;
    },
    /******************************* */
    /****** sección detalles **** */
    /******************************* */
    showModalDetail(state, id) {
        state.idQuotation = id
        $('#modalQuotation').modal('show')
    },
    createDetail(state) {
        var url = urlDetail
        var priceSet = state.newDetail.price
        priceSet = priceSet.replace('.', '')
        axios.post(url, {
            quotation_id: state.idQuotation,
            product: state.newDetail.product,
            price: priceSet,
        }).then(response => {
            state.newDetail = {
                quotation_id: '',
                detail: '',
                price: 1
            }
            state.errorsLaravel = []
            toastr.success('Detalle generado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editDetail(state, detail) {
        state.fillDetail.id = detail.id
        state.fillDetail.quotation_id = detail.quotation_id
        state.fillDetail.detail = detail.detail
        state.fillDetail.price = detail.price
        $("#edit").modal('show')
    },
    updateDetail(state, id) {
        var url = urlDetail + '/' + id
        axios.put(url, state.fillDetail).then(response => {
            state.fillDetail = {
                id: '',
                quotation_id: '',
                detail: '',
                price: ''
            }
            state.errorsLaravel = []
            $('#edit').modal('hide')
            toastr.success('Detalle actualizado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    deleteDetail(state, id) {
        var url = urlDetail + '/' + id
        axios.delete(url).then(response => {
            toastr.success('Detalle eliminado con éxito')
        })
    },
    /******************************* */
    /****** sección clientes **** */
    /******************************* */
    getClients(state, page) {
        var url = urlClient + '?page=' + page
        axios.get(url).then(response => {
            state.clients = response.data.clients.data
            state.pagination = response.data.pagination
        });
    },
    detailClient(state, client) {
        state.client.id = client.id
        state.client.name = client.name
        state.client.rut = client.rut
        state.client.razonSocial = client.razonSocial
        state.client.email = client.email
        state.client.phone = client.phone
        state.client.address = client.address
        state.client.comuna = client.comuna
        state.client.giro = client.giro
        state.client.type = client.type
        state.client.activities = client.activities
        $("#detail").modal('show')
    },
    createClient(state) {
        var url = urlClient
        axios.post(url, {
            user_id: state.newClient.type,
            name: state.newClient.name,
            rut: state.newClient.rut,
            razonSocial: state.newClient.razonSocial,
            email: state.newClient.email,
            phone: state.newClient.phone,
            address: state.newClient.address,
            comuna: state.newClient.comuna,
            giro: state.newClient.giro,
            type: state.newClient.type,
        }).then(response => {

            var url = urlActivity
            var idClient = response.data

            if (state.newClient.activity != null) {
                state.newClient.activity.forEach(actividad => {
                    axios.post(url, {
                        client_id: idClient,
                        name: actividad.actividadEconomica,
                    }).then(response => {
                        toastr.success('Giro Ingresado con éxito')
                    })
                })
            }

            state.newClient = {
                rut: '',
                razonSocial: '',
                email: '',
                phone: '',
                address: '',
                comuna: '',
                giro: '',
                type: '',
                activities: {}
            }
            state.errorsLaravel = []
            $('#create').modal('hide')
            $('#btn-client-card').click()
            toastr.success('Cliente generado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editClient(state, client) {
        state.fillClient.id = client.id
        state.fillClient.name = client.name
        state.fillClient.rut = client.rut
        state.fillClient.razonSocial = client.razonSocial
        state.fillClient.email = client.email
        state.fillClient.phone = client.phone
        state.fillClient.address = client.address
        state.fillClient.comuna = client.comuna
        state.fillClient.giro = client.giro
        state.fillClient.type = client.type
        $("#edit").modal('show')
    },
    updateClient(state, id) {
        var url = urlClient + '/' + id
        axios.put(url, state.fillClient).then(response => {
            state.fillUser = {
                id: '',
                name: '',
                rut: '',
                razonSocial: '',
                email: '',
                phone: '',
                address: '',
                comuna: '',
                type: '',
                activities: {}
            }
            state.errorsLaravel = []
            $('#edit').modal('hide')
            toastr.success('Cliente actualizado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    modalDeleteClient(state, id) {
        state.fillClient.id = id
        $('#deleteClient').modal('show')
    },
    deleteClient(state) {
        var url = urlClient + '/' + state.fillClient.id
        axios.delete(url).then(response => {
            toastr.success('cliente eliminado con éxito')
            $('#deleteClient').modal('hide')
        })
    },
    /******************************* */
    /****** sección cotizaciones clientes**** */
    /******************************* */
    getQuotationclients(state, page) {
        var day = state.searchQuotationClient.day
        var month = state.searchQuotationClient.month
        var year = state.searchQuotationClient.year

        var url = urlQuotationclient + '?page=' + page + '&id=' + state.searchQuotationClient.id + '&client=' + state.searchQuotationClient.client_text + '&day=' + day + '&month=' + month + '&year=' + year


        axios.get(url).then(response => {
            state.quotationclients = response.data.quotationclients.data
            state.pagination = response.data.pagination
        });
    },
    getQuotationclientDetails(state) {
        var url = urlQuotationclientDetails + '/' + state.idQuotationclient
        axios.get(url).then(response => {
            state.detailclients = response.data
            var totalUtilidad = 0
            var totalTransporte = 0
            var totalAdicional = 0
            var total = 0
            state.detailclients.forEach(detailclient => {
                //total += parseInt(detailclient.price) *
                /*state.newDetailclient.quotationclient_id = detailclient.quotationclient_id
                state.newDetailclient.product = detailclient.product
                state.newDetailclient.price = detailclient.price
                state.newDetailclient.quantity = detailclient.quantity
                state.newDetailclient.percentage = detailclient.percentage
                state.newDetailclient.aditional = detailclient.aditional
                state.newDetailclient.transport = detailclient.transport
                state.newDetailclient.utility = detailclient.utility
                state.newDetailclient.total = detailclient.total*/
                totalUtilidad += parseInt(detailclient.utility)
                totalTransporte += parseInt(detailclient.transport)
                totalAdicional += parseInt(detailclient.aditional)
                total += parseInt(detailclient.total)
            })
            state.totalUtilidad = totalUtilidad
            state.totalTransporte = totalTransporte
            state.totalAdicional = totalAdicional
            state.totalQuotationclient = total
            state.totalQuotationclientIVA = Math.round(parseInt(total * 1.19))
        });
    },
    createQuotationclient(state) {
        var url = urlQuotationclient
        axios.post(url, {
            client_id: state.selectedClient.value,
            state: 'Pendiente',
            payment: state.newQuotationclient.payment,
            client_text: state.newQuotationclient.client_text,
            vehicle: state.newQuotationclient.vehicle,
        }).then(response => {
            state.newQuotationclient = {
                client_id: '',
                state: '',
                payment: ''
            }
            state.errorsLaravel = []
            $('#create').modal('hide')
            $('#btn-quotation-card').click()
            toastr.success('Cotización formal generada con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editQuotationclient(state, quotationclient) {
        state.fillQuotationclient.id = quotationclient.id
        state.fillQuotationclient.client_id = quotationclient.client_id
        state.fillQuotationclient.state = quotationclient.state
        $("#edit").modal('show')
    },
    updateQuotationclient(state, id) {
        var url = urlQuotationclient + '/' + id
        axios.put(url, state.fillQuotationclient).then(response => {
            state.fillQuotation = {
                id: '',
                client_id: '',
                state: ''
            }
            state.errorsLaravel = []
            $('#edit').modal('hide')
            toastr.success('Cotización formal actualizada con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    showModalDeleteQuotationclient(state, id) {
        state.idQuotationclient = id
        $('#modalDeleteQuotationClient').modal('show')
    },
    deleteQuotationclient(state, id) {
        var url = urlQuotationclient + '/' + state.idQuotationclient
        axios.delete(url).then(response => {
            toastr.success('Cotización formal eliminada con éxito')
            $('#modalDeleteQuotationClient').modal('hide')
            state.idQuotationclient = null
        })
    },
    pdfQuotationclient(state) {
        var url = urlQuotationclientPdf + '/' + state.idQuotationclient
        window.location.href = url;
    },
    pdfIvaQuotationclient(state) {
        var url = urlQuotationclientPdfIva + '/' + state.idQuotationclient
        window.location.href = url;
    },
    /******************************* */
    /****** sección detalles de cotizaciones de clientes**** */
    /******************************* */
    showModalDetailclient(state, id) {
        state.idQuotationclient = id
        $('#modalQuotationclient').modal('show')
    },
    createDetailclient(state) {
        var url = urlDetailclient

        var priceSet = "" + state.newDetailclient.price
        priceSet = priceSet.split('.').join('')

        var aditionalSet = "" + state.newDetailclient.aditional
        aditionalSet = aditionalSet.split('.').join('')

        var transportSet = "" + state.newDetailclient.transport
        transportSet = transportSet.split('.').join('')

        axios.post(url, {
            quotationclient_id: state.idQuotationclient,
            product: state.newDetailclient.product,
            detail: state.newDetailclient.detail,
            days: state.newDetailclient.days,
            price: priceSet,
            quantity: state.newDetailclient.quantity,
            percentage: state.newDetailclient.percentage,
            aditional: aditionalSet,
            transport: transportSet,
            utility: state.newDetailclient.utility,
            total: state.newDetailclient.total,
        }).then(response => {
            state.selectedProduct = []
            state.newDetailclient = {
                quotationclient_id: '',
                product: '',
                price: 1,
                quantity: 1,
                percentage: 35,
                aditional: 0,
                transport: 0,
                utility: 0,
                total: 10
            }
            state.errorsLaravel = []
            toastr.success('Detalle generado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editDetailclient(state, detailclient) {
        state.fillDetailclient.id = detailclient.id
        state.fillDetailclient.quotationclient_id = detailclient.quotationclient_id
        state.fillDetailclient.product = detailclient.product
        state.fillDetailclient.detail = detailclient.detail
        state.fillDetailclient.price = detailclient.price
        state.fillDetailclient.quantity = detailclient.quantity
        state.fillDetailclient.percentage = detailclient.percentage
        state.fillDetailclient.aditional = detailclient.aditional
        state.fillDetailclient.transport = detailclient.transport
        state.fillDetailclient.utility = detailclient.utility
        state.fillDetailclient.total = detailclient.total
        state.fillDetailclient.totalIVA = Math.round(detailclient.total * 1.19)
        state.fillDetailclient.days = detailclient.days

        $("#editDetailClient").modal('show')
    },
    updateDetailclient(state, id) {
        var url = urlDetailclient + '/' + id
        //detailclient es similar a fillDetailclient pero sin el totalIva
        //  totalIva es utilizado para mostrarlo en la tabla solamente, mas no para insertarlo en la bd
        let detailclient = {
            id: state.fillDetailclient.id,
            quotationclient_id: state.fillDetailclient.quotationclient_id,
            product: state.fillDetailclient.product,
            detail: state.fillDetailclient.detail,
            price: state.fillDetailclient.price,
            quantity: state.fillDetailclient.quantity,
            percentage: state.fillDetailclient.percentage,
            aditional: state.fillDetailclient.aditional,
            transport: state.fillDetailclient.transport,
            utility: state.fillDetailclient.utility,
            total: state.fillDetailclient.total
        }
        axios.put(url, detailclient).then(response => {
            state.fillDetailclient = {
                id: '',
                quotationclient_id: '',
                product: '',
                detail: '',
                price: 1,
                quantity: 1,
                percentage: 35,
                aditional: 0,
                transport: 0,
                utility: 0,
                total: 1,
                totalIVA: 1.19
            }
            state.errorsLaravel = []
            $('#editDetailClient').modal('hide')
            toastr.success('Detalle actualizado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    deleteDetailclient(state, id) {
        var url = urlDetailclient + '/' + id
        axios.delete(url).then(response => {
            toastr.success('Detalle eliminado con éxito')
        })
    },
    /******************************* */
    /****** sección importaciones **** */
    /******************************* */
    getImports(state, page) {
        var url = urlImport + '?page=' + page
        axios.get(url).then(response => {
            state.imports = response.data.imports.data
            state.pagination = response.data.pagination
        });
    },
    getImportDetails(state) {
        var url = urlImportDetails + '/' + state.idImport
        axios.get(url).then(response => {
            state.detailimports = response.data
            var total = 0
            var price = 0
            var totalValue = 0
            var totalNacional = 0
            var totalInternacional = 0
            var totalNeto = 0
            var totalCosto = 0
            state.detailimports.forEach(detailimport => {
                totalValue += parseFloat(detailimport.total)
                totalNeto += parseFloat(detailimport.price)
                totalNacional += parseFloat(detailimport.nacional)
                totalInternacional += parseFloat(detailimport.internacional)
                totalCosto += parseFloat(detailimport.nacional) + parseFloat(detailimport.internacional)
                total += parseFloat(detailimport.utility)
                price += parseFloat(detailimport.price) * parseInt(detailimport.quantity)
            })
            state.totalPriceImport = price
            state.totalValue = totalValue
            state.totalNacional = totalNacional
            state.totalInternacional = totalInternacional
            state.totalNeto = totalNeto
            state.totalCosto = totalCosto
            state.totalImport = total
            state.totalImportIVA = Math.round(parseFloat(total * 1.19))


        });
    },
    getTotalImport(state) {
        var price = 0
        var total = 0

        state.detailimports.forEach(detailimport => {
            total += parseFloat(detailimport.utility)
            price += parseFloat(detailimport.price) * parseFloat(detailimport.quantity)
        })
        state.totalPriceImport = price
        state.totalImport = total
        state.totalImportIVA = Math.round(parseFloat(total * 1.19))
    },
    createImport(state) {
        var url = urlImport
        axios.post(url, {
            name: state.newImport.name,
        }).then(response => {
            state.newImport = {
                name: '',
                dolar: '',
                safe: '',
                transport: '',
                internment: '',
                other1: '',
                other2: '',
                total: ''
            }
            state.errorsLaravel = []
            $('#btn-import-card').click()
            $('#import').modal('show')
            toastr.success('Importación generada con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    showImport(state) {
        var url = urlImport + '/' + state.idImport
        axios.get(url).then(response => {
            state.import = response.data
            state.detailImport.dolar = state.import.dolar
            state.detailImport.embarque = state.import.embarque
            state.detailImport.fee = state.import.fee
            state.detailImport.fleteUsa = state.import.fleteUsa
            state.detailImport.bankusa = state.import.bankusa
            state.detailImport.bankchile = state.import.bankchile
            state.detailImport.transferencia = state.import.transferencia
            state.detailImport.otro = state.import.otro
            state.detailImportNacional.aduana1 = state.import.aduana1
            state.detailImportNacional.aduana2 = state.import.aduana2
            state.detailImportNacional.manipuleo = state.import.manipuleo
            state.detailImportNacional.bodega = state.import.bodega
            state.detailImportNacional.guia = state.import.guia
            state.detailImportNacional.retiro = state.import.retiro
            state.detailImportNacional.fleteChile = state.import.fleteChile

            if (state.detailImport.dolar == 0)
                state.detailImport.dolar = 700
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editImport(state, localImport) {
        state.fillImport.id = localImport.id
        state.fillImport.client = localImport.client
        state.fillImport.vehicle = localImport.vehicle
        state.fillImport.patent = localImport.patent
        state.fillImport.state = localImport.state
        //$("#edit").modal('show')
    },
    updateImport(state, id) {
        var url = urlImport + '/' + id
        axios.put(url, state.fillImport).then(response => {
            state.fillImport = {
                id: '',
                name: '',
                dolar: '',
                safe: '',
                transport: '',
                internment: '',
                other1: '',
                other2: '',
                total: ''
            }
            state.errorsLaravel = []
            $('#edit').modal('hide')
            toastr.success('Importación actualizada con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    showModalDeleteImport(state, id) {
        state.idImport = id
        $('#modalDeleteImport').modal('show')
    },
    deleteImport(state) {
        var url = urlImport + '/' + state.idImport
        axios.delete(url).then(response => {
            toastr.success('Importación eliminada con éxito')
            //state.idImport = null
            $('#modalDeleteImport').modal('hide')
        })
    },
    pdfImport(state) {
        var url = urlImportPdf + '/' + state.idImport
        window.location.href = url
    },
    excelImport(state, id) {
        var url = urlExportExcel + '/' + id
        window.location.href = url
    },
    /******************************* */
    /****** sección detalles de importaciones**** */
    /******************************* */
    showModalDetailimport(state, id) {
        state.detailimports = []
        state.idImport = id
        $('#modalImport').modal('show')
    },
    createDetailimport(state) {

        //state.newDetailimport.price = state.newDetailimport.price.replace('.', ',')

        var url = urlDetailimport

        var adicional = parseFloat(state.newDetailimport.aditional) * parseFloat(state.detailImport.dolar)

        var usa = parseFloat(state.newDetailimport.usa / 100) /* + 1*/

        var seguro = parseFloat(state.newDetailimport.seguro / 100) /* + 1*/

        var precio = parseFloat(state.newDetailimport.price) /** parseFloat(state.detailImport.dolar)*/ /* usa * seguro*/
        /* + adicional*/

        var precio_dolar = parseFloat(state.newDetailimport.price) * parseFloat(state.detailImport.dolar)

        axios.put(urlImport + '/' + state.idImport, {
            dolar: state.detailImport.dolar,
        }).then(response => {
            toastr.success('Importación actualizada')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })

        axios.post(url, {
            import_id: state.idImport,
            product: state.newDetailimport.product,
            detail: state.newDetailimport.detail,
            price: precio,
            price_dolar: precio_dolar,
            quantity: state.newDetailimport.quantity,
            //usa: state.newDetailimport.usa,
            usa: usa,
            seguro: seguro,
            valorem: state.newDetailimport.valorem,
            aditional: adicional,
        }).then(response => {

            state.errorsLaravel = []


            var url = urlProductimport

            axios.post(url, {
                name: state.newDetailimport.product,
                detail: state.newDetailimport.detail,
                //type: 0,
            }).then(response => {
                state.selectedProductimport = []

                state.newDetailimport = {
                    import_id: '',
                    product: '',
                    detail: '',
                    price: 1,
                    quantity: 1,
                    usa: 0,
                    seguro: 1,
                    valorem: 0,
                    aditional: 0,
                    embarque: 0,
                    fee: 0,
                    fleteUsa: 0,
                    bankusa: 0,
                    bankchile: 0,
                    transferencia: 0,
                    otro: 0,
                    aduana1: 0,
                    aduana2: 0,
                    manipuleo: 0,
                    bodega: 0,
                    guia: 0,
                    retiro: 0,
                    fleteChile: 0,
                    percentage: 0,
                    internacional: 0,
                    nacional: 0,
                    costoTotal: 0,
                    valueChile: 0,
                    unitario: 0,
                    utility: 0,
                    total: 0
                }

                toastr.success('Producto agregado con éxito')
            }).catch(error => {
                state.errorsLaravel = error.response.data
            })

        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editDetailimport(state, detailimport) {
        state.fillDetailimport.id = detailimport.id
        state.fillDetailimport.import_id = detailimport.import_id
        state.fillDetailimport.product = detailimport.product
        state.fillDetailimport.detail = detailimport.detail
        state.fillDetailimport.price = detailimport.price
        state.fillDetailimport.quantity = detailimport.quantity
        state.fillDetailimport.valorem = detailimport.valorem
        state.fillDetailimport.aditional = detailimport.aditional

        state.fillDetailimport.embarque = detailimport.embarque
        state.fillDetailimport.seguro = detailimport.seguro
        state.fillDetailimport.fee = detailimport.fee
        state.fillDetailimport.fleteUsa = detailimport.fleteUsa
        state.fillDetailimport.bankusa = detailimport.bankusa
        state.fillDetailimport.bankchile = detailimport.bankchile
        state.fillDetailimport.transferencia = detailimport.transferencia

        state.fillDetailimport.aduana1 = detailimport.aduana1
        state.fillDetailimport.aduana2 = detailimport.aduana2
        state.fillDetailimport.manipuleo = detailimport.manipuleo
        state.fillDetailimport.bodega = detailimport.bodega
        state.fillDetailimport.guia = detailimport.guia
        state.fillDetailimport.retiro = detailimport.retiro
        state.fillDetailimport.fleteChile = detailimport.fleteChile

        state.fillDetailimport.percentage = detailimport.percentage
        state.fillDetailimport.internacional = detailimport.internacional
        state.fillDetailimport.nacional = detailimport.nacional
        state.fillDetailimport.costoTotal = detailimport.costoTotal
        state.fillDetailimport.valueChile = detailimport.valueChile
        state.fillDetailimport.utility = detailimport.utility
        state.fillDetailimport.total = detailimport.total

        $("#editDetailImport").modal('show')
    },
    updateDetailimport(state, id) {
        var url = urlDetailimport + '/' + id
        axios.put(url, state.fillDetailimport).then(response => {
            state.fillDetailimport = {
                    id: '',
                    import_id: '',
                    product: '',
                    detail: '',
                    price: 1,
                    quantity: 1,
                    usa: 0,
                    seguro: 1,
                    valorem: 0,
                    aditional: 0,
                    embarque: 0,
                    fee: 0,
                    fleteUsa: 0,
                    bankusa: 0,
                    bankchile: 0,
                    transferencia: 0,
                    otro: 0,
                    aduana1: 0,
                    aduana2: 0,
                    manipuleo: 0,
                    bodega: 0,
                    guia: 0,
                    retiro: 0,
                    fleteChile: 0,
                    percentage: 0,
                    internacional: 0,
                    nacional: 0,
                    costoTotal: 0,
                    valueChile: 0,
                    unitario: 0,
                    utility: 0,
                    total: 0
                },
                state.errorsLaravel = []
            $('#editDetailImport').modal('hide')
            toastr.success('Detalle actualizado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    deleteDetailimport(state, id) {
        var url = urlDetailimport + '/' + id
        axios.delete(url).then(response => {
            toastr.success('Detalle eliminado con éxito')
        })
    },
    finishDetailimport(state) {
        var idImport = null
        state.detailimports.forEach(localImport => {
            var url = urlDetailimport + '/' + localImport.id
            idImport = localImport.import_id
            axios.put(url, localImport).then(response => {
                //toastr.success('Detalle actualizado con éxito')
            }).catch(error => {
                state.errorsLaravel = error.response.data
            })
        })

        var url = urlImport + '/' + idImport
        axios.put(url, {
            dolar: state.detailImport.dolar,
            embarque: state.detailImport.embarque,
            fee: state.detailImport.fee,
            fleteUsa: state.detailImport.fleteUsa,
            bankusa: state.detailImport.bankusa,
            bankchile: state.detailImport.bankchile,
            transferencia: state.detailImport.transferencia,
            otro: state.detailImport.otro,
            aduana1: state.detailImportNacional.aduana1,
            aduana2: state.detailImportNacional.aduana2,
            manipuleo: state.detailImportNacional.manipuleo,
            bodega: state.detailImportNacional.bodega,
            guia: state.detailImportNacional.guia,
            retiro: state.detailImportNacional.retiro,
            fleteChile: state.detailImportNacional.fleteChile,
        }).then(response => {
            toastr.success('Importación actualizada con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })

    },
    /******************************* */
    /****** sección cotización de importaciones**** */
    /******************************* */
    showQuotationimport(state, id) {
        state.detailimports = []
        state.idImport = id
        $('#modalQuotationImport').modal('show')
    },
    createQuotationimport(state) {
        var url = urlQuotationimport
        axios.post(url, {
            import_id: state.idImport,
            client_id: state.selectedClient.value,
            payment: state.newQuotationimport.payment,
            state: 'Pendiente',
        }).then(response => {
            state.newQuotationimport = {
                import_id: '',
                user_id: '',
                client_id: '',
                payment: '',
                state: ''
            }
            state.errorsLaravel = []
            $('#btn-quotationimport-card').click()
            $('#modalQuotationImport').modal('hide')
            toastr.success('Cotización generada con éxito')
            var url = urlQuotationimportPdf + '/' + response.data
            window.location.href = url
            //state.idImport = null
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    /******************************* */
    /****** sección productos **** */
    /******************************* */
    getProducts(state, page) {
        var url = urlProduct + '?page=' + page + '&name=' + state.searchProduct.name
        axios.get(url).then(response => {
            state.products = response.data.products.data
            state.pagination = response.data.pagination
        });
    },
    createProduct(state) {
        var url = urlProduct
        axios.post(url, {
            name: state.newProduct.name,
            detail: state.newProduct.detail,
        }).then(response => {

            var idProduct = response.data

            var url = urlCode

            state.newCode.client_id = state.selectedClient.value
            state.newCode.product_id = idProduct

            axios.post(url, {
                client_id: state.newCode.client_id,
                product_id: state.newCode.product_id,
                codebar: state.newCode.codebar,
                is_activate: state.newCode.is_activate,
            }).then(response => {
                state.selectedClient = {
                    label: '',
                    value: ''
                }
                state.newCode = {
                    client_id: '',
                    product_id: '',
                    codebar: '',
                    is_activate: 1
                }
                state.errorsLaravel = []

                toastr.success('Código generado con éxito')
            }).catch(error => {
                state.errorsLaravel = error.response.data
            })


            state.newProduct = {
                name: '',
                detail: ''
            }
            state.errorsLaravel = []
            $('#create').modal('hide')
            $('#btn-product-card').click()

            toastr.success('Producto generado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editProduct(state, product) {
        state.fillProduct.id = product.id
        state.fillProduct.name = product.name
        state.fillProduct.detail = product.detail
        $("#edit").modal('show')
    },
    updateProduct(state, id) {
        var url = urlProduct + '/' + id
        axios.put(url, state.fillProduct).then(response => {
            state.fillProduct = {
                id: '',
                name: '',
                detail: ''
            }
            state.errorsLaravel = []
            $('#edit').modal('hide')
            toastr.success('Producto actualizado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    modalDeleteProduct(state, id) {
        state.fillProduct.id = id
        $('#deleteProduct').modal('show')
    },
    deleteProduct(state) {
        var url = urlProduct + '/' + state.fillProduct.id
        axios.delete(url).then(response => {
            toastr.success('Producto eliminado con éxito')
            $('#deleteProduct').modal('hide')
        })
    },
    /******************************* */
    /****** sección productos de importacion **** */
    /******************************* */
    getProductimports(state, page) {
        var url = urlProductimport + '?page=' + page
        axios.get(url).then(response => {
            state.products = response.data.products.data
            state.pagination = response.data.pagination
        });
    },
    /******************************* */
    /****** sección codigos **** */
    /******************************* */
    getCodes(state, page) {
        var url = urlCode + '?page=' + page
        axios.get(url).then(response => {
            state.codes = response.data.codes.data
            state.pagination = response.data.pagination
        });
    },
    createCode(state) {
        var url = urlCode
        state.newCode.client_id = state.selectedClient.value
        state.newCode.product_id = state.selectedProduct.value

        axios.post(url, {
            client_id: state.newCode.client_id,
            product_id: state.newCode.product_id,
            codebar: state.newCode.codebar,
            is_activate: state.newCode.is_activate,
        }).then(response => {

            state.selectedClient = {
                label: '',
                value: ''
            }
            state.selectedProduct = {
                label: '',
                value: ''
            }
            state.newCode = {
                client_id: '',
                product_id: '',
                codebar: '',
                is_activate: 1
            }
            state.errorsLaravel = []
            $('#create').modal('hide')
            $('#btn-code-card').click()

            toastr.success('Código generado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editCode(state, code) {
        state.fillCode.id = code.id
        state.fillCode.client_id = code.client_id
        state.fillCode.product_id = code.product_id
        state.fillCode.codebar = code.codebar
        state.fillCode.is_activate = code.is_activate

        state.optionsProduct.forEach(product => {
            if (product.value == state.fillCode.product_id) {
                state.selectedProduct.value = product.value
                state.selectedProduct.label = product.label
            }
        })

        state.optionsClient.forEach(client => {
            if (client.value == state.fillCode.client_id) {
                state.optionsClient.value = client.value
                state.optionsClient.label = client.label
            }
        })

        $("#edit").modal('show')
    },
    updateCode(state, id) {
        var url = urlCode + '/' + id

        state.fillCode.client_id = state.optionsClient.value
        state.fillCode.product_id = state.optionsProduct.value

        axios.put(url, state.fillCode).then(response => {
            state.fillCode = {
                id: '',
                client_id: '',
                product_id: '',
                codebar: '',
                is_activate: 1
            }
            state.errorsLaravel = []
            $('#edit').modal('hide')
            toastr.success('Código actualizado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    modalDeleteCode(state, id) {
        state.fillCode.id = id
        $('#deleteCode').modal('show')
    },
    deleteCode(state) {
        var url = urlCode + '/' + state.fillCode.id
        axios.delete(url).then(response => {
            toastr.success('Código eliminado con éxito')
            $('#deleteCode').modal('hide')
        })
    },
    getCodeInventories(state) {
        var url = urlCodeInventory + '/' + state.fillCode.id
        state.totalInventory = 0

        axios.get(url).then(response => {
            state.inventories = response.data

            state.inventories.forEach(inventory => {
                state.totalInventory += parseInt(inventory.quantity)
            })
        })
    },

    /******************************* */
    /****** sección inventariado **** */
    /******************************* */
    modalInventory(state, id) {
        state.fillCode.id = id
        state.inventories = []
        $('#inventory').modal('show')
    },
    createInventory(state) {
        var url = urlInventory
        state.newInventory.code_id = state.fillCode.id

        axios.post(url, {
            code_id: state.newInventory.code_id,
            price: state.newInventory.price,
            quantity: state.newInventory.quantity,
        }).then(response => {

            state.newInventory = {
                code_id: '',
                price: 0,
                quantity: 1
            }
            state.errorsLaravel = []
            $('#create').modal('hide')
            $('#btn-code-card').click()

            toastr.success('Código generado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    modalDeleteInventory(state, id) {
        state.fillInventory.id = id
        $('#deleteInventory').modal('show')
    },
    deleteInventory(state) {
        var url = urlInventory + '/' + state.fillInventory.id
        axios.delete(url).then(response => {
            toastr.success('Inventariado eliminado con éxito')
            $('#deleteInventory').modal('hide')
        })
    },
    allInventories(state) {
        var url = urlAllInventory

        state.allInventory = {
            price: 0,
            quantity: 0
        }

        axios.get(url).then(response => {

            response.data.forEach((inventory) => {
                state.allInventory.price += parseInt(inventory.price)
                state.allInventory.quantity += parseInt(inventory.quantity)
            });
        });
    },
    /******************************* */
    /****** sección usuarios **** */
    /******************************* */
    getUsers(state, page) {
        var url = urlUser + '?page=' + page
        axios.get(url).then(response => {
            state.users = response.data.users.data
            state.pagination = response.data.pagination
        });
    },
    showUser(state) {
        var url = urlUserId
        axios.get(url).then(response => {
            var url = urlUser + '/' + response.data
            axios.get(url).then(response => {
                state.fillUser = response.data
                state.idUser = state.fillUser.id
            })
        })
    },
    createUser(state) {
        var url = urlUser
        axios.post(url, {
            name: state.newUser.name,
            email: state.newUser.email,
            password: state.newUser.password,
        }).then(response => {
            state.newUser = {
                name: '',
                email: '',
                password: ''
            }
            state.errorsLaravel = []
            $('#create').modal('hide')
            $('#btn-user-card').click()
            $('#modalCreateUser').modal('hide')
            toastr.success('Usuario generado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editUser(state, user) {
        state.fillUser.id = user.id
        state.fillUser.name = user.name
        state.fillUser.email = user.email
        state.fillUser.password = user.password
        state.fillUser.logo = user.logo
        $("#edit").modal('show')
    },
    updateUserShow(state) {
        var url = urlUser + '/' + state.idUser
        axios.put(url, state.fillUser).then(response => {
            //state.fillUser = { id:'', name:'', email: '', password: '' }
            state.errorsLaravel = []

            toastr.success('Usuario actualizado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    updateUser(state, id) {
        var url = urlUser + '/' + id
        axios.put(url, state.fillUser).then(response => {
            state.fillUser = {
                id: '',
                name: '',
                email: '',
                password: '',
                logo: ''
            }
            state.errorsLaravel = []
            $('#edit').modal('hide')
            toastr.success('Usuario actualizado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    modalDeleteUser(state, id) {
        state.fillUser.id = id
        $('#deleteUser').modal('show')
    },
    deleteUser(state) {
        var url = urlUser + '/' + state.fillUser.id
        axios.delete(url).then(response => {
            toastr.success('usuario eliminada con éxito')
            $('#deleteUser').modal('hide')
        })
    },
    /******************************* */
    /****** sección empresas **** */
    /******************************* */
    createCompany(state) {
        var url = urlUser
        axios.post(url, {
            rut: state.newCompany.rut,
            razonSocial: state.newCompany.razonSocial,
            email: state.newCompany.email,
            phone: state.newCompany.phone,
            address: state.newCompany.address,
            comuna: state.newCompany.comuna,
            giro: state.newCompany.giro,
            type: 'Mi Empresa',
        }).then(response => {
            state.newUser = {
                name: '',
                email: '',
                password: ''
            }
            state.errorsLaravel = []
            $('#create').modal('hide')
            $('#btn-user-card').click()
            toastr.success('Usuario generado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editCompany(state, user) {
        state.fillUser.id = user.id
        state.fillUser.name = user.name
        state.fillUser.email = user.email
        state.fillUser.password = user.password
        $("#edit").modal('show')
    },
    updateCompany(state, id) {
        var url = urlUser + '/' + id
        axios.put(url, state.fillUser).then(response => {
            state.fillUser = {
                id: '',
                name: '',
                email: '',
                password: ''
            }
            state.errorsLaravel = []
            $('#edit').modal('hide')
            toastr.success('Usuario actualizado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    modalDeleteCompany(state, id) {
        state.fillUser.id = id
        $('#deleteUser').modal('show')
    },
    deleteCompany(state) {
        var url = urlUser + '/' + state.fillUser.id
        axios.delete(url).then(response => {
            toastr.success('usuario eliminada con éxito')
            $('#deleteUser').modal('hide')
        })
    },
    /**************************** */
    /******************************* */
    /****** sección de control de roles **** */
    /******************************* */
    getRoles(state, page) {
        var url = urlRoles + '?page=' + page
        axios.get(url).then(response => {
            state.roles = response.data.roles.data
            state.pagination = response.data.pagination
        });
    },
    createRole(state) {
        var url = urlRoles
        axios.post(url, {
            name: state.newRole.name,
            description: state.newRole.description,
        }).then(response => {
            state.newRole.name = ''
            state.newRole.description = ''
            state.errorsLaravel = []
            $('#create').modal('hide')
            toastr.success('Rol generado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    editRole(state, role) {
        var permissions = []
        state.checkedSpecialRole = ''
        state.checkedPermissions = []
        state.fillRole.id = role.id
        state.fillRole.name = role.name
        state.fillRole.description = role.description
        state.checkedSpecialRole = role.special
        role.permissions.forEach(permission => {
            permissions.push(permission.id)
        })
        state.checkedPermissions = permissions
        $("#edit").modal('show')
    },
    updateRole(state, id) {
        var url = urlRoles + '/' + id
        state.fillRole.special = state.checkedSpecialRole
        state.fillRole.permissions = state.checkedPermissions
        axios.put(url, state.fillRole).then(response => {
            state.fillRole = {
                id: '',
                name: '',
                description: ''
            }
            state.errorsLaravel = [];
            $('#edit').modal('hide')
            toastr.success('Rol actualizado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    deleteRole(state, id) {
        var url = urlRoles + '/' + id
        axios.delete(url).then(response => {
            toastr.success('Rol eliminado con éxito');
        })
    },
    getAllRoles(state) {
        var url = urlAllRoles
        axios.get(url).then(response => {
            state.roles = response.data
        });
    },
    getUserRoles(state, id) {
        var url = urlUser + '/' + id + '/' + urlRoles
        axios.get(url).then(response => {
            state.userRoles = response.data
            $("#showRoles").modal('show')
        });
    },
    editUserRoles(state, user) {
        var roles = []
        state.checkedRoles = []
        state.fillUserRoles.id = user.id
        state.fillUserRoles.name = user.name
        user.roles.forEach(role => {
            roles.push(role.id)
        })
        state.checkedRoles = roles
        $("#editRoles").modal('show')
    },
    updateUserRoles(state, id) {
        var url = urlUserRoles + '/' + id;
        axios.put(url, state.checkedRoles).then(response => {
            state.checkedRoles = []
            $('#editRoles').modal('hide')
            toastr.success('Roles asignados con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },
    getAllPermissions(state) {
        var url = urlAllPermissions
        axios.get(url).then(response => {
            state.permissions = response.data
        });
    },
    setRoles(state, arr) {
        state.checkedRoles = arr
    },
    setSpecialRole(state, value) {
        if (value === 'no-access') {
            state.checkedPermissions = []
            $('input[name="permission"]').prop('disabled', true)
        }else if(value === 'all-access'){
            state.checkedPermissions = [1,2,3,4,5,6,7,9,8,10,11,12,13,14,15,16,17]
            $('input[name="permission"]').prop('disabled', true)
        }else{
            state.checkedPermissions = []
            $('input[name="permission"]').prop('disabled', false) 
        }
        state.checkedSpecialRole = value
    },
    setPermissions(state, arr) {
        state.checkedSpecialRole = ''
        state.checkedPermissions = arr
    },
    /****** sección select **** */
    /******************************* */
    allUsers(state) {
        var url = urlAllUser
        axios.get(url).then(response => {
            state.optionsUser = []
            response.data.forEach((user) => {
                state.optionsUser.push({
                    label: user.name,
                    value: user.id
                })
            });
        });
    },
    setUser(state, user) {
        state.selectedUser = user
    },
    allClients(state, type) {
        var url = urlAllClient + '?type=' + type
        axios.get(url).then(response => {
            state.optionsClient = []
            response.data.forEach((client) => {
                state.optionsClient.push({
                    label: client.razonSocial,
                    value: client.id
                })
            });
        });
    },
    setClient(state, client) {
        state.selectedClient = client
        state.newQuotationclient.client_text = state.selectedClient.label
    },
    allVehicleBrands(state) {
        var url = urlSelectVehiculoMarcas
        axios.get(url).then(response => {
            state.optionsVehicleBrand = []
            response.data.forEach((vehiclebrand) => {
                state.optionsVehicleBrand.push({
                    label: vehiclebrand.brand,
                    value: vehiclebrand.id
                })
            });
        });
    },
    setVehicleBrand(state, vehiclebrand) {
        state.selectedVehicleBrand = vehiclebrand
    },
    allVehicleModels(state) {
        var url = urlAllVehicleModel + '?brand_id=' + state.selectedVehicleBrand.value
        axios.get(url).then(response => {
            state.optionsVehicleModel = []
            if (response.data != null) {
                response.data.forEach((vehiclemodel) => {
                    state.optionsVehicleModel.push({
                        label: vehiclemodel.model,
                        value: vehiclemodel.id
                    })
                });
            }
        });
    },
    setVehicleModel(state, vehiclemodel) {
        state.selectedVehicleModel = vehiclemodel
    },

    allTiposVehiculos(state) {
        var url = urlSelectVehiculoTipo
        axios.get(url).then(response => {
            state.optionsTiposVehiculo = []
            response.data.forEach((vehiculotipo) => {
                state.optionsTiposVehiculo.push({
                    label: vehiculotipo.tipo_vehiculo,
                    value: vehiculotipo.id
                })
            });
        });
    },

    setVehiculoTipo(state, vehiculotipo) {
        state.selectedVehiculoTipo = vehiculotipo
    },

    /****************formulario de cotizacion ****************************************/

    allVBrands(state) {
        var url = urlVBrand
        axios.get(url).then(response => {
            state.optionsVBrand = []
            response.data.forEach((vbrand) => {
                state.optionsVBrand.push({
                    label: vbrand.brand,
                    value: vbrand.id
                })
            });
        });
    },
    setVBrand(state, brand) {
        state.selectedVBrand = brand
    },
    allVModels(state) {
        if (state.selectedVBrand.label != '') {
            var url = urlVModel + '/' + state.selectedVBrand.label
            axios.get(url).then(response => {
                state.optionsVModel = []
                if (response.data != null) {
                    response.data.forEach((vmodel) => {
                        state.optionsVModel.push({
                            label: vmodel.model,
                            value: vmodel.id
                        })
                    });
                }
            }).catch(error => {

            })
        }
    },
    setVModel(state, model) {
        state.selectedVModel = model
    },
    allVYears(state) {
        if (state.selectedVModel.label != '') {
            var url = urlVYear + '/' + state.selectedVBrand.label + '/' + state.selectedVModel.label
            axios.get(url).then(response => {
                state.optionsVYear = []
                if (response.data != null) {
                    response.data.forEach((vyear) => {
                        state.optionsVYear.push({
                            label: vyear.year,
                            value: vyear.id
                        })
                    });
                }
            }).catch(error => {

            })
        }
    },
    setVYear(state, year) {
        state.selectedVYear = year
    },
    allVEngines(state) {
        if (state.selectedVYear.label != '') {
            var url = urlVEngine + '/' + state.selectedVBrand.label + '/' + state.selectedVModel.label + '/' + state.selectedVYear.label
            axios.get(url).then(response => {
                state.optionsVEngine = []
                if (response.data != null) {
                    response.data.forEach((vengine) => {
                        state.optionsVEngine.push({
                            label: vengine.engine,
                            value: vengine.id
                        })
                    });
                }
            })
        }
    },
    setVEngine(state, engine) {
        state.selectedVEngine = engine
    },
    createQuotationUser(state) {
        var url = urlCreateQuotationUser
        axios.post(url, {
            name: state.formCotizacion.name,
            email: state.formCotizacion.email,
            phone: state.formCotizacion.phone,
            patentchasis: state.formCotizacion.patentchasis.toUpperCase(),
            brand: state.selectedVBrand.label,
            model: state.selectedVModel.label,
            year: state.selectedVYear.label,
            engine: state.selectedVEngine.label,
            description: state.formCotizacion.description
        }).then(response => {
            state.formCotizacion = {
                    name: '',
                    email: '',
                    phone: '',
                    patentchasis: '',
                    brand: '',
                    model: '',
                    year: '',
                    engine: '',
                    description: ''
                },
                state.errorsLaravel = []
            alert('Solicitud ingresada con éxito')
            return true
        }).catch(error => {
            state.errorsLaravel = []
            if (error.response.status === 422) {
                if (error.response.data.errors) {
                    for (let key in error.response.data.errors) {
                        state.errorsLaravel.push({
                            field: key,
                            msg: String(error.response.data.errors[key])
                        })
                    }
                }
            }
            return false
        })

    },

    getPendingQuotations(state, page) {
        var url = urlPendingQuotations + '?page=' + page
        axios.get(url).then(response => {
            state.pendingQuotations = response.data.quotations.data
            state.pagination = response.data.pagination
        });
    },
    /******************************************************************************** */

    allProducts(state) {
        var url = urlAllProduct
        axios.get(url).then(response => {
            state.optionsProduct = []
            response.data.forEach((product) => {
                state.optionsProduct.push({
                    label: product.name,
                    value: product.id
                })
            });
        });
    },
    setProduct(state, product) {
        state.selectedProduct = product
        if (state.selectedProduct != null) {
            state.newDetailclient.product = state.selectedProduct.label
            state.productForm.product = state.selectedProduct.label
        } else {
            state.newDetailclient.product = ''
            state.productForm.product = ''
        }
    },
    allProductimports(state) {
        var url = urlAllProductimport
        axios.get(url).then(response => {
            state.optionsProductimport = []
            response.data.forEach((product) => {
                state.optionsProductimport.push({
                    label: product.name + ' - ' + product.detail,
                    value: product.id,
                    name: product.name,
                    detail: product.detail,
                })
            })
        });
    },
    setProductimport(state, productimport) {
        state.selectedProductimport = productimport
        if (state.selectedProductimport != null) {
            state.newDetailimport.product = state.selectedProductimport.name
            state.newDetailimport.detail = state.selectedProductimport.detail
        } else {
            state.newDetailimport.product = ''
            state.newDetailimport.detail = ''
        }
    },
    /*allProductsImport(state){
        var url = urlAllProduct
        axios.get(url).then(response => {
            state.optionsProduct = []
            response.data.forEach((product) => {
                state.optionsProduct.push( { label: product.name, value: product.detail } )
            });
        });
    },
    setProductImport(state, product) {
        state.selectedProductImport = product
        if(state.selectedProductImport != null)
        {
            state.newDetailimport.product = state.selectedProductImport.label
            state.newDetailimport.detail = state.selectedProductImport.value
        }
        else{
            state.newDetailimport.product = ''
            state.newDetailimport.detail = ''
        }
    },*/
    /****** sección paginacion **** */
    /******************************* */
    paginate(state, page) {
        state.pagination.current_page = page
    },
    searchSii(state) {
        var rutSii = state.newClient.rut
        rutSii = rutSii.split('.').join('')
        var settings = {
            "async": true,
            "crossDomain": true,
            "url": "https://dev-api.haulmer.com/v2/dte/taxpayer/" + rutSii,
            "method": "GET",
            "headers": {
                "apikey": "928e15a2d14d4a6292345f04960f4bd3"
            }
        }

        $.ajax(settings).done(function (response) {
            state.newClient.razonSocial = response.razonSocial
            state.newClient.email = response.email
            state.newClient.phone = response.telefono
            state.newClient.address = response.direccion
            state.newClient.comuna = response.comuna
            state.newClient.giro = response.actividades[0].giro
            state.newClient.activity = response.actividades
            //result.actividades.forEach(actividad => {
            //console.log(response)
        });
    },
    sumTotalProduct(state) {
        state.newDetailclient.utility = Math.round(parseFloat((parseFloat(state.newDetailclient.price) *
                ((parseFloat(state.newDetailclient.percentage) / 100) + 1) +
                parseFloat(state.newDetailclient.aditional) -
                parseFloat(state.newDetailclient.price)) *
            parseFloat(state.newDetailclient.quantity)))

        state.newDetailclient.total = Math.round(parseFloat(((
                    parseFloat(state.newDetailclient.price) *
                    ((parseFloat(state.newDetailclient.percentage) / 100) + 1)) +
                parseFloat(state.newDetailclient.aditional) +
                parseFloat(state.newDetailclient.transport)) *
            parseFloat(state.newDetailclient.quantity)))
    },
    sumTotalEditProduct(state) {
        state.fillDetailclient.utility = Math.round(parseFloat((parseFloat(state.fillDetailclient.price) *
                ((parseFloat(state.fillDetailclient.percentage) / 100) + 1) +
                parseFloat(state.fillDetailclient.aditional) -
                parseFloat(state.fillDetailclient.price)) *
            parseFloat(state.fillDetailclient.quantity)))

        state.fillDetailclient.total = Math.round(parseFloat(((
                    parseFloat(state.fillDetailclient.price) *
                    ((parseFloat(state.fillDetailclient.percentage) / 100) + 1)) +
                parseFloat(state.fillDetailclient.aditional) +
                parseFloat(state.fillDetailclient.transport)) *
            parseFloat(state.fillDetailclient.quantity)))
        state.fillDetailclient.totalIVA = Math.round(state.fillDetailclient.total * 1.19)
    },
    distributionImport(state) {
        state.detailimports.forEach(detailImport => {

            /*var embarque = parseFloat(state.detailImport.embarque)
            var seguro = parseFloat(detailImport.seguro) + 1
            var usa = parseFloat(detailImport.usa) + 1
            var fee = parseFloat(state.detailImport.fee)
            var fleteUsa = parseFloat(state.detailImport.fleteUsa)
            var bankusa = parseFloat(state.detailImport.bankusa)
            var bankchile = parseFloat(state.detailImport.bankchile)
            var transferencia = parseFloat(state.detailImport.transferencia)*/
            var embarque = parseFloat(state.detailImport.embarque)
            var seguro = parseFloat(detailImport.seguro) + 1
            var usa = parseFloat(detailImport.usa) + 1
            var fee = parseFloat(state.detailImport.fee)
            var fleteUsa = parseFloat(state.detailImport.fleteUsa)
            var bankusa = parseFloat(state.detailImport.bankusa)
            var bankchile = parseFloat(state.detailImport.bankchile)
            var transferencia = parseFloat(state.detailImport.transferencia)

            /*alert("seguro: " + seguro)
            alert("usa: " + usa)*/

            var percentage =
                parseFloat((parseFloat(detailImport.price) * parseInt(detailImport.quantity) * 100) / state.totalPriceImport)

            detailImport.percentage = percentage

            detailImport.embarque =
                parseFloat(percentage / 100 * embarque) * parseFloat(state.detailImport.dolar)

            /* detailImport.seguro =
                 parseFloat( percentage / 100 * seguro ) * parseFloat(state.detailImport.dolar)*/

            detailImport.fee =
                parseFloat(percentage / 100 * fee) * parseFloat(state.detailImport.dolar)

            detailImport.fleteUsa =
                parseFloat(percentage / 100 * fleteUsa) * parseFloat(state.detailImport.dolar)

            detailImport.bankusa =
                parseFloat(percentage / 100 * bankusa) * parseFloat(state.detailImport.dolar)

            detailImport.bankchile =
                parseFloat(percentage / 100 * bankchile) * parseFloat(state.detailImport.dolar)

            detailImport.transferencia =
                parseInt(percentage / 100 * transferencia) * parseFloat(state.detailImport.dolar)


            detailImport.aduana1 = parseFloat(percentage / 100 * state.detailImportNacional.aduana1)
            detailImport.aduana2 = parseFloat(percentage / 100 * state.detailImportNacional.aduana2)
            detailImport.manipuleo = parseFloat(percentage / 100 * state.detailImportNacional.manipuleo)
            detailImport.bodega = parseFloat(percentage / 100 * state.detailImportNacional.bodega)
            detailImport.guia = parseFloat(percentage / 100 * state.detailImportNacional.guia)
            detailImport.retiro = parseFloat(percentage / 100 * state.detailImportNacional.retiro)
            detailImport.fleteChile = parseFloat(percentage / 100 * state.detailImportNacional.fleteChile)

            detailImport.price_dolar = parseFloat(detailImport.price) * parseFloat(state.detailImport.dolar)

            if (detailImport.valorem == 1) {

                detailImport.total = parseFloat(parseFloat(detailImport.price_dolar) *
                        parseFloat(seguro) *
                        parseFloat(usa) *
                        parseFloat(detailImport.quantity)
                    ) +
                    parseFloat(detailImport.embarque) +
                    //parseFloat( detailImport.seguro ) +
                    parseFloat(detailImport.fee) +
                    parseFloat(detailImport.fleteUsa) +
                    parseFloat(detailImport.bankusa) +
                    parseFloat(detailImport.bankchile) +
                    parseFloat(detailImport.transferencia) +
                    parseFloat(detailImport.otro)

                var advalorem = parseFloat(detailImport.total * 0.06)

                detailImport.total = detailImport.total + advalorem

            }

            if (detailImport.valorem == 0) {

                detailImport.total = parseFloat(parseFloat(detailImport.price_dolar) *
                        parseFloat(seguro) *
                        parseFloat(usa) *
                        parseFloat(detailImport.quantity)
                    ) +
                    parseFloat(detailImport.embarque) +
                    //parseFloat( detailImport.seguro ) +
                    parseFloat(detailImport.fee) +
                    parseFloat(detailImport.fleteUsa) +
                    parseFloat(detailImport.bankusa) +
                    parseFloat(detailImport.bankchile) +
                    parseFloat(detailImport.transferencia) +
                    parseFloat(detailImport.otro)

            }

            var totalInternacional = parseFloat(detailImport.embarque) +
                parseFloat(detailImport.otro) +
                parseFloat(detailImport.fee) +
                parseFloat(detailImport.fleteUsa) +
                parseFloat(detailImport.bankusa) +
                parseFloat(detailImport.bankchile) +
                parseFloat(detailImport.transferencia) +
                parseFloat(detailImport.otro)

            var totalNacional = parseFloat(state.detailImportNacional.aduana1) +
                parseFloat(state.detailImportNacional.aduana2) +
                parseFloat(state.detailImportNacional.manipuleo) +
                parseFloat(state.detailImportNacional.bodega) +
                parseFloat(state.detailImportNacional.guia) +
                parseFloat(state.detailImportNacional.retiro) +
                parseFloat(state.detailImportNacional.fleteChile)

            detailImport.internacional = totalInternacional
            detailImport.nacional = parseFloat(percentage / 100 * totalNacional)

            detailImport.costTotal = parseFloat(detailImport.internacional) + parseFloat(detailImport.nacional)

            var utilidad = "" + detailImport.valueChile

            //utilidad = utilidad.split('.').join('')

            detailImport.total = parseFloat(detailImport.total) + parseFloat(detailImport.nacional)

            detailImport.utility = parseFloat(utilidad) - parseFloat(detailImport.total / detailImport.quantity)

            detailImport.unitario =
                /*parseFloat(detailImport.price_dolar * (usa) * (seguro) )
                                                   + parseFloat( detailImport.costTotal / detailImport.quantity)*/
                parseFloat(detailImport.total / detailImport.quantity)

        })
    },
    sumUtility(state) {
        state.detailimports.forEach(detailImport => {
            detailImport.utility = parseFloat(detailImport.valueChile) -
                parseFloat(detailImport.total / detailImport.quantity)
        })
    },
    sumTotalImport(state) {},

    addToCart(state) {
        state.cart.push({
            product: {
                label: state.selectedProduct.label,
                value: state.selectedProduct.value
            },
            code: {
                label: state.selectedCode.label,
                value: state.selectedCode.value
            },
            price: {
                label: state.selectedPrice.label,
                value: state.selectedPrice.value
            },
            utility: state.productForm.utility,
            quantity: state.productForm.quantity,
            value: state.productForm.value,
            total: state.productForm.total
        })
        state.cartValue += state.productForm.value
        state.cartTotal += state.productForm.total

        state.productForm = {
            product_id: 0,
            code_id: 0,
            inventory_id: 0,
            price: 0,
            utility: 35,
            quantity: 1,
            value: 0,
            total: 0,
            code: '',
            product: '',
            max_quantity: 99
        }
    },

    allCodes(state) {
        if (state.selectedProduct.label != '') {
            axios.get('product-codes/' + state.selectedProduct.value)
                .then(response => {
                    state.optionsCode = []
                    response.data.forEach((code) => {
                        state.optionsCode.push({
                            label: code.codebar,
                            value: code.id
                        })
                    })
                }).catch(error => {
                    //console.log(error)
                })
        }
    },

    setCode(state, code) {
        state.selectedCode = code
    },

    allPrices(state) {
        if (state.selectedCode.label != '') {
            axios.get('code-inventories/' + state.selectedCode.value).then(response => {
                state.optionsPrice = []
                response.data.forEach((price) => {
                    state.optionsPrice.push({
                        label: price.price,
                        value: price.id
                    })
                })
            })
        }
    },

    setPrice(state, price) {
        state.selectedPrice = price
    },

    updateUtility(state, data) {
        state.productForm.utility = data.target.value
    },

    updateQuantity(state, data) {
        state.productForm.quantity = data.target.value
    },

    updateTotal(state) {
        state.productForm.value = Math.round(parseFloat(state.selectedPrice.label) *
            parseFloat((state.productForm.utility / 100) + 1) *
            parseFloat(state.productForm.quantity))
        state.productForm.total = Math.round(state.productForm.value * 1.19)
    },

    newSale(state) {
        let saleDetails = {
            client_id: 5, //particular
            total: state.cartTotal,
        }

        let sale = {
            sale: saleDetails,
            products: state.cart
        }

        if (state.cartValue > 0) {
            axios.post('sale', sale)
                .then(response => {
                    state.cart = []
                    state.cartTotal = 0
                    state.cartValue = 0
                    toastr.success('Venta generada con exito!')
                })
                .catch(error => {
                    // console.log(error.response.data)
                })
        }
    },

    allSales(state) {
        axios.get('all-sales')
            .then(response => {
                state.sales = response.data
                //esto se debe arreglar
                //encontrar una forma de guardar los nombres de los productos en el query de ventas
                state.sales.forEach(sale => {
                    sale.products.forEach(product => {
                        axios.get('product-search/' + product.code_id)
                            .then(response => {
                                product.code_id = response.data.name
                            })
                    })
                })
            })
            .catch(error => {
                //console.log(error.response.data)
            })

    },

    searchCode(state) {
        if (state.productForm.code !== '') {
            axios.get('code-search/' + state.productForm.code)
                .then(response => {
                    state.productForm.product_id = response.data.product_id
                    state.productForm.code_id = response.data.id
                    state.productForm.inventory_id = response.data.inventories[0].id
                    state.productForm.price = response.data.inventories[0].price
                    state.productForm.product = response.data.product.name
                    state.productForm.max_quantity = response.data.inventories[0].quantity
                    state.productForm.value = Math.round(parseFloat(state.productForm.price) *
                        parseFloat((state.productForm.utility / 100) + 1) *
                        parseFloat(state.productForm.quantity))
                    state.productForm.total = Math.round(state.productForm.value * 1.19)
                })
                .catch(error => {
                    //console.log(error)
                })
        }
    },

    updateCodeFields(state) {

        if (state.selectedCode.label !== '' || state.productForm.code !== '') {
            state.productForm.value = Math.round(parseFloat(state.productForm.price) *
                parseFloat((state.productForm.utility / 100) + 1) *
                parseFloat(state.productForm.quantity))
            state.productForm.total = Math.round(state.productForm.value * 1.19)
        }


    },

    removeFromCart(state, data) {

        let product = state.cart.find(p => p.product.value === data.id)

        state.cartValue = state.cartValue - product.value
        state.cartTotal = state.cartTotal - product.total

        state.cart.splice(state.cart.indexOf(data.id))
    },

    getMechanicClients(state) {
        axios.get('mechanic-clients')
            .then((response) => {
                state.users = response.data
                state.optionsMechanicClient = []
                response.data.forEach((user) => {
                    state.optionsMechanicClient.push({
                        label: user.name,
                        value: user.id
                    })
                });
            })
    },

    createMechanicClient(state, data) {
        axios.post('mechanic-client', {
            name: state.newUser.name,
            email: state.newUser.email,
            password: state.newUser.password,
        }).then(response => {
            state.newUser = {
                name: '',
                email: '',
                password: ''
            }
            state.errorsLaravel = []
            $('#create').modal('hide')
            $('#btn-user-card').click()
            toastr.success('Usuario generado con éxito')
        }).catch(error => {
            state.errorsLaravel = error.response.data
        })
    },

    getClientVehicles(state) {
        axios.get('client-vehicles')
            .then((response) => {
                state.vehicles = response.data
            })
    },

    setMechanicClient(state, client) {
        state.selectedMechanicClient = client
    },

    createVehicleMechanicClient(state) {
        var id_user = null
        if (state.selectedMechanicClient != null) {
            id_user = state.selectedMechanicClient.value

            if (!state.selectedVYear.label) {
                state.selectedVYear.label = '1'
                state.selectedVEngine.label = 'INDEFINIDO'
            }
            axios.post('vehicles', {
                user_id: id_user,
                patent: state.newVehicle.patent,
                chasis: state.newVehicle.chasis,
                name: state.selectedVBrand.label + ' ' + state.selectedVModel.label,
                year: state.selectedVYear.label,
                engine: state.selectedVEngine.label,
                color: state.newVehicle.color,
                km: state.newVehicle.km,
            }).then(response => {
                state.newVehicle.patent = ''
                state.newVehicle.chasis = ''
                state.newVehicle.color = ''
                state.newVehicle.km = ''
                state.errorsLaravel = []
                $('#create').modal('hide')
                toastr.success('Vehículo generado con éxito')
            }).catch(error => {
                state.errorsLaravel = error.response.data
            })
        }
    },

    modalCreateUserFromQuotation(state, data) {
        state.newUser.name = data.name
        state.newUser.email = data.email
        $('#modalCreateUser').modal('show')
    },


    //AQUI COMENZAR EL EVENTO:

    juntarDatos(state) {
        var prueba
        var contador = 1
        var sumaTotal
        var sumaTotalBoleta = 0
        var lineaCompleta = ''

        if (state.arrayBoleta.length != 0) {
            state.arrayBoleta.map(function (bar) {
                if (contador == state.arrayBoleta.length) {
                    sumaTotal = 1 * bar.precio
                    contador = contador + 1
                    sumaTotalBoleta = sumaTotalBoleta + sumaTotal
                    sumaTotal = 0
                } else {
                    sumaTotal = 1 * bar.precio
                    contador = contador + 1
                    sumaTotalBoleta = sumaTotalBoleta + sumaTotal
                    sumaTotal = 0
                }
                lineaCompleta = lineaCompleta + prueba
            })

            axios.post('/Invoice/Generator', {
                resultado: state.resultado,
                sumaTotalBoleta: sumaTotalBoleta,
                lineaCompleta: lineaCompleta,
                abrirPDF: state.abrirPDF,
                fecha: state.data1.fecha,
                giroEmisor: state.data1.giroEmisor,
                dirOrigen: state.data1.dirOrigen,
                rutReceptor: state.data1.rutReceptor,
                producto: state.data1.producto,
                cantidad: state.data1.cantidad,
                precio: state.data1.precio
            }).then((response) => {
                state.resultado = response.data
                state.arrayBoleta = []
                printJS({
                    printable: 'invoice/' + response.data,
                    type: 'pdf'
                });
            })
            state.enlace = "Archivo Generado"

        } else {
            state.resultado = "Falta agregar producto"
        }
    },

    crearArreglo(state) {
        var sumaTotal = 0
        var sumaTotalBoleta = 0
        state.arrayBoleta.push({
            precio: state.data2.precio,
            total: sumaTotalBoleta == 0 ? state.data2.precio : sumaTotalBoleta
        })
        state.arrayBoleta.map(function (bar) {
            sumaTotal = 1 * bar.precio
            sumaTotalBoleta = sumaTotalBoleta + sumaTotal
            sumaTotal = 0
        })
        sumaTotalBoleta: state.sumaTotalBoleta
        state.data2.precio = ''
    },
}
