<template>
    <AppLayout title="Clientes" :Vendedor="Vendedor" :localidad="localidad" :localidaddesc="localidaddesc">
        <template #header>

        </template>

        <!-- Mobile sub header -->
        <section>
            <div @click="cleanMessage()" mx-auto class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-show="errorcreacion">
                <div class="flex">
                    <div>
                        <p class="text-sm">{{ errorcreacion }}</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="w-full pt-2 pb-10 px-2 rounded-lg lg:px-4 md:px-2 sm:px-2">

            <div class="mx-auto 2xl:8">

<!--                datos del cliente-->
                <div id="facturacion" name="facturacion" class="bg-white overflow-hidden shadow-xl rounded-lg">
                    <!-- Mensajes Flash -->
                    <section>
                        <div @click="cleanMessage()" mx-auto class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md my-3" role="alert" v-show="errors.DIRECCION || errors.DIRECCION_COBR">
                            <div class="flex">
                                <div>
                                    <p class="text-sm">{{ errors.DIRECCION }}</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Mensajes Flash -->
                    <!-- Encabezado y titulo -->
                    <section>
                        <div class="flex justify-between mx-auto p-4">
                            <div class="w-full flex">
                                <h1 class="font-bold text-xl text-black-800 ">
                                    Estado Solicitudes
                                </h1>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Encabezado y titulo -->

                    <section>
                        <div class="px-4 pb-4">
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <form @submit.prevent="buscarSolicitudes()">
                                    <div class="relative z-0 w-full mb-2 group">
                                        <Datepicker v-model="form.fechainicio" :enableTimePicker="false" autoApply placeholder="Fecha inicio" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                                    </div>
                                    <div class="relative z-0 w-full mb-2 group">
                                        <Datepicker v-model="form.fechafin" :enableTimePicker="false" autoApply placeholder="Fecha fin" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                                    </div>

                                    <div class="w-full inline-flex">
                                        <div class="text-right pr-2 mx-auto">
                                            <button type="button" @click="buscarSolicitudes(form.fechainicio, form.fechafin)" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center">
                                                Consultar
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>

