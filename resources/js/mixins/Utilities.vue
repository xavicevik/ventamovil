<script>

import moment from "moment";
import Swal from "sweetalert2";

export default {
    data() {
        return {
            configMoney: {
                masked: false,
                prefix: '$ ',
                suffix: '',
                thousands: ',',
                decimal: '.',
                precision: 0,
                disableNegative: false,
                disabled: false,
                min: null,
                max: null,
                allowBlank: false,
                minimumNumberOfCharacters: 0,
            },
            ispage: true,
            arrayDepartamentos: [],
            arrayCiudades: [],

            arrayTiposdocumento: [],
            arrayTiposclientes: [],
            arraySegmentos: [],
            arrayBarrios:[],
            arrayCiclos: [],
            arrayEstratos: [],
            arrayTecnologias: [],
            arrayRestricciones: [],
            arrayPlanesComVoz: [],
            arrayPlanesComTv: [],
            arrayPlanesComInternet: [],
            arrayPlanesVentaVoz: [],
            arrayPlanesVentaInternet: [],
            arrayPlanesVentaTv: [],
            arrayVelocidadesInt: [],

            arrayEmpresas: [],
            editMode: false,
            verMode: false,
            newMode: false,
            isOpen: false,
            buscar: '',
            arrayData: {
                data: [],
                links: []
            },
            arrayDetalles: {
                data: [],
                links: []
            },
            arrayClientes: {
                data: [],
                links: []
            },
            sortOrder: 1,
            sortBy: '',
            selectedRow: null,
        }
    },
    methods: {
        formatPrice(value) {
            let val = (value/1).toFixed(0).replace('.', ',')
            return '$ '+ val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        },
        dateTime(value) {
            return moment(value).format('DD/MM/YYYY');
        },
        dateTimeFull(value) {
            return moment(value).format('YYYY-MM-DD HH:MM:SS');
        },
        getPaises: function () {
            axios.get('/paises',).then((res) => {
                this.arrayPaises = res.data.paises;
            })
        },
        getDepartamentos: function () {
            axios.get('/paises/departamentos', {
                params: {
                    idpais: this.form.idpais
                }
            }).then((res) => {
                this.arrayDepartamentos = res.data.departamentos;
            })
        },
        getCiudades: function () {
            axios.get('/paises/ciudades', {
                params: {
                    idpais: this.form.idpais,
                    iddepartamento: this.form.iddepartamento
                }
            }).then((res) => {
                this.arrayCiudades = res.data.ciudades;
            })
        },
        // Selección de listas de VentaMovil
        getTiposdocumento: async function () {
            let res;
            try {
                res = await axios.get('/master/getTiposdocumento');
            } catch (error) {
                return false;
            }
            this.arrayTiposdocumento = res.data.data;
        },
        getTipoCliente: async function () {
            let res;
            try {
                res = await axios.get('/master/getTipoCliente');
            } catch (error) {
                return false;
            }
            this.arrayTiposclientes = res.data.data;
        },
        getSegmentos: async function () {
            let res;
            try {
                res = await axios.get('/master/getSegmentos');
            } catch (error) {
                return false;
            }
            this.arraySegmentos = res.data.data;
        },
        getBarrioLocalidad: async function (localidad) {
            let res;
            try {
                res = await axios.get('/master/getBarrioLocalidad', {
                    params: {
                        Filtro: localidad
                    }
                });
            } catch (error) {
                return false;
            }
            this.arrayBarrios = res.data.data;
        },






        getClientes: async function (buscar = '', filtro = 'documento', paginate = false) {
            var url= '/users/getClientesActivos';
            axios.get(url, {
                params: {
                    buscar: buscar,
                    filtro: filtro,
                    paginate: paginate
                }
            }).then((res) => {
                var respuesta = res.data;
                this.arrayClientes = respuesta.clientes;
            })
        },
        showClient: async function (id) {
            var url= '/users/cliente/' + id;
            axios.get(url).then((res) => {
                var respuesta = res.data;
                this.form.cliente = respuesta.cliente;
            })
        },
        getDetalles: function (id) {
            var url= '/ventas/getDetalles';
            axios.get(url, {
                params: {
                    id: id,
                }
            }).then((res) => {
                var respuesta = res.data;
                this.arrayDetalles = respuesta.data;
                this.idVenta = id;
            })
        },
        deleteRow: function (data) {
            let mensaje = '';
            let title = '';
            let html = '';
            if (data.estado) {
                mensaje = 'Desea desactivar el usuario?';
                title = 'Desactivado!';
                html = 'El usuario ha sido desactivado con éxito';
            } else {
                mensaje = 'Desea activar el usuario?';
                title = 'Activado!';
                html = 'El usuario ha sido activado con éxito.';
            }
            Swal.fire({
                title: mensaje,
                text: "Solo un administrador podrá revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Proceder!'
            }).then((result) => {
                data._method = 'DELETE';
                axios.post('/users/' + data.id, data)
                    .then((res) => {
                        this.getUsers('','nombre');
                        Swal.fire(
                            title,
                            html,
                            'success'
                        )
                    }).catch(function (error) {
                });
            })

        },
        cleanMessage: function () {
            this.errorcreacion = '';
        },
        rowSelect(idx) {
            this.selectedRow = idx;
        },
        rowSelect2(idx) {
            this.selectedRow2 = idx;
        },
        nvl: function (value, fallbackValue) {
            return typeof value !== 'undefined' && value != null
                ? value
                : fallbackValue;
        },

        __delay__: function (timer) {
            return new Promise(resolve => {
                timer = timer || 2000;
                setTimeout(function () {
                    resolve();
                }, timer);
            });
        }
    },
};
</script>
<style>
:root {
    --popper-theme-background-color: blue;
    --popper-theme-background-color-hover: #333333;
    --popper-theme-text-color: #ffffff;
    --popper-theme-border-width: 0px;
    --popper-theme-border-style: solid;
    --popper-theme-border-radius: 6px;
    --popper-theme-padding: 4px;
    --popper-theme-box-shadow: 0 6px 30px -6px rgba(0, 0, 0, 0.25);
}
</style>
