<template>
    <AppLayout title="Clientes" :Vendedor="Vendedor" :localidad="localidad" :localidaddesc="localidaddesc">
        <template #header>

        </template>

        <div class="w-full px-0 rounded-lg sm:px-4">
            <!-- Mobile sub header -->
            <div
                class="flex items-center justify-between p-2 bg-white rounded-md text-sm shadow-lg top-16 left-5 right-5"
            >
                <!-- Seetings button -->
                <a href="#facturacion">
                    <button
                        class="p-2 text-white bg-red-600 rounded-lg shadow-md hover:text-white hover:bg-blue-700 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4"
                        :class="{'text-white bg-blue-700': navState == 'facturacion'}"
                    >
                        <span class="">Cambio de velocidad</span>

                    </button>
                </a>
            </div>
        </div>
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
                                    <p class="text-sm">{{ errors.DIRECCION_COBR }}</p>
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
                                    Cambio de velocidad
                                </h1>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Encabezado y titulo -->

                    <section>
                        <div class="px-4 pb-4">
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <form @submit.prevent="getContrato(form.SUBSCRIPTIONID)" @keyup.enter="getContrato(form.SUBSCRIPTIONID)">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <div class="relative w-full">
                                            <input type="text" @change="getContrato(form.SUBSCRIPTIONID)" v-model="form.SUBSCRIPTIONID" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                            <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-blue-900 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                <svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                                <span class="sr-only">Search</span>
                                            </button>
                                        </div>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Contrato
                                        </label>
                                        <div v-if="errors.SUBSCRIPTIONID" class="text-xs text-red-500">{{ errors.SUBSCRIPTIONID }}</div>
                                    </div>
                                </form>
                                <div class="text-bold text-sm">
                                    {{ form.NOMBRE?form.NOMBRE:'' }}
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

<!--                Producto-->
                <div class="bg-white overflow-hidden my-1 shadow-xl rounded-lg">
                    <section>
                        <div class="px-4 py-4">
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 w-full mb-2 group">
                                    <select v-model="form.PRODUCTID" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                        <option v-for="opcion in arrayProductos" :key="opcion.PRODUCTID" :value="opcion.PRODUCTID" v-text="opcion.PRODUCTID + ' - ' + opcion.DESCRIPCION"></option>
                                    </select>
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Producto Internet
                                    </label>
                                    <div v-if="errors.PRODUCTID" class="text-xs text-red-500">{{ errors.PRODUCTID }}</div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
<!--                velocidad -->
                <div class="bg-white overflow-hidden my-1 mb-4 shadow-xl rounded-lg">
                    <section>
                        <div class="px-4 py-4">
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 w-full mb-2 group">
                                    <select v-model="form.VELOCIDAD_NEW" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                        <option value="0" >Seleccione</option>
                                        <option v-for="opcion in arrayVelocidadesInt" :key="opcion.ID" :value="opcion.ID" v-text="opcion.DESCRIPTION"></option>
                                    </select>
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Nueva velocidad
                                    </label>
                                    <div v-if="errors.VELOCIDAD_NEW" class="text-xs text-red-500">{{ errors.VELOCIDAD_NEW }}</div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

            </div>
