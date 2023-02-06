<template>
    <AppLayout title="Ventas" :Vendedor="Vendedor" :localidad="localidad" :localidaddesc="localidaddesc">
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
                    <div @click="closeModal()" class="items-end justify-center min-h-screen pt-4 px-2 pb-4 text-center sm:block sm:p-0">

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
                                <h2 class="text-xl font-bold text-gray-900">Detalle Solicitudes - {{ arrayDetalleSolicitudes[0]?arrayDetalleSolicitudes[0]['ESTADO']:'' }}</h2>
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
import Button from "../../Jetstream/Button";
import Input from "../../Jetstream/Input";

import { SemipolarSpinner } from 'epic-spinners'

export default {

    components: {
        Input,
        Button,
        AppLayout,
        SemipolarSpinner
    },
    props:{
        errors: Object,
        Vendedor: 0,
        localidad: 0,
        localidaddesc: '',
    },
    computed: {
    },
    data() {
        return {
            selectedRow: null,
            loading: false,
            isOpenDetalle: false,
            activeTab: '',
            navState: 'facturacion',
            errorcreacion: '',
            form: {
                fechainicio: '',
                fechafin: ''
            },
            arraySolicitudes: [],
            arrayDetalleSolicitudes: [],
        }
    },
    methods: {
        closeModal: function () {
            this.isOpenDetalle = false;
            this.arrayDetalleSolicitudes = [];
        },
        rowSelect: function (idx) {
            this.selectedRow = idx;
        },
        buscarSolicitudes: async function (fechainicio, fechafin) {
            this.loading = true;
            let res;
            try {
                res = await axios.get('/solicitudes/consultar', {
                    params: {
                        fechainicio: fechainicio,
                        fechafin: fechafin
                    }
                });
            } catch (error) {
                return false;
            }
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
                return false;
            }
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
