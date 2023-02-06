<template>
    <AppLayout title="Clientes" :Vendedor="Vendedor">
        <template #header>

        </template>

        <div class="w-full px-0 rounded-lg sm:px-4">
            <!-- Mobile sub header -->
            <div
                class="flex items-center justify-between p-2 bg-white rounded-md text-sm shadow-lg top-16 left-5 right-5"
            >
                <!-- Seetings button -->
                <button
                    @click="prev('referencias')"
                    class="p-2 text-white bg-red-600 rounded-lg shadow-md hover:text-white hover:bg-blue-700 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4"
                    :class="{'text-white bg-blue-700': navState == 'general'}"
                >
                    <span class="">General</span>

                </button>
                <!-- Messages button -->
                <button
                    @click="next('general')"
                    class="p-2 text-white bg-red-600 rounded-lg shadow-md hover:text-white hover:bg-blue-700 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4"
                    :class="{'text-white bg-blue-700': navState == 'referencias'}"
                >
                    <span class="">Referencias</span>
                </button>
                <!-- Notifications button -->
                <button
                    @click="isValidategeneral?next('referencias'):next('general')"
                    class="p-2 text-white bg-red-600 rounded-lg shadow-md hover:text-white hover:bg-blue-700 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4"
                    :class="{'text-white bg-blue-700': navState == 'empresa'}"
                >
                    <span class="">Empresa</span>
                </button>
                <!-- Github link -->
                <a
                    @click="isValidategeneral?next('empresa'):next('general')"
                    class="p-2 text-white bg-red-600 rounded-lg shadow-md hover:text-white hover:bg-blue-700 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4"
                    :class="{'text-white bg-blue-700': navState == 'autorizacion'}"
                >
                    <span class="">Autorización</span>
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
                <div v-if="navState == 'general'" class="bg-white overflow-hidden shadow-xl rounded-lg">
                    <!-- Mensajes Flash -->
                    <section>
                        <div @click="cleanMessage()" mx-auto class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-3 shadow-md my-3" role="alert" v-show="$page.props.flash.message">
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
                                    Registrar Cliente - General
                                </h1>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Encabezado y titulo -->

                    <section>
                        <div class="px-4 pb-4">
                            <form @submit.prevent="getUsers('', '', form)" @keyup.enter="getUsers('', '', form)">
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Tipo de cliente
                                        </label>
                                        <select class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" v-model="form.TIPO_CLIENTE">
                                            <option value="0" >Seleccione</option>
                                            <option v-for="opcion in arrayTiposclientes" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                        </select>
                                        <div v-if="errors.TIPO_CLIENTE" class="text-xs text-red-500">{{ errors.TIPO_CLIENTE }}</div>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <select class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" v-model="form.TIPO_IDENT">
                                            <option value="0" >Seleccione</option>
                                            <option v-for="opcion in arrayTiposdocumento" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Tipo de identificación
                                        </label>
                                        <div v-if="errors.TIPO_IDENT" class="text-xs text-red-500">{{ errors.TIPO_IDENT }}</div>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" @change="getCliente(form.TIPO_CLIENTE, form.TIPO_IDENT, form.IDENTIFICACION)" v-model="form.IDENTIFICACION" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Documento
                                        </label>
                                        <div v-if="errors.IDENTIFICACION" class="text-xs text-red-500">{{ errors.IDENTIFICACION }}</div>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.NOMBRE" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Nombres
                                        </label>
                                        <div v-if="errors.NOMBRE" class="text-xs text-red-500">{{ errors.NOMBRE }}</div>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.APELLIDO" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Apellidos
                                        </label>
                                        <div v-if="errors.APELLIDO" class="text-xs text-red-500">{{ errors.APELLIDO }}</div>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.TEL_MOVIL" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Teléfono movil
                                        </label>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.EMAIL" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Correo
                                        </label>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <select class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" v-model="form.SEGMENTO">
                                            <option value="0" >Seleccione</option>
                                            <option v-for="opcion in arraySegmentos" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Segmento
                                        </label>
                                        <div v-if="errors.SEGMENTO" class="text-xs text-red-500">{{ errors.SEGMENTO }}</div>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.NOMBRE_CONTACT" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Nombre contacto
                                        </label>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.DIR_CONTACT" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Dirección contacto
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.TEL_CONTACT" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Teléfono contacto
                                        </label>
                                    </div>
                                </div>
                                <div class="w-full inline-flex">
                                    <div class="text-right pr-2 ml-auto">
                                        <button type="button" @click="next('general')" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center">
                                            Siguiente
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>


                </div>

                <div v-if="navState == 'referencias'" class="bg-white overflow-hidden shadow-xl rounded-lg">
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
                                    Registrar Cliente - Referencias
                                </h1>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Encabezado y titulo -->

                    <section>
                        <div class="px-4 pb-4">
                            <form @submit.prevent="getUsers('', '', form)" @keyup.enter="getUsers('', '', form)">
                                <div class="grid xl:grid-cols-2 xl:gap-6 border-2 p-2 rounded-md">
                                    <span class="text-sm text-bold ml-auto text-blue-500 dark:text-gray-400peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Referencia 1
                                    </span>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.NOMBRE_REF_1" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Nombres
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.APELLIDO_REF_1" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Apellidos
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.IDENTIF_REF_1" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Documento
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.TEL_REF_1" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Teléfono movil
                                        </label>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6 border-2 p-2 rounded-md">
                                    <span class="text-sm text-bold ml-auto text-blue-500 dark:text-gray-400peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Referencia 2
                                    </span>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.NOMBRE_REF_2" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Nombres
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.APELLIDO_REF_2" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Apellidos
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.IDENTIF_REF_2" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Documento
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.TEL_REF_2" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Teléfono movil
                                        </label>
                                    </div>
                                </div>
                                <div class="w-full inline-flex mt-2">
                                    <div class="text-left pl-2">
                                        <button type="button" @click="prev('referencias')" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                            </svg>
                                            Anterior
                                        </button>
                                    </div>
                                    <div class="text-right pr-2 ml-auto">
                                        <button type="button" @click="next('referencias')" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center">
                                            Siguiente
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>


                </div>

                <div v-if="navState == 'empresa'" class="bg-white overflow-hidden shadow-xl rounded-lg">
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
                                    Registrar Cliente - Empresa
                                </h1>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Encabezado y titulo -->

                    <section>
                        <div class="px-4 pb-4">
                            <form @submit.prevent="getUsers('', '', form)" @keyup.enter="getUsers('', '', form)">
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.CANT_EMPLEADOS" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Cantidad de empleados
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.CANT_SUCURSALES" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Número de sedes
                                        </label>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.CANT_PC" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Cantidad de PCs
                                        </label>
                                    </div>
                                </div>
                                <div class="w-full inline-flex">
                                    <div class="text-left pl-2">
                                        <button type="button" @click="prev('empresa')" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                            </svg>
                                            Anterior
                                        </button>
                                    </div>
                                    <div class="text-right pr-2 ml-auto">
                                        <button type="button" @click="next('empresa')" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center">
                                            Siguiente
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>


                </div>

                <div v-if="navState == 'autorizacion'" class="bg-white overflow-hidden shadow-xl rounded-lg">
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
                                    Registrar Cliente - Autorización
                                </h1>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Encabezado y titulo -->

                    <section>
                        <div class="px-4 pb-4">
                            <form @submit.prevent="getUsers('', '', form)" @keyup.enter="getUsers('', '', form)">
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="pl-8 flex w-full mb-6 group">
                                        <div class="">
                                            <Toggle v-model="form.AUTORIZA"/>
                                        </div>
                                        <label class="pl-4 text-sm text-gray-500 dark:text-gray-400 peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Autoriza?
                                        </label>
                                        <div v-if="errors.AUTORIZA" class="text-xs text-red-500">{{ errors.AUTORIZA }}</div>
                                    </div>
                                    <div class="pl-8 flex w-full mb-6 group">
                                        <div class="">
                                            <Toggle v-model="form.MED_ESCRITO"/>
                                        </div>
                                        <label class="pl-4 text-sm text-gray-500 dark:text-gray-400 peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Contacto por Comunic. Escrita?
                                        </label>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="pl-8 flex w-full mb-6 group">
                                        <div class="">
                                            <Toggle v-model="form.MED_SMS"/>
                                        </div>
                                        <label class="pl-4 text-sm text-gray-500 dark:text-gray-400 peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Contacto por SMS?
                                        </label>
                                    </div>
                                    <div class="pl-8 flex w-full mb-6 group">
                                        <div class="">
                                            <Toggle v-model="form.MED_EMAIL"/>
                                        </div>
                                        <label class="pl-4 text-sm text-gray-500 dark:text-gray-400 peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Contacto por E-Mail?
                                        </label>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="pl-8 flex w-full mb-6 group">
                                        <div class="">
                                            <Toggle v-model="form.MED_TELEMERCADEO"/>
                                        </div>
                                        <label class="pl-4 text-sm text-gray-500 dark:text-gray-400 peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Contacto por Telemercadeo?
                                        </label>
                                    </div>
                                    <div class="pl-8 flex w-full mb-6 group">
                                        <div class="">
                                            <Toggle v-model="form.MED_RED_SOCIAL"/>
                                        </div>
                                        <label class="pl-4 text-sm text-gray-500 dark:text-gray-400 peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Contacto por Redes Sociales?
                                        </label>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="pl-8 flex w-full mb-6 group">
                                        <div class="">
                                            <Toggle />
                                        </div>
                                        <label class="pl-4 text-sm text-gray-500 dark:text-gray-400 peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Consulta centrales de riesgo?
                                        </label>
                                    </div>
                                </div>
                                <div class="w-full inline-flex">
                                    <div class="text-left pl-2">
                                        <button type="button" @click="prev('autorizacion')" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                            </svg>
                                            Anterior
                                        </button>
                                    </div>
                                    <div class="text-right pr-2 ml-auto">
                                        <button type="button" @click="save(form)" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center">
                                            Guardar
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>


                </div>

            </div>

            <!-- Ventana modal dirección de loading -->
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
            <!-- Fin Ventana modal dirección de loading -->
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayoutapp2.vue';
import Swal from "sweetalert2";
import Toggle from '@vueform/toggle';
import '@vueform/toggle/themes/default.css';
import Button from "../../Jetstream/Button";
import NavLink from "../../Jetstream/NavLink";
import Input from "../../Jetstream/Input";
import { SemipolarSpinner } from 'epic-spinners'

