<template>
    <AppLayout title="Usuarios" :Vendedor="Vendedor">
        <template #header>

        </template>
        <div class="w-full pt-2 px-2 rounded-lg lg:px-4 md:px-2 sm:px-2">
            <div class="mx-auto 2xl:8">
                <div class="bg-white overflow-hidden shadow-xl rounded-lg">
                    <!-- Mensajes Flash -->
                    <section>
                        <div @click="cleanMessage()" mx-auto class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-show="$page.props.flash.message">
                            <div class="flex">
                                <div>
                                    <p class="text-sm">{{ $page.props.flash.message }}</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Mensajes Flash -->
                    <!-- Encabezado y titulo -->
                    <section>
                        <div class="flex justify-between mx-auto p-4">
                            <div class="w-full">
                                <h1 class="font-bold text-xl text-black-800 leading-tight">
                                    Menú principal
                                </h1>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Encabezado y titulo -->

                    <section>
                        <div class="px-4 pb-2 text-center">
                            <div class="flex pt-4">
                                <div class="relative z-0 w-full mb-6 group">
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        ID Vendedor
                                    </label>
                                    {{Vendedor}}
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Identificación
                                    </label>
                                    {{ Identificacion }}
                                </div>
                            </div>
                        </div>

                        <div class=" p-4 grid grid-cols-2 gap-4 place-items-center">
                            <div>
                                <button>
                                    <a :href="route('cliente.create')" class="flex items-center w-full space-x-2 text-blue-800 rounded-lg">
                                        <span aria-hidden="true" class="p-4 bg-blue-800 text-white rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                            </svg>
                                        </span>
                                    </a>
                                    <span>Clientes</span>
                                </button>
                            </div>
                            <div>
                                <button>
                                    <a :href="route('ventas.crear')" class="flex items-center w-full space-x-2 text-blue-800 rounded-lg">
                                        <span aria-hidden="true" class="p-4 bg-blue-800 text-white rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                            </svg>
                                        </span>
                                    </a>
                                    <span>Ventas</span>
                                </button>
                            </div>
                            <div>
                                <button>
                                    <a :href="route('cliente.create')" class="flex items-center w-full space-x-2 text-blue-800 rounded-lg">
                                        <span aria-hidden="true" class="p-4 bg-blue-800 text-white rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                                        </span>
                                    </a>
                                    <span>Contratos</span>
                                </button>
                            </div>
                            <div>
                                <button>
                                    <a :href="route('velocidad.changeSpeed')" class="flex items-center w-full space-x-2 text-blue-800 rounded-lg">
                                        <span aria-hidden="true" class="p-4 bg-blue-800 text-white rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                            </svg>
                                        </span>
                                    </a>
                                    <span>Cambios<br>velocidad</span>
                                </button>
                            </div>
                            <div>
                                <button>
                                    <a :href="route('venta.paquete')" class="flex items-center w-full space-x-2 text-blue-800 rounded-lg">
                                        <span aria-hidden="true" class="p-4 bg-blue-800 text-white rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                                            </svg>
                                        </span>
                                    </a>
                                    <span>Paquetes</span>
                                </button>
                            </div>
                            <div>
                                <button>
                                    <a :href="route('cliente.create')" class="flex items-center w-full space-x-2 text-blue-800 rounded-lg">
                                        <span aria-hidden="true" class="p-4 bg-blue-800 text-white rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </span>
                                    </a>
                                    <span>Productos</span>
                                </button>
                            </div>
                        </div>
                    </section>


                </div>
            </div>
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

    },
    props:{
        users : [],
        errors: Object,
        Vendedor: 0,
        Identificacion: 0
    },
    computed: {

    },
    data() {
        return {
            tituloModal: '',
            formpasswd: {
                _token: usePage().props.value._token,
                id: '',
                password: '',
                password_confirmation: '',
            },
            form: {
                id: null,
                nombre: '',
                correo: null,
                username: null,
                apellido: null,
                idrol: 0,
                estado: 0,
                idtipos_documento: 0,
                documento: null,
                direccion: 0,
                indicativo: 0,
                iddepartamento: 0,
                idciudad: 0,
                idpais: 0,
                observaciones: null,
                movil: null,
                isnatural: 0,
                camaracomercio: false,
                rut: false,
                url: false,
                cambiarpassword: true
            },
        }
    },
    methods: {
        cambiarPass: function(){
            this.isOpencambiopass = true;
        } ,
        updatePass: function(data) {
            this.$inertia.post('/changepasssu', data, {
                onSuccess: (page) => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Se ha cambiado la contraseña',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.formpasswd.id = 0;
                    this.formpasswd.password = '';
                    this.formpasswd.password_confirmation = '';
                    this.isOpencambiopass = false;
                    this.getUsers('','nombre');
                    this.editMode = false;
                    this.closeModal();
                },
            });
        },
        openModal: function (accion, data = []) {
            this.isOpen = true;

            switch (accion) {
                case 'registrar':
                {
                    this.reset();
                    this.tituloModal = 'Crear nuevo Usuario';
                    this.form.idpais = 0;
                    this.form.iddepartamento = 0;
                    this.form.idciudad = 0;
                    this.form.idtipos_documento = 0;
                    this.form.idrol = 0;
                    this.form.idempresa = 0;
                    this.getRoles();
                    this.getPaises();
                    this.getCiudades();
                    this.getDepartamentos();
                    this.getTiposdocumento();
                    this.newMode = true;
                    this.verMode = false;
                    this.editMode = false;
                    break;
                }
                case 'ver': {
                    this.tituloModal = 'Ver Usuario ' + data['username'];
                    this.form.idpais = data['idpais'];
                    this.form.iddepartamento = data['iddepartamento'];
                    this.form.idciudad = data['idciudad'];
                    this.form.idtipos_documento = data['idtipos_documento'];
                    this.form.idrol = data['idrol'];
                    this.form.idempresa = data['idempresa'];
                    this.form.nombre = data['nombre'];
                    this.form.apellido = data['apellido'];
                    this.form.correo = data['correo'];
                    this.form.movil = data['movil'];
                    this.form.documento = data['documento'];
                    this.form.username = data['username'];
                    this.form.direccion = data['direccion'];
                    this.form.telefono = data['telefono'];
                    this.getRoles();
                    this.getPaises();
                    this.getCiudades();
                    this.getDepartamentos();
                    this.getTiposdocumento();
                    this.getEmpresas();
                    this.newMode = false;
                    this.verMode = true;
                    this.editMode = false;
                    break;
                    break;
                }
                case 'actualizar': {
                    this.form.id = data['id'];
                    this.tituloModal = 'Actualizar Usuario ' + data['username'];
                    this.form.idpais = data['idpais'];
                    this.form.iddepartamento = data['iddepartamento'];
                    this.form.idciudad = data['idciudad'];
                    this.form.idtipos_documento = data['idtipos_documento'];
                    this.form.idrol = data['idrol'];
                    this.form.idempresa = data['idempresa'];
                    this.form.nombre = data['nombre'];
                    this.form.apellido = data['apellido'];
                    this.form.correo = data['correo'];
                    this.form.movil = data['movil'];
                    this.form.documento = data['documento'];
                    this.form.username = data['username'];
                    this.form.direccion = data['direccion'];
                    this.form.telefono = data['telefono'];
                    this.getRoles();
                    this.getPaises();
                    this.getCiudades();
                    this.getDepartamentos();
                    this.getTiposdocumento();
                    this.getEmpresas();
                    this.newMode = false;
                    this.verMode = false;
                    this.editMode = true;
                    break;
                    break;
                }

            }
        },
        closeModal: function () {
            this.isOpen = false;
            this.reset();
            this.editMode = false;
            this.verMode  = false;
            this.$page.props.errors = [];
        },
        closeModalPass: function () {
            this.isOpencambiopass = false
            this.$page.props.errors.updatePassword = null;
        },
        reset: function () {
            this.tituloModal = '';
            this.form.id = null;
            this.form.nombre = null;
            this.form.documento = null;
            this.form.apellido = null;
            this.form.correo = null;
            this.form.telefono = null;
            this.form.movil = null;
            this.form.username = null;
            this.form.password = null;
            this.form.idpais = 0;
            this.form.iddepartamento = 0;
            this.form.idciudad = 0;
            this.form.direccion = null;
            this.form.idrol = 0;
            this.form.idempresa = null;
        },
        save: function (data) {
            this.$inertia.post('/users', data, {
                onSuccess: (page) => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'El usuario se ha creado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.reset();
                    this.closeModal();
                    this.getUsers('','nombre');
                    this.editMode = false;
                },
            });

        },
        edit: function (data) {
            //this.form = Object.assign({}, data);
            this.editMode = true;
            //console.log(this.form);
            this.formpasswd.id = data['id'];
            this.openModal('actualizar', data);
        },
        ver: function (data) {
            this.verMode = true;
            this.openModal('ver', data);
        },
        update: function (data) {
            data._method = 'PUT';
            this.$inertia.post('/users/'  + data.id, data, {
                onSuccess: (page) => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'El usuario se ha actualizado!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.getUsers('','nombre');
                    this.closeModal();
                    this.reset();
                    this.editMode = false;
                    this.verMode = false;
                    this.newMode = false;
                },
            });

        },
        getUsers: function (buscar, sortBy, filtros = []) {
            this.buscar = buscar;

            if (sortBy == this.sortBy){
                this.sortOrder = !this.sortOrder;
            }
            let sortOrderdesc;
            if (this.sortOrder){
                sortOrderdesc = 'asc';
            } else {
                sortOrderdesc = 'desc';
            }
            this.sortBy = sortBy;
            this.ispage = true;

            var url= '/users';
            axios.get(url, {
                params: {
                    filtros: filtros,
                    buscar: this.buscar,
                    sortBy: this.sortBy,
                    sortOrder: sortOrderdesc,
                    ispage: this.ispage
                }
            }).then((res) => {
                var respuesta = res.data;
                this.arrayData = respuesta.users;
            })
        },
        UsersExport: function (filtros = []) {
            let fecha = moment(new Date()).format('DDMMYYYY');
            var url= '/users/export';
            axios.get(url, {
                params: {
                    filtros: filtros,
                },
                responseType: 'blob',
            }).then((response) => {
                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement('a');

                fileLink.href = fileURL;
                fileLink.setAttribute('download', 'users_'+ fecha + '.xlsx');
                document.body.appendChild(fileLink);

                fileLink.click();
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
                    //(error);
                });
            })

        },
    },
    created: function () {
    },
    mounted() {
    },
}
</script>