<!--                solicitudes  -->
                <div class="mb-4 mt-2 bg-white overflow-hidden shadow-xl rounded-lg">
                    <!-- Ventana modal productos -->
                    <div class="my-6 mx-4 flex grid xl:gap-6">
                    <!-- Tabla de contenido -->
                        <table class="table-fixed w-full">
                            <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 w-1/2 text-sm font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                    Estado
                                </th>
                                <th class="px-4 py-2 w-1/2 text-sm font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                    Cantidad
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr :class="name === selectedRow ? 'bg-blue-200' : ''" class="text-center hover:bg-blue-400 text-sm" @click="rowSelect(name); getDetalleSolicitudes(form.fechainicio, form.fechafin, name)" v-if="arraySolicitudes" v-for="(val, name) in arraySolicitudes">
                                <td class="border px-1 py-2 text-sm truncate" v-text="name"></td>
                                <td class="border px-1 py-2 text-sm truncate" v-text="val"></td>
                            </tr>
                            </tbody>
                        </table>
                        <!-- Fin Tabla de contenido -->
                    </div>

                    <!-- Fin Ventana productos -->

                </div>
            </div>

            <!-- Ventana modal detalle solicitudes -->
            <!-- Main modal -->
            <section> <!-- Ventana modal -->
                <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpenDetalle">
                    <div class="items-end justify-center min-h-screen pt-4 px-2 pb-4 text-center sm:block sm:p-0">

                        <div class="fixed inset-0 transition-opacity">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                        <div class="inline-block px-2 py-4 w-full lg:w-6/12 align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                            <button type="button" @click="closeModal()" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                            <div class="">
                                <h2 class="text-xl font-bold text-gray-900">Detalle Solicitudes - {{ arrayDetalleSolicitudes[0]['ESTADO'] }}</h2>
                            </div>
                            <div class="my-6 mx-2 flex grid xl:gap-6">
                                <!-- Tabla de contenido -->
                                <table class="table-fixed w-full">
                                    <thead>
                                    <tr class="bg-gray-100">
                                        <th class="px-4 py-2 w-1/2 text-sm font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                            Solicitud
                                        </th>
                                        <th class="px-4 py-2 w-1/2 text-sm font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                            Trámite
                                        </th>
                                        <th class="px-4 py-2 w-1/2 text-sm font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                            Fecha
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="text-center hover:bg-blue-400 text-sm" v-if="arrayDetalleSolicitudes" v-for="(dato) in arrayDetalleSolicitudes">
                                        <td class="border px-1 py-2 text-sm truncate" v-text="dato.SOLICITUD"></td>
                                        <td class="border px-1 py-2 text-sm truncate" v-text="dato.TRAMITE"></td>
                                        <td class="border px-1 py-2 text-sm truncate" v-text="dato.REQUEST_DATE"></td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!-- Fin Tabla de contenido -->
                            </div>

                        </div>
                    </div>
                </div>
            </section>
            <!-- Fin Ventana modal detalle solicitudes  -->

            <!-- Ventana modal de loading -->
            <!-- Main modal -->
            <section> <!-- Ventana modal -->
                <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="loading">
                    <div class="items-end justify-center min-h-screen pt-10 px-2 pb-20 text-center sm:block sm:p-0">

                        <div class="fixed inset-0 transition-opacity">
                            <div class="absolute inset-0 bg-gray-400 opacity-75"></div>
                        </div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden inline-block align-middle h-screen"></span>
                            <section>
                                <div class=" mt-10 w-full" id="app">
                                    <semipolar-spinner class="mt-10 mx-auto" :animation-duration="2000" :size="85" color="#ff1d5e" />
                                </div>
                            </section>


                    </div>
                </div>
            </section>
            <!-- Fin Ventana modal de loading -->


        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayoutapp2.vue';
import Swal from "sweetalert2";
import { Icon } from '@iconify/vue';
import Toggle from '@vueform/toggle';
import '@vueform/toggle/themes/default.css';
import Button from "../../Jetstream/Button";
import moment from 'moment'
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref, onMounted } from 'vue';
import { Money3Component } from 'v-money3'
import {Head, Link, usePage} from '@inertiajs/inertia-vue3';
import JetNavLink from '@/Jetstream/NavLink.vue';
import NavLink from "../../Jetstream/NavLink";
import Input from "../../Jetstream/Input";

import Multiselect from '@vueform/multiselect'

import { SemipolarSpinner } from 'epic-spinners'