<!--            botones terminar-->
            <div class="w-full inline-flex">
                <div class="text-left pl-2">
                    <button type="button" @click="prev('autorizacion')" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                        Cancelar
                    </button>
                </div>
                <div class="text-right pr-2 ml-auto">
                    <button type="button" @click="save(form)" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center">
                        Registrar
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Ventana modal loading -->
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
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
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
    },
    computed: {

    },
    data() {
        return {
            loading: false,
            navState: 'facturacion',
            errorcreacion: '',
            tituloModal: '',
            arrayProductos:[],
            form: {
                SUBSCRIPTIONID: '',
                NOMBRE: '',
                PRODUCTID: '',
                DESCRIPCION: '',
                VELOCIDAD: 0,
                PLAN_CCIAL_INT: 0,
                VELOCIDAD_NEW: 0,
                PLANFACT: 0
            }
        }
    },
    methods: {
        reset: function () {
            this.form.SUBSCRIPTIONID = '';
            this.form.NOMBRE = '';
            this.form.PRODUCTID = '';
            this.form.DESCRIPCION = '';
            this.form.VELOCIDAD = 0;
            this.form.PLAN_CCIAL_INT = 0,
            this.form.VELOCIDAD_NEW = 0;
            this.form.PLANFACT = 0;

            this.errors.SUBSCRIPTIONID = '';
            this.errors.NOMBRE = '';
            this.errors.PRODUCTID = '';
            this.errors.DESCRIPCION = '';
            this.errors.VELOCIDAD = 0;
            this.errors.PLAN_CCIAL_INT = 0;
            this.errors.VELOCIDAD_NEW = 0;
            this.errors.PLANFACT = 0;
        },


        save: async function (form) {
            let statuserror = true;
            this.isValidategeneral = false;

            if (this.form.SUBSCRIPTIONID == 0) {
                statuserror =  false;
                this.errors.SUBSCRIPTIONID = 'Ingrese un contrato';
            } else {
                this.errors.SUBSCRIPTIONID = null;
            }

            if (!(this.form.PRODUCTID > 0)) {
                statuserror =  false;
                this.errors.PRODUCTID = 'No se ha encontrado un producto válido';
            } else {
                this.errors.PRODUCTID = null;
            }

            if (this.form.VELOCIDAD_NEW == '' && this.form.VELOCIDAD_NEW == 0) {
                statuserror =  false;
                this.errors.VELOCIDAD_NEW = 'Seleccione una nueva velocidad';
            } else {
                this.errors.VELOCIDAD_NEW = null;
            }

            if (this.form.VELOCIDAD_NEW == this.form.VELOCIDAD) {
                statuserror =  false;
                this.errors.VELOCIDAD_NEW = 'La velocidad nueva es igual a la actual';
            } else {
                this.errors.VELOCIDAD_NEW = null;
            }

            if (!statuserror) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ingrese la información solicitada',
                    showConfirmButton: true,
                })
                return false;
            }
            this.$nextTick(() => {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            });

            console.log('creación de solicitud de cambio de velocidad');
            this.loading = true;
            let res;
            try {
                res = await axios.get('/velocidad/store', {
                    params: {
                        PRODUCTO_CAMVELOCIDAD: this.form.PRODUCTID,
                        VELOCIDAD_NUEVA: this.form.VELOCIDAD_NEW
                    }
                });
            } catch (error) {
                console.log(error);
                this.loading = false;
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
        getContrato: async function (contrato) {
            this.loading = true;
            console.log('consultar contrato');
            let res;
            try {
                res = await axios.get('/cliente/getContrato', {
                    params: {
                        contrato: contrato
                    }
                });
            } catch (error) {
                this.loading = false;
                console.log(error);
                return false;
            }
            console.log(res.data.data);
            if (res.data.data != null) {
                this.form = res.data.contrato;
                this.arrayProductos = res.data.data;
                this.getVelocidadesCambio(this.form.PLANFACT);
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'No se encontró producto de Internet para el contrato',
                    showConfirmButton: true
                })
            }
            this.loading = false;
        },

        getVelocidadesCambio: async function (planfact) {
            console.log('consultar velocidad cambio');
            this.loading = true;
            let res;
            try {
                res = await axios.get('/venta/getVelocidadesCambio', {
                    params: {
                        PLANFACT: planfact
                    }
                });
            } catch (error) {
                this.loading = false;
                console.log(error);
                return false;
            }
            console.log(res.data);
            this.loading = false;
            this.arrayVelocidadesInt = res.data.velocidades;
        },

    },
    created: function () {

    },
    mounted: function () {

    },
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
