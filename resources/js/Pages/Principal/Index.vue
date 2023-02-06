<template>
    <AppLayout title="Principal" :Vendedor="Vendedor">
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
                                    Menú Principal
                                </h1>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Encabezado y titulo -->

                    <section>
                        <div class="px-4 pb-2 text-center">
                            <div class="flex pt-4">
                                <div class="relative z-0 w-full mb-6 group">
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        ID Vendedor
                                    </label>
                                    {{Vendedor}}
                                </div>
                                <div class="relative z-0 w-full mb-6 group">
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Identificación
                                    </label>
                                    {{ Identificacion }}
                                </div>
                            </div>
                        </div>

                        <div class=" p-4 grid grid-cols-2 gap-4 pb-8 place-items-center">
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
                                    <a :href="route('venta.create')" class="flex items-center w-full space-x-2 text-blue-800 rounded-lg">
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
                                    <a :href="route('velocidad.changeSpeed')" class="flex items-center w-full space-x-2 text-blue-800 rounded-lg">
                                        <span aria-hidden="true" class="p-4 bg-blue-800 text-white rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M3 8.688c0-.864.933-1.405 1.683-.977l7.108 4.062a1.125 1.125 0 010 1.953l-7.108 4.062A1.125 1.125 0 013 16.81V8.688zM12.75 8.688c0-.864.933-1.405 1.683-.977l7.108 4.062a1.125 1.125 0 010 1.953l-7.108 4.062a1.125 1.125 0 01-1.683-.977V8.688z" />
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
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                            </svg>
                                        </span>
                                    </a>
                                    <span>Paquetes</span>
                                </button>
                            </div>
                            <div>
                                <button>
                                    <a :href="route('solicitudes')" class="flex pl-2 items-center w-full space-x-2 text-blue-800 rounded-lg">
                                        <span aria-hidden="true" class="p-4 bg-blue-800 text-white rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                            </svg>
                                        </span>
                                    </a>
                                    <span>Solicitudes</span>
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
import Button from "../../Jetstream/Button";
import Input from "../../Jetstream/Input";

export default {

    components: {
        Input,
        Button,
        AppLayout,
    },
    props:{
        Vendedor: 0,
        Identificacion: 0
    },
    computed: {

    },
    data() {
        return {
        }
    },
    methods: {

    },
    created: function () {
    },
    mounted() {
    },
}
</script>