export default {

    components: {
        Input,
        NavLink,
        Button,
        AppLayout,
        Icon,
        Toggle,
        QuillEditor,
        JetNavLink,
        Link,
        money3: Money3Component,
        Multiselect,
        SemipolarSpinner
    },
    props:{
        users : [],
        errors: Object,
        Vendedor: 0,
        localidad: 0,
        localidaddesc: '',
        segmentoss: [],
        ciclos: [],
        tipoidentificaciones: [],
        tipoclientes: [],
        barrios:[],
        estratos: [],
        tecnologias: [],
        restricciones: [],
        paquetesvoz: [],
        paquetestv: []
    },
    computed: {
        valFinish: function () {
            if (this.form.INC_VOZ) {
                if (this.form.PLAN_CCIAL_LB == 0 || this.form.PLAN_VTA_LB == 0) {
                    return 'Siguiente';
                }
            }
            if (this.form.INC_INT) {
                if (this.form.PLAN_CCIAL_INT == 0 || this.form.PLAN_VTA_INT == 0) {
                    return 'Siguiente';;
                }
            }
            if (this.form.INC_TV) {
                if (this.form.PLAN_CCIAL_TV == 0 || this.form.PLAN_VTA_TV == 0) {
                    return 'Siguiente';;
                }
            }

            return 'Registrar';
        }
    },
    data() {
        return {
            selectedRow: null,
            loading: false,
            isOpenDetalle: false,
            activeTab: '',
            navState: 'facturacion',
            isOpenModalDirInsta: false,
            isOpenModalDirfact: false,
            errorcreacion: '',
            isValidategeneral: false,
            isValidatereferencias: false,
            isValidateempresa: false,
            isValidateautorizacion: false,
            tituloModal: '',
            wifiselect: '',
            cliente: {
                SUBSCRIBER_ID: 0,
                NOMBRE: '',
                APELLIDO: '',
                IDENTIFICACION: '',
                TIPO_IDENT: 0,
                TIPO_CLIENTE: 0,
                SEGMENTO: 0,
                TELEFONO: '',
                DIRECCION: '',
                NOMBRE_CONTACT: '',
                TEL_CONTACT: '',
                DIR_CONTACT: '',
                EMAIL: '',
                TEL_MOVIL: '',
                CANT_EMPLEADOS: 0,
                CANT_SUCURSALES: 0,
                CANT_PC: 0,
                MEDIO_RECEPCION: 0,
                ID_LLAMADA: 0,
                AUTORIZA: false,
                MED_ESCRITO: false,
                MED_SMS: false,
                MED_EMAIL: false,
                MED_TELEMERCADEO: false,
                MED_RED_SOCIAL: false,
                VENDEDOR: false,
                NOMBRE_REF_1: '',
                APELLIDO_REF_1: '',
                IDENTIF_REF_1: '',
                TEL_REF_1: '',
                NOMBRE_REF_2: '',
                APELLIDO_REF_2: '',
                IDENTIF_REF_2: '',
                TEL_REF_2: '',
            },
            form: {
                fechainicio: '',
                fechafin: ''
            },
            arraySolicitudes: [],
            arrayDetalleSolicitudes: [],
        }
    },
    methods: {

        openModal: function (accion, data = []) {
            switch (accion) {
                case 'dirinsta':
                    this.isOpenModalDirInsta = true;
                    break;
                case 'dircobro':
                    this.isOpenModalDirfact = true;
                    break;
            }
        },
        closeModal: function () {
            this.isOpenDetalle = false;
            this.arrayDetalleSolicitudes = [];
        },
        closeModalPass: function () {
            this.isOpencambiopass = false
            this.$page.props.errors.updatePassword = null;
        },
        reset: function () {
            this.form.NOMBRE = '';
            this.form.IDENTIFICACION = '';
            this.form.SUBSCRIPTION_ID = '';
            this.form.INC_VOZ = 0;
            this.form.INC_INT = 0;
            this.form.INC_TV = 0;
            this.form.INC_SOLVOZ = 0;
            this.form.INC_SOLINT = 0;
            this.form.INC_SOLTV = 0;
            this.form.EMPAQUETADO = 'N';
            this.form.INC_VOZ_ACT = 0;
            this.form.INC_INT_ACT = 0;
            this.form.INC_TV_ACT = 0;
            this.form.PLAN_CCIAL_LB = 0;
            this.form.PLAN_VTA_LB = 0;
            this.form.PLAN_CCIAL_INT = 0;
            this.form.PLAN_VTA_INT = 0;
            this.form.PLAN_CCIAL_TV = 0;
            this.form.PLAN_VTA_TV = 0;

            this.voz.NOMBRE = '';
            this.voz.IDENTIFICACION = '';
            this.voz.SUBSCRIPTION_ID = '';
            this.voz.PRODUCTO = 0;
            this.voz.TIPO_PRODUCTO = 0;
            this.voz.PLAN_FACTURACION = 0;
            this.voz.EMPAQUETADO = 'N';
            this.voz.COMERCIAL_PLAN = 0;

            this.int.NOMBRE = '';
            this.int.IDENTIFICACION = '';
            this.int.SUBSCRIPTION_ID = '';
            this.int.PRODUCTO = 0;
            this.int.TIPO_PRODUCTO = 0;
            this.int.PLAN_FACTURACION = 0;
            this.int.EMPAQUETADO = 'N';
            this.int.COMERCIAL_PLAN = 0;

            this.tv.NOMBRE = '';
            this.tv.IDENTIFICACION = '';
            this.tv.SUBSCRIPTION_ID = '';
            this.tv.PRODUCTO = 0;
            this.tv.TIPO_PRODUCTO = 0;
            this.tv.PLAN_FACTURACION = 0;
            this.tv.EMPAQUETADO = 'N';
            this.tv.COMERCIAL_PLAN = 0;


            this.solvoz.PACKAGE_ID = 0;
            this.solvoz.MOTIVE_ID = 0;
            this.solvoz.PRODUCT_TYPE_ID = 0;
            this.solvoz.COMMERCIAL_PLAN_ID = 0;
            this.solvoz.PLANFACT = 0;
            this.solvoz.REQUEST_DATE = '';

            this.solint.PACKAGE_ID = 0;
            this.solint.MOTIVE_ID = 0;
            this.solint.PRODUCT_TYPE_ID = 0;
            this.solint.COMMERCIAL_PLAN_ID = 0;
            this.solint.PLANFACT = 0;
            this.solint.REQUEST_DATE = '';

            this.soltv.PACKAGE_ID = 0;
            this.soltv.MOTIVE_ID = 0;
            this.soltv.PRODUCT_TYPE_ID = 0;
            this.soltv.COMMERCIAL_PLAN_ID = 0;
            this.soltv.PLANFACT = 0;
            this.soltv.REQUEST_DATE = '';

            this.errorcreacion = false;
            this.step = 1;
            this.isValidategeneral = false;
            this.errors = [];
        },
        rowSelect: function (idx) {
            this.selectedRow = idx;
        },

        crearDireccion: async function (opcion, direccion, barrio) {
            this.loading = true;
            let statuserror = true;
            let url = '/direccion/storeDirInsta';

            if (this.form.DIRECCION == null || this.form.DIRECCION == '') {
                statuserror =  false;
                this.errors.DIRECCION = 'Ingrese una dirección';
            } else {
                this.errors.DIRECCION = null;
            }

            /*
            if (this.form.BARRIO == 0) {
                statuserror =  false;
                this.errors.BARRIO = 'Seleccione un barrio';
            } else {
                this.errors.BARRIO = null;
            }
            */

            if (!statuserror) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Digite la información deseada',
                    showConfirmButton: true,
                })
                return false;
            }

            console.log('creación de dirección de instalación');
            let res;
            try {
                res = await axios.get(url, {
                    params: {
                        isbDireccion: direccion,
                        inuBarrio: barrio,
                    }
                });
            } catch (error) {
                console.log(error);
                return false;
            }

            let resultado = res.data;

            if (resultado.id != '' && resultado.id != null && resultado.id > 0) {
                console.log(res.data);
                this.closeModal('dirinsta');
                this.closeModal('dircobro');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'La dirección no puede ser utilizada',
                    showConfirmButton: true,
                })
                console.log(res.data);
            }
            this.loading = false;
        },
        save: async function (form) {
            this.loading = true;
            let statuserror = true;
            this.isValidategeneral = false;

            if (!this.form.EMPAQUETADO) {
                statuserror =  false;
                this.errors.EMPAQUETADO = 'Debe realizar un empaquetamiento';
            } else {
                this.errors.EMPAQUETADO = null;
            }

            if (this.form.INC_VOZ) {
                if (this.form.PLAN_CCIAL_LB <= 0) {
                    statuserror = false;
                    this.errors.PLAN_CCIAL_LB = 'Seleccione el plan comercial de Voz';
                } else {
                    this.errors.PLAN_CCIAL_LB = null;
                }
                if (this.form.PLAN_VTA_LB <= 0) {
                    statuserror = false;
                    this.errors.PLAN_VTA_LB = 'Seleccione el plan de venta de Voz';
                } else {
                    this.errors.PLAN_VTA_LB = null;
                }
            }

            if (this.form.INC_INT) {
                if (this.form.PLAN_CCIAL_INT <= 0) {
                    statuserror = false;
                    this.errors.PLAN_CCIAL_INT = 'Seleccione el el plan comercial de Internet';
                } else {
                    this.errors.PLAN_CCIAL_INT = null;
                }
                if (this.form.PLAN_VTA_INT <= 0) {
                    statuserror = false;
                    this.errors.PLAN_VTA_INT = 'Seleccione el el plan de venta de Internet';
                } else {
                    this.errors.PLAN_VTA_INT = null;
                }
            }

            if (this.form.INC_TV) {
                if (this.form.PLAN_CCIAL_TV <= 0) {
                    statuserror = false;
                    this.errors.PLAN_CCIAL_TV = 'Seleccione el el plan comercial de Tv';
                } else {
                    this.errors.PLAN_CCIAL_TV = null;
                }
                if (this.form.PLAN_VTA_TV <= 0) {
                    statuserror = false;
                    this.errors.PLAN_VTA_TV = 'Seleccione el el plan de venta de Tv';
                } else {
                    this.errors.PLAN_VTA_TV = null;
                }
            }

            /*
            let cantProductos = ((this.form.INC_VOZ||this.form.INC_SOLVOZ)?1:0 + (this.form.INC_INT||this.form.INC_SOLINT)?1:0 + (this.form.INC_TV||this.form.INC_SOLTV?1:0));
            console.log('cantProductos ' + cantProductos);
            if ( cantProductos < 2) {
                statuserror =  false;
                this.errors.INC_VOZ = 'Seleccione por lo menos un duo a empaquetar';
            } else {
                this.errors.INC_VOZ = null;
            }

             */

            if (!statuserror) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ingrese la información solicitada',
                    showConfirmButton: true,
                })
                return false;
            }
            this.navState = 'facturacion';
            this.isValidategeneral = true;
            this.$nextTick(() => {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            });

            console.log('creación de solicitud de empaquetamiento');

            let res;
            try {
                res = await axios.get('/venta/storepaquete', {
                    params: {
                        PROD_VOZ: this.voz?this.voz.PRODUCTO:null,
                        PROD_INT: this.int?this.int.PRODUCTO:null,
                        PROD_TV: this.tv?this.tv.PRODUCTO:null,
                        MOT_VTA_VOZ: this.solvoz?this.solvoz.MOTIVE_ID:null,
                        MOT_VTA_INT: this.solint?this.solint.MOTIVE_ID:null,
                        MOT_VTA_TV: this.soltv?this.soltv.MOTIVE_ID:null,
                        PLAN_CCIAL_VOZ: this.form.PLAN_CCIAL_LB,
                        PLAN_CCIAL_INT: this.form.PLAN_CCIAL_INT,
                        PLAN_CCIAL_TV: this.form.PLAN_CCIAL_TV,
                        PLAN_VTA_VOZ: this.form.PLAN_VTA_LB,
                        PLAN_VTA_INT: this.form.PLAN_VTA_INT,
                        PLAN_VTA_TV: this.form.PLAN_VTA_TV
                    }
                });
            } catch (error) {
                console.log(error);
                return false;
            }

            let resultado = res.data;

            if (resultado.codigo == 0 && resultado.solicitud > 0) {
                Swal.fire({
                    icon: 'success',
                    title: 'La solicitud ' + resultado.solicitud + ' ha sido registrada satisfactoriamente',
                    showConfirmButton: true,
                })
                console.log(res.data);
                this.errorcreacion = 'La solicitud ' + resultado.solicitud + ' ha sido registrada satisfactoriamente';
                this.reset();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: resultado.mensaje,
                    showConfirmButton: true,
                })
                this.errorcreacion = resultado.mensaje;
                console.log(res.data);
            }
            this.loading = false;
        },
        getCliente: async function (tipocliente, tipoident, identificacion) {
            this.loading = true;
            console.log('consultar cliente');
            let res;
            try {
                res = await axios.get('/cliente/getCliente', {
                    params: {
                        tipocliente: tipocliente,
                        tipoident: tipoident,
                        identificacion: identificacion
                    }
                });
            } catch (error) {
                console.log(error);
                return false;
            }
            console.log(res.data.data);
            if (res.data.data != null) {
                if (res.data.data[0].SUBSCRIBER_ID > 0) {
                    this.cliente = res.data.data[0];
                    this.segmento = res.data.segmento;
                    this.tipocliente = res.data.tipocliente;
                    this.form.NOMBRE = this.cliente.NOMBRE;
                    this.form.APELLIDO = this.cliente.APELLIDO;
                    this.form.SEGMENTO = this.cliente.SEGMENTO;
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'El cliente no existe',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'El cliente no existe',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
            this.loading = false;
        },
        next: function () {
            if (this.valFinish == 'Registrar') {
                this.save(this.form);
            } else {
                console.log(this.step);
                this.step += 1;
                this.getComercialPlan('paquete');
                switch (this.step) {
                    case 2:
                        if (this.form.INC_VOZ || this.form.INC_SOLVOZ) {
                            if (this.form.INC_INT || this.form.INC_SOLINT) {
                                this.activeTab = 'internet';
                            } else if (this.form.INC_TV || this.form.INC_SOLTV) {
                                this.activeTab = 'tv';
                            }
                        } else  {
                            this.activeTab = 'tv';
                        }
                        break;
                    case 3:
                        this.activeTab = 'tv';
                        break;
                }
            }
        },
        prev: function () {
            this.step -= 1;
            switch (this.step) {
                case 1:
                    if (this.form.INC_VOZ || this.form.INC_SOLVOZ) {
                        this.activeTab = 'voz';
                    } else if (this.form.INC_INT || this.form.INC_SOLINT) {
                        this.activeTab = 'internet';
                    }
                    break;
                case 2:
                    this.activeTab = 'internet';
                    break;
            }
        },
        getComercialPlan: async function () {
            this.loading = true;
            let Producto = null;
            let Motivo = null;
            let PlanCcialVoz = null;
            let PlanCcialInt = null;
            let PlanCcialTV = null;
            if (this.form.EMPAQUETADO) {
                console.log('consultar plan comercial Paquete');
                let res;
                console.log('INC_VOZ ' + this.form.INC_VOZ);
                console.log('INC_INT ' + this.form.INC_INT);
                console.log('INC_TV ' + this.form.INC_TV);

                switch (this.step) {
                    case 1:
                        if (this.form.INC_VOZ || this.form.INC_SOLVOZ) {
                            if (this.form.INC_VOZ_ACT) {
                                Producto = this.voz.PRODUCTO;
                                Motivo = null;
                            } else {
                                Motivo = this.solvoz.MOTIVE_ID;
                                Producto = null;
                            }
                            PlanCcialVoz = null;
                            PlanCcialInt = null;
                            PlanCcialTV = null;
                        } else if (this.form.INC_INT || this.form.INC_SOLINT) {
                            if (this.form.INC_INT_ACT) {
                                Producto = this.int.PRODUCTO;
                                Motivo = null;
                            } else {
                                Motivo = this.solint.MOTIVE_ID;
                                Producto = null;
                            }
                            PlanCcialVoz = null;
                            PlanCcialInt = null;
                            PlanCcialTV = null;
                        }
                        break;
                    case 2:
                        if (this.form.INC_INT || this.form.INC_SOLINT) {
                            if (this.form.INC_INT_ACT) {
                                Producto = this.int.PRODUCTO;
                                Motivo = null;
                            } else {
                                Motivo = this.solint.MOTIVE_ID;
                                Producto = null;
                            }
                            PlanCcialVoz = this.form.PLAN_CCIAL_LB;
                            PlanCcialInt = null;
                            PlanCcialTV = null;
                        } else if (this.form.INC_TV || this.form.INC_SOLTV) {
                            if (this.form.INC_TV_ACT) {
                                Producto = this.tv.PRODUCTO;
                                Motivo = null;
                            } else {
                                Motivo = this.soltv.MOTIVE_ID;
                                Producto = null;
                            }
                            if (this.form.INC_VOZ) {
                                PlanCcialVoz = this.form.PLAN_CCIAL_LB;
                                PlanCcialInt = null;
                                PlanCcialTV = null;
                            } else {
                                PlanCcialVoz = null;
                                PlanCcialInt = this.form.PLAN_CCIAL_INT;
                                PlanCcialTV = null;
                            }
                        }
                        break;
                    case 3:
                        if (this.form.INC_TV_ACT) {
                            Producto = this.tv.PRODUCTO;
                            Motivo = null;
                        } else {
                            Motivo = this.soltv.MOTIVE_ID;
                            Producto = null;
                        }
                        PlanCcialVoz = this.form.PLAN_CCIAL_LB;
                        PlanCcialInt = this.form.PLAN_CCIAL_INT;
                        PlanCcialTV = null;
                        break;
                }

                try {
                    res = await axios.get('/venta/getComercialPlanPaq', {
                        params: {
                            Producto: Producto,
                            Motivo: Motivo,
                            PlanCcialVoz: PlanCcialVoz,
                            PlanCcialInt: PlanCcialInt,
                            PlanCcialTV: PlanCcialTV,
                        }
                    });
                } catch (error) {
                    console.log(error);
                    return false;
                }
                console.log(res.data);
                //this.arrayPlanesComVoz = [];
                //this.arrayPlanesComTv = [];
                //this.arrayPlanesComInternet = [];

                console.log('producto ' + Producto);
                console.log('motivo ' + Motivo);
                console.log('plan comercial voz ' + PlanCcialVoz);
                console.log('plan comercial int ' + PlanCcialInt);
                console.log('plan comercial tv ' + PlanCcialTV);

                switch (this.step) {
                    case 1:
                        if (this.form.INC_VOZ || this.form.INC_SOLVOZ) {
                            this.arrayPlanesComVoz = res.data.planescomm;
                        } else if (this.form.INC_INT || this.form.INC_SOLINT) {
                            this.arrayPlanesComInternet = res.data.planescomm;
                        }
                        break;
                    case 2:
                        if (this.form.INC_INT || this.form.INC_SOLINT) {
                            this.arrayPlanesComInternet = res.data.planescomm;
                        } else if (this.form.INC_TV || this.form.INC_SOLTV) {
                            this.arrayPlanesComTv = res.data.planescomm;
                        }
                        break;
                    case 3:
                        this.arrayPlanesComTv = res.data.planescomm;
                        break;
                }
            }
            this.loading = false;
        },
        getComercialPlanInd: async function (producto) {
            this.loading = true;
            console.log('consultar plan comercial');
            let res;
            try {
                res = await axios.get('/venta/getComercialPlanInd', {
                    params: {
                        producto: producto,
                        estrato: this.form.ESTRATO, //104
                        segmento: this.form.SEGMENTO, //120
                        tipo_cliente: this.form.TIPO_CLIENTE, //99
                    }
                });
            } catch (error) {
                console.log(error);
                return false;
            }
            console.log(res.data);
            switch (producto) {
                case 'voz':
                    this.arrayPlanesComVoz = [];
                    this.arrayPlanesComVoz = res.data.planesind;
                    this.form.PLAN_CCIAL_LB = 0;
                    this.form.PLAN_VTA_LB = 0;
                    break;
                case 'internet':
                    this.arrayPlanesComInternet = [];
                    this.arrayPlanesComInternet = res.data.planesind;
                    this.form.PLAN_CCIAL_INT = 0;
                    this.form.PLAN_VTA_INT = 0;
                    this.form.VELOCIDAD = 0;
                    break;
                case 'tv':
                    this.arrayPlanesComTv = [];
                    this.arrayPlanesComTv = res.data.planesind;
                    this.form.PLAN_CCIAL_TV = 0;
                    this.form.PLAN_VTA_TV = 0;
                    break;
            }
            this.loading = false;
        },
        getSalesPlan: async function (plancomercial, opcion) {
            console.log('consultar plan venta');
            this.loading = true;
            let res;
            try {
                res = await axios.get('/venta/getSalesPlan', {
                    params: {
                        plancomercial: plancomercial
                    }
                });
            } catch (error) {
                console.log(error);
                return false;
            }
            console.log(res.data);
            switch (opcion) {
                case 'voz':
                    this.arrayPlanesVentaVoz = res.data.planes;
                    break;
                case 'internet':
                    this.arrayPlanesVentaInternet = res.data.planes;
                    break;
                case 'tv':
                    this.arrayPlanesVentaTv = res.data.planes;
                    break;
            }
            this.loading = false;

        },

        getVelocidades: async function (plancomercial) {
            console.log('consultar velocidad');
            let res;
            try {
                res = await axios.get('/venta/getVelocidades', {
                    params: {
                        plancomercial: plancomercial
                    }
                });
            } catch (error) {
                console.log(error);
                return false;
            }
            console.log(res.data);
            this.arrayVelocidadesInt = res.data.planes;
        },

        changeTab: function (option) {
            switch (option) {
                case 'voz':
                    this.activeTab = 'voz';
                    break;
                case 'tv':
                    this.activeTab = 'tv';
                    break;
                case 'internet':
                    this.activeTab = 'internet';
                    break;
            }
        },
        valSelTab: function (producto){
            switch (producto) {
                case 'voz':
                    if (!this.form.INC_INT && !this.form.INC_TV) {
                        this.activeTab = 'voz';
                    }
                    break;
                case 'internet':
                    if (!this.form.INC_VOZ && !this.form.INC_TV) {
                        this.activeTab = 'internet';
                    }
                    break;
                case 'tv':
                    if (!this.form.INC_VOZ && !this.form.INC_INT) {
                        this.activeTab = 'tv';
                    }
                    break;
            }
        },

        buscarSolicitudes: async function (fechainicio, fechafin) {
            this.loading = true;
            console.log('consultar solicitudes de vendedor');
            let res;
            try {
                res = await axios.get('/solicitudes/consultar', {
                    params: {
                        fechainicio: fechainicio,
                        fechafin: fechafin
                    }
                });
            } catch (error) {
                console.log(error);
                return false;
            }
            console.log(res.data);
            if (res.data.solicitudes != null) {
                this.arraySolicitudes = res.data.solicitudes;
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'No se encontraron solicitudes',
                    showConfirmButton: true
                })
            }
            this.loading = false;
        },

        getDetalleSolicitudes: async function (fechainicio, fechafin, nombre) {
            this.isOpenDetalle = true;
            console.log('consultar detalle solicitudes de vendedor');
            console.log(nombre);
            let res;
            try {
                res = await axios.get('/solicitudes/detalles', {
                    params: {
                        nombre: nombre,
                        fechainicio: fechainicio,
                        fechafin: fechafin,
                    }
                });
            } catch (error) {
                console.log(error);
                return false;
            }
            console.log(res.data);
            if (res.data.solicitudes != null) {
                this.arrayDetalleSolicitudes = res.data.solicitudes;
            }
        },


    },
    created: function () {

    },
    mounted: function () {

    },
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