export default {

    components: {
        Input,
        NavLink,
        Button,
        AppLayout,
        Toggle,
        SemipolarSpinner
    },
    props:{
        errors: Object,
        Vendedor: 0
    },
    computed: {

    },
    data() {
        return {
            loading: false,
            navState: 'general',
            errorcreacion: '',
            isValidategeneral: false,
            isValidatereferencias: false,
            isValidateempresa: false,
            isValidateautorizacion: false,
            form: {
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
        }
    },
    methods: {
        reset: function () {
            this.form.NOMBRE = '';
            this.form.APELLIDO = '';
            this.form.IDENTIFICACION = '';
            this.form.TIPO_IDENT = 0;
            this.form.TIPO_CLIENTE = 0;
            this.form.SEGMENTO = 0;
            this.form.TELEFONO = '';
            this.form.DIRECCION = '';
            this.form.NOMBRE_CONTACT = '';
            this.form.TEL_CONTACT = '';
            this.form.DIR_CONTACT = '';
            this.form.EMAIL = '';
            this.form.TEL_MOVIL = '';
            this.form.CANT_EMPLEADOS = 0;
            this.form.CANT_SUCURSALES = 0;
            this.form.CANT_PC = 0;
            this.form.MEDIO_RECEPCION = 0;
            this.form.ID_LLAMADA = 0;
            this.form.AUTORIZA = false;
            this.form.MED_ESCRITO = false;
            this.form.MED_SMS = false;
            this.form.MED_EMAIL = false;
            this.form.MED_TELEMERCADEO = false;
            this.form.MED_RED_SOCIAL = false;
            this.form.VENDEDOR = false;

            this.errorcreacion = false;
            this.navState = 'general';
            this.isValidategeneral = false;

            this.errors.NOMBRE = null;
            this.errors.APELLIDO = null;
            this.errors.IDENTIFICACION = null;
            this.errors.TIPO_IDENT = null;
            this.errors.TIPO_CLIENTE = null;
            this.errors.SEGMENTO = null;
            this.errors.TELEFONO = null;
            this.errors.DIRECCION = null;
            this.errors.NOMBRE_CONTACT = null;
            this.errors.TEL_CONTACT = null;
            this.errors.DIR_CONTACT = null;
            this.errors.EMAIL = null;
            this.errors.TEL_MOVIL = null;
            this.errors.CANT_EMPLEADOS = null;
            this.errors.CANT_SUCURSALES = null;
            this.errors.CANT_PC = null;
            this.errors.MEDIO_RECEPCION = null;
            this.errors.ID_LLAMADA = null;
            this.errors.AUTORIZA = null;
            this.errors.MED_ESCRITO = null;
            this.errors.MED_SMS = null;
            this.errors.MED_EMAIL = null;
            this.errors.MED_TELEMERCADEO = null;
            this.errors.MED_RED_SOCIAL = null;
            this.errors.VENDEDOR = null;
        },
        reset2: function () {
            this.form.NOMBRE = '';
            this.form.APELLIDO = '';
            this.form.SEGMENTO = 0;
            this.form.TELEFONO = '';
            this.form.DIRECCION = '';
            this.form.NOMBRE_CONTACT = '';
            this.form.TEL_CONTACT = '';
            this.form.DIR_CONTACT = '';
            this.form.EMAIL = '';
            this.form.TEL_MOVIL = '';
            this.form.CANT_EMPLEADOS = 0;
            this.form.CANT_SUCURSALES = 0;
            this.form.CANT_PC = 0;
            this.form.MEDIO_RECEPCION = 0;
            this.form.ID_LLAMADA = 0;
            this.form.AUTORIZA = false;
            this.form.MED_ESCRITO = false;
            this.form.MED_SMS = false;
            this.form.MED_EMAIL = false;
            this.form.MED_TELEMERCADEO = false;
            this.form.MED_RED_SOCIAL = false;
            this.form.VENDEDOR = false;

            this.errors.NOMBRE = null;
            this.errors.APELLIDO = null;
            this.errors.IDENTIFICACION = null;
            this.errors.TIPO_IDENT = null;
            this.errors.TIPO_CLIENTE = null;
            this.errors.SEGMENTO = null;
            this.errors.TELEFONO = null;
            this.errors.DIRECCION = null;
            this.errors.NOMBRE_CONTACT = null;
            this.errors.TEL_CONTACT = null;
            this.errors.DIR_CONTACT = null;
            this.errors.EMAIL = null;
            this.errors.TEL_MOVIL = null;
            this.errors.CANT_EMPLEADOS = null;
            this.errors.CANT_SUCURSALES = null;
            this.errors.CANT_PC = null;
            this.errors.MEDIO_RECEPCION = null;
            this.errors.ID_LLAMADA = null;
            this.errors.AUTORIZA = null;
            this.errors.MED_ESCRITO = null;
            this.errors.MED_SMS = null;
            this.errors.MED_EMAIL = null;
            this.errors.MED_TELEMERCADEO = null;
            this.errors.MED_RED_SOCIAL = null;
            this.errors.VENDEDOR = null;
        },


        save: async function (Xmlcliente) {
            if (this.form.AUTORIZA== null ||this.form.AUTORIZA == '') {
                this.form.AUTORIZA = 'N';
            } else {
                this.form.AUTORIZA = 'Y';
            }
            if (this.form.MED_ESCRITO == null ||this.form.MED_ESCRITO == '') {
                this.form.MED_ESCRITO = 'N';
            } else {
                this.form.MED_ESCRITO = 'Y';
            }
            if (this.form.MED_SMS == null ||this.form.MED_SMS == '') {
                this.form.MED_SMS = 'N';
            } else {
                this.form.MED_SMS = 'Y';
            }
            if (this.form.MED_EMAIL== null ||this.form.MED_EMAIL == '') {
                this.form.MED_EMAIL = 'N';
            } else {
                this.form.MED_EMAIL = 'Y';
            }
            if (this.form.MED_TELEMERCADEO == null ||this.form.MED_TELEMERCADEO == '') {
                this.form.MED_TELEMERCADEO = 'N';
            } else {
                this.form.MED_TELEMERCADEO = 'Y';
            }
            if (this.form.MED_RED_SOCIAL == null ||this.form.MED_RED_SOCIAL == '') {
                this.form.MED_RED_SOCIAL = 'N';
            } else {
                this.form.MED_RED_SOCIAL = 'Y';
            }

            let statuserror = true;

            if (this.form.AUTORIZA) {
                if (!this.form.MED_ESCRITO && !this.form.MED_SMS && !this.form.MED_EMAIL && !this.form.MED_TELEMERCADEO && !this.form.MED_RED_SOCIAL) {
                    statuserror =  false;
                    this.errors.AUTORIZA = 'Seleccione al menos un método de envío';
                }
            } else {
                this.errors.AUTORIZA = null;
            }

            if (!statuserror) {
                Swal.fire({
                    icon: 'warning',
                    title: this.errors.AUTORIZA,
                    showConfirmButton: true,
                })
                return false;
            }
            this.loading = true;
            let res;
            try {
                res = await axios.get('/cliente/store', {
                    params: {
                        Xmlcliente: Xmlcliente
                    }
                });
            } catch (error) {
                this.loading = false;
                return false;
            }

            let resultado = res.data;

            if (resultado.codigo == 0) {
                Swal.fire({
                    icon: 'success',
                    title: 'El cliente ' + resultado.id + ' ha sido creado satisfactoriamente',
                    showConfirmButton: false,
                    timer: 2000
                })
                this.reset();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error registrando el cliente',
                    showConfirmButton: true,
                })
                this.errorcreacion = resultado.mensaje;
            }
            this.loading = false;
        },
        getCliente: async function (tipocliente, tipoident, identificacion) {
            this.loading = true;
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
                this.loading = false;
                return false;
            }
            if (res.data.data) {
                if (res.data.data[0].SUBSCRIBER_ID > 0) {
                    this.form = res.data.data[0];
                    Swal.fire({
                        icon: 'warning',
                        title: 'El cliente ya existe',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            } else {
                Swal.fire({
                    icon: 'success',
                    title: 'El cliente no existe',
                    showConfirmButton: false,
                    timer: 1500
                })
                this.reset2();
            }
            this.loading = false;
        },
        next: function (option) {
            switch (option) {
                case 'general':
                    let statuserror = true;
                    this.isValidategeneral = false;

                    if (this.form.TIPO_CLIENTE == 0) {
                        statuserror =  false;
                        this.errors.TIPO_CLIENTE = 'Seleccione el tipo de cliente';
                    } else {
                        this.errors.TIPO_CLIENTE = null;
                    }

                    if (this.form.TIPO_IDENT == 0) {
                        statuserror =  false;
                        this.errors.TIPO_IDENT = 'Seleccione el tipo de identificación';
                    } else {
                        this.errors.TIPO_IDENT = null;
                    }

                    if (this.form.IDENTIFICACION == '') {
                        statuserror =  false;
                        this.errors.IDENTIFICACION = 'Ingrese el nombre de documento';
                    } else {
                        this.errors.IDENTIFICACION = null;
                    }

                    if (this.form.NOMBRE == '') {
                        statuserror =  false;
                        this.errors.NOMBRE = 'Ingrese el nombre';
                    } else {
                        this.errors.NOMBRE = null;
                    }

                    if (this.form.APELLIDO  == '') {
                        statuserror =  false;
                        this.errors.APELLIDO = 'Ingrese el apellido';
                    } else {
                        this.errors.APELLIDO = null;
                    }
                    if (this.form.SEGMENTO  == 0) {
                        statuserror =  false;
                        this.errors.SEGMENTO = 'Seleccione el segmento';
                    } else {
                        this.errors.SEGMENTO = null;
                    }

                    if (!statuserror) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ingrese la información solicitada',
                            showConfirmButton: true,
                        })
                        break;
                    }
                    this.navState = 'referencias';
                    this.isValidategeneral = true;
                    this.$nextTick(() => {
                        document.body.scrollTop = 0;
                        document.documentElement.scrollTop = 0;
                    });

                    break;
                case 'referencias':
                    this.navState = 'empresa';
                    this.isValidatereferencias = true;
                    break;
                case 'empresa':
                    if (this.form.CANT_EMPLEADOS== null ||this.form.CANT_EMPLEADOS == '') {
                        this.form.CANT_EMPLEADOS = 0;
                    }
                    if (this.form.CANT_SUCURSALES == null ||this.form.CANT_SUCURSALES == '') {
                        this.form.CANT_SUCURSALES = 0;
                    }
                    if (this.form.CANT_PC == null ||this.form.CANT_PC == '') {
                        this.form.CANT_PC = 0;
                    }
                    this.navState = 'autorizacion';
                    this.isValidateempresa = true;
                    break;
                case 'autorizacion':
                    this.navState = 'save';
                    this.isValidateautorizacion;
                    break;
            }
        },
        prev: function (option) {
            switch (option) {
                case 'referencias':
                    this.navState = 'general';
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                    break;
                case 'empresa':
                    this.navState = 'referencias';
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                    break;
                case 'autorizacion':
                    this.navState = 'empresa';
                    document.body.scrollTop = 0;
                    document.documentElement.scrollTop = 0;
                    break;
            }
        }
    },
    created: async function () {
        await this.getTiposdocumento();
        await this.getTipoCliente();
        await this.getSegmentos();
    },
    mounted: function () {

    },
}
</script>
