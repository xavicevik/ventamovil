<template>
    <AppLayout title="Clientes" :Vendedor="Vendedor" :localidad="localidad" :localidaddesc="localidaddesc">
        <template #header>

        </template>

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
                    <span class="">Facturación</span>

                </button>
            </a>
            <!-- Messages button -->
            <a href="#localizacion">
                <button
                    class="p-2 text-white bg-red-600 rounded-lg shadow-md hover:text-white hover:bg-blue-700 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4"
                    :class="{'text-white bg-blue-700': navState == 'localizacion'}"
                >
                    <span class="">Localización</span>
                </button>
            </a>
            <!-- Notifications button -->
            <a href="#productos">
                <button
                    class="p-2 text-white bg-red-600 rounded-lg shadow-md hover:text-white hover:bg-blue-700 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4"
                    :class="{'text-white bg-blue-700': navState == 'productos'}"
                >
                    <span class="">Productos</span>
                </button>
            </a>
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
        <section v-if="false">
            <!-- validateRifa <form> -->
            <div class="bg-white fixed h-screen items-center pb-1 mx-auto items-center w-full">
                <div class="">
                    <!-- Formulario -->
                    <section>
                        <div class="absolute mt-10 w-full" id="appx">
                            <semipolar-spinner class="mt-10 mx-auto" :animation-duration="2000" :size="85" color="#ff1d5e" />
                        </div>
                    </section>
                    <!-- Fin formulario -->
                </div>
            </div>
            <!-- </form> -->
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
                                    Registrar Ventas - {{ localidaddesc }}
                                </h1>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Encabezado y titulo -->

                    <section>
                        <div class="px-4 pb-4">
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Tipo de cliente
                                        </label>
                                        <select v-model="form.TIPO_CLIENTE" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                            <option value="0" >Seleccione</option>
                                            <option v-for="opcion in arrayTiposclientes" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                        </select>
                                        <div v-if="errors.TIPO_CLIENTE" class="text-xs text-red-500">{{ errors.TIPO_CLIENTE }}</div>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <select v-model="form.TIPO_IDENT" class="block py-2.5 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                            <option value="0" >Seleccione</option>
                                            <option v-for="opcion in arrayTiposdocumento" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Tipo de identificación
                                        </label>
                                        <div v-if="errors.TIPO_IDENT" class="text-xs text-red-500">{{ errors.TIPO_IDENT }}</div>
                                    </div>
                                </div>
                                <form @submit.prevent="getCliente(form.TIPO_CLIENTE, form.TIPO_IDENT, form.IDENTIFICACION)" @keyup.enter="getCliente(form.TIPO_CLIENTE, form.TIPO_IDENT, form.IDENTIFICACION)">
                                    <div class="relative z-0 w-full mb-6 group">

                                        <div class="relative w-full">
                                            <input type="text" @change="getCliente(form.TIPO_CLIENTE, form.TIPO_IDENT, form.IDENTIFICACION)" v-model="form.IDENTIFICACION" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                            <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-blue-900 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                <svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                                <span class="sr-only">Search</span>
                                            </button>
                                        </div>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Cliente
                                        </label>
                                        <div v-if="errors.IDENTIFICACION" class="text-xs text-red-500">{{ errors.IDENTIFICACION }}</div>
                                    </div>
                                </form>
                                <div class="text-bold text-sm">
                                    {{ cliente.NOMBRE?(cliente.NOMBRE + ' ' + cliente.APELLIDO):'' }}
                                </div>
                                <div class="flex">
                                    <div class="w-1/2">
                                        <span class="text-bold">
                                            Tipo:
                                        </span>
                                            <span class="">
                                            {{ cliente.TIPO_CLIENTE?tipocliente:'' }}
                                        </span>
                                        </div>
                                    <div class="w-1/2">
                                        <span class="text-bold">
                                            Segmento:
                                        </span>
                                            <span class="">
                                            {{ cliente.SEGMENTO?segmento:'' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
<!--                direcciones-->
                <div class="bg-white overflow-hidden my-1 shadow-xl rounded-lg">
                    <section>
                        <div class="px-4 py-4">
                            <div class="flex grid xl:grid-cols-2 xl:gap-6">
                                <a class="inline-flex" href="#" @click="openModal('dirinsta')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498l4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 00-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0z" />
                                    </svg>
                                    <span class="ml-2 text-blue-600 hover:underline">
                                        Dirección de instalación
                                    </span>
                                </a>
                                <a class="inline-flex" href="#" @click="openModal('dircobro')">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="ml-2 text-blue-600 hover:underline">
                                        Dirección de cobro
                                    </span>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
<!--                ciclo de facturación-->
                <div id="localizacion" name="localizacion" class="bg-white overflow-hidden my-1 shadow-xl rounded-lg">
                    <section>
                        <div class="px-4 py-4">
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 w-full mb-2 group">
                                    <select v-model="form.CICLO" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                        <option value="0" >Seleccione</option>
                                        <option v-for="opcion in arrayCiclos" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                    </select>
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Ciclo de facturacion
                                    </label>
                                    <div v-if="errors.CICLO" class="text-xs text-red-500">{{ errors.CICLO }}</div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
<!--                sector/contador-->
                <div class="bg-white overflow-hidden my-1 shadow-xl rounded-lg">
                    <section>
                        <div class="px-4 py-2">
                            <div class="grid grid-cols-2 xl:gap-6">
                                <div class="pr-2 relative z-0 w-full mb-2 group">
                                    <input type="text" v-model="form.SECTOR" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Sector
                                    </label>
                                    <div v-if="errors.SECTOR" class="text-xs text-red-500">{{ errors.SECTOR }}</div>
                                </div>
                                <div class="pl-2 relative z-0 w-full mb-2 group">
                                    <input type="text" v-model="form.CONTADOR" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Contador
                                    </label>
                                    <div v-if="errors.CONTADOR" class="text-xs text-red-500">{{ errors.CONTADOR }}</div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
<!--                estrato-->
                <div class="bg-white overflow-hidden my-1 shadow-xl rounded-lg">
                    <section>
                        <div class="px-4 py-4">
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 w-full mb-2 group">
                                    <select v-model="form.ESTRATO" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                        <option value="0" >Seleccione</option>
                                        <option v-for="opcion in arrayEstratos" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                    </select>
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Estrato
                                    </label>
                                    <div v-if="errors.ESTRATO" class="text-xs text-red-500">{{ errors.ESTRATO }}</div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
<!--                tecnologia/producto base-->
                <div class="bg-white overflow-hidden my-1 shadow-xl rounded-lg">
                    <section>
                        <div class="px-4 py-4">
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 w-full mb-2 group">
                                    <select v-model="form.TECNOLOGIA" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                        <option value="0" >Seleccione</option>
                                        <option v-for="opcion in arrayTecnologias" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                    </select>
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Tecnología
                                    </label>
                                    <div v-if="errors.TECNOLOGIA" class="text-xs text-red-500">{{ errors.TECNOLOGIA }}</div>
                                </div>
                                <div class="relative z-0 w-full my-2 group">
                                    <input type="text" @change="valProductBase(form.PROD_BASE)" v-model="form.PROD_BASE" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Producto base
                                    </label>
                                    <div v-if="errors.PROD_BASE" class="text-xs text-red-500">{{ errors.PROD_BASE }}</div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
<!--                observaciones-->
                <div class="bg-white overflow-hidden my-1 shadow-xl rounded-lg">
                    <section>
                        <div class="px-4 py-4">
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 w-full mb-2 group">
                                    <label class="peer-focus:font-medium text-sm text-gray-500 peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Observaciones
                                    </label>
                                    <textarea type="text" v-model="form.OBSERVACIONES"  rows="4" class="block border-1 py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent rounded-lg border border-gray-300 appearance-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                    <div v-if="errors.OBSERVACIONES" class="text-xs text-red-500">{{ errors.OBSERVACIONES }}</div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
<!--                Productos  -->
                <div name="productos" id="productos" class="mb-4 bg-white overflow-hidden shadow-xl rounded-lg">

                    <!-- Ventana modal productos -->
                    <div class="my-6 ml-4 flex grid grid-cols-2 xl:gap-6">
                        <a class="py-2 inline-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-2 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            <input type="checkbox" @change="valSelTab('voz'); form.EMPAQUETAR?getComercialPlan('voz'):getComercialPlanInd('voz')" value="1" v-model="form.INC_VOZ" class="px-2 w-6 h-6 text-red-600 rounded border-red-600 focus:ring-red-500 focus:ring-2">
                            <span class="mx-2">
                                Voz
                            </span>
                        </a>
                        <a class="py-2 inline-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-2 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z" />
                            </svg>
                            <input type="checkbox" @change="valSelTab('internet'); form.EMPAQUETAR?getComercialPlan('internet'):getComercialPlanInd('internet')" value="1" v-model="form.INC_INT" class="px-2 w-6 h-6 text-red-600 rounded border-red-600 focus:ring-red-500 dfocus:ring-2">
                            <span class="mx-2">
                                Internet
                            </span>
                        </a>
                        <a class="inline-flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-2 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                            <input type="checkbox" @change="valSelTab('tv'); form.EMPAQUETAR?getComercialPlan('tv'):getComercialPlanInd('tv')" value="1" v-model="form.INC_TV" class="px-2 w-6 h-6 text-red-600 rounded border-red-600 focus:ring-red-500 dfocus:ring-2">
                            <span class="mx-2">
                                TV
                            </span>
                        </a>
                        <a class="inline-flex" :class="{'text-gray-300': (form.INC_TV + form.INC_INT + form.INC_VOZ) < 2, 'text-gray-800' : (form.INC_TV + form.INC_INT + form.INC_VOZ) > 1}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" :class="{'text-gray-300': (form.INC_TV + form.INC_INT + form.INC_VOZ) < 2}" class="mx-2 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <input type="checkbox" @change="getComercialPlan('paquete')" :disabled="(form.INC_TV + form.INC_INT + form.INC_VOZ) < 2" :class="{'text-gray-300': (form.INC_TV + form.INC_INT + form.INC_VOZ) < 2, 'border-gray-300': (form.INC_TV + form.INC_INT + form.INC_VOZ) < 2, 'border-red-600': (form.INC_TV + form.INC_INT + form.INC_VOZ) > 1, 'text-red-600' : (form.INC_TV + form.INC_INT + form.INC_VOZ) > 1}" value="Y" v-model="form.EMPAQUETAR" class="px-2 w-6 h-6 rounded focus:ring-red-500 dfocus:ring-2">
                            <span :class="{'text-gray-300': (form.INC_TV + form.INC_INT + form.INC_VOZ) < 2, 'text-gray-800' : (form.INC_TV + form.INC_INT + form.INC_VOZ) > 1}" class="mx-2 ">
                                Paquete
                            </span>
                        </a>
                    </div>

                    <div class="mt-2 border-b border-gray-500">
                        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                            <li class="mr-2" v-show="form.INC_VOZ" role="presentation">
                                <button @click="changeTab('voz')" :class="{'bg-gradient-to-r from-blue-500 via-blue-600 to-blue-800 text-white': activeTab == 'voz'}" class="inline-block px-4 py-2 rounded-t-lg border-b-2 border-transparent" type="button">VOZ</button>
                            </li>
                            <li class="mr-2" v-show="form.INC_TV" role="presentation">
                                <button @click="changeTab('tv')" :class="{'bg-gradient-to-r from-blue-500 via-blue-600 to-blue-800 text-gray-100': activeTab == 'tv'}" class="inline-block px-4 py-2 rounded-t-lg border-b-2 border-transparent" type="button" role="tab">TV</button>
                            </li>
                            <li class="mr-2" v-show="form.INC_INT" role="presentation">
                                <button @click="changeTab('internet')" :class="{'bg-gradient-to-r from-blue-500 via-blue-600 to-blue-800 text-white': activeTab == 'internet'}" class="inline-block px-4 py-2 rounded-t-lg border-b-2 border-transparent" type="button">INTERNET</button>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <div v-if="(!form.INC_VOZ && !form.INC_TV && !form.INC_INT)" class="p-2 border-l-2 border-r-2 border-b-2 rounded-lg">
                            <div class="px-4 py-4">
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative py-10 z-0 w-full my-2 group">
                                        <span class="py-20 mx-auto">
                                            No se ha seleccionado un producto
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="activeTab == 'voz' && form.INC_VOZ" class="p-2 border-l-2 border-r-2 border-b-2 rounded-lg">
                            <div class="px-4 py-4">
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full my-2 group">
                                        <select @change="getSalesPlan(form.PLAN_CCIAL_LB, 'voz')" v-model="form.PLAN_CCIAL_LB" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                            <option value="0" >Seleccione</option>
                                            <option v-for="opcion in arrayPlanesComVoz" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Plan comercial
                                        </label>
                                        <div v-if="errors.PLAN_CCIAL_LB" class="text-xs text-red-500">{{ errors.PLAN_CCIAL_LB }}</div>
                                    </div>
                                    <div class="relative z-0 w-full my-2 group">
                                        <select v-model="form.PLAN_VTA_LB" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                            <option value="0" >Seleccione</option>
                                            <option v-for="opcion in arrayPlanesVentaVoz" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Plan Venta
                                        </label>
                                        <div v-if="errors.PLAN_VTA_LB" class="text-xs text-red-500">{{ errors.PLAN_VTA_LB }}</div>
                                    </div>
                                    <div class="relative z-0 w-full my-2 group">
                                        <select v-model="form.RETRICCION" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                            <option value="" >Seleccione</option>
                                            <option v-for="opcion in arrayRestricciones" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Restricciones de tráfico
                                        </label>
                                        <div v-if="errors.RETRICCION" class="text-xs text-red-500">{{ errors.RETRICCION }}</div>
                                    </div>
                                    <div class="w-full my-2 group">
                                        <Multiselect
                                            v-model="pqvoz"
                                            mode="tags"
                                            :close-on-select="true"
                                            :searchable="true"
                                            :options="paquetesvoz"
                                            placeholder="Seleccione los paquetes"
                                            track-by="DESCRIPCION"
                                            label="DESCRIPCION"
                                            hideSelectedTag="true"
                                            :search="true"
                                            noResultsText="No se encontró resultado"

                                            :clear-on-select="false"
                                            :preserve-search="true"
                                            :preselect-first="true"

                                            :classes="{
                                              tag: 'bg-blue-500 text-white text-sm font-semibold py-0.5 pl-2 rounded mr-1 mb-1 flex items-center rtl:pl-0 rtl:pr-2 rtl:mr-0 rtl:ml-1',
                                            }"

                                        />
                                    </div>
                                    <div class="relative z-0 w-full my-2 group">
                                        <input type="checkbox" v-model="form.NUMERO_PRIVADO" value="1" class="px-2 w-6 h-6 text-red-600 rounded border-red-600 focus:ring-red-500 dfocus:ring-2">
                                        <label class="px-2 text-sm text-gray-500 peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100">
                                            Número privado
                                        </label>
                                        <div v-if="errors.NUMERO_PRIVADO" class="text-xs text-red-500">{{ errors.NUMERO_PRIVADO }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="activeTab == 'tv' && form.INC_TV" class="p-2 border-l-2 border-r-2 border-b-2 rounded-lg">
                            <div class="px-4 py-4">
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full my-2 group">
                                        <select @change="getSalesPlan(form.PLAN_CCIAL_TV, 'tv')" v-model="form.PLAN_CCIAL_TV" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                            <option value="0" >Seleccione</option>
                                            <option v-for="opcion in arrayPlanesComTv" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Planes comerciales
                                        </label>
                                        <div v-if="errors.PLAN_CCIAL_TV" class="text-xs text-red-500">{{ errors.PLAN_CCIAL_TV }}</div>
                                    </div>
                                    <div class="relative z-0 w-full my-2 group">
                                        <select v-model="form.PLAN_VTA_TV" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                            <option value="0" >Seleccione</option>
                                            <option v-for="opcion in arrayPlanesVentaTv" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Planes Venta
                                        </label>
                                        <div v-if="errors.PLAN_VTA_TV" class="text-xs text-red-500">{{ errors.PLAN_VTA_TV }}</div>
                                    </div>
                                    <div class="w-full my-2 group">
                                        <Multiselect
                                            v-model="pqtv"
                                            mode="tags"
                                            :close-on-select="true"
                                            :searchable="true"
                                            :options="paquetestv"
                                            placeholder="Seleccione los paquetes"
                                            track-by="DESCRIPCION"
                                            label="DESCRIPCION"
                                            hideSelectedTag="true"
                                            :search="true"
                                            noResultsText="No se encontró resultado"

                                            :clear-on-select="false"
                                            :preserve-search="true"
                                            :preselect-first="true"

                                            :classes="{
                                              tag: 'bg-blue-500 text-white text-sm font-semibold py-0.5 pl-2 rounded mr-1 mb-1 flex items-center rtl:pl-0 rtl:pr-2 rtl:mr-0 rtl:ml-1',
                                            }"

                                        />
                                    </div>
                                    <div class="flex relative z-0 w-full my-2 group">
                                        <div class="w-1/2 mr-2">
                                            <select v-model="form.DECOS_ST" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                            <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                                Cantidad Decos ST
                                            </label>
                                            <div v-if="errors.DECOS_ST" class="text-xs text-red-500">{{ errors.DECOS_ST }}</div>
                                        </div>
                                        <div class="w-1/2 ml-2">
                                            <select v-model="form.DECOS_HD" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                            <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                                Cantidad Decos HD
                                            </label>
                                            <div v-if="errors.DECOS_HD" class="text-xs text-red-500">{{ errors.DECOS_HD }}</div>
                                        </div>

                                    </div>
                                    <div class="relative z-0 w-full my-2 group">
                                        <input type="checkbox" v-model="form.DTH" value="1" class="px-2 w-6 h-6 text-red-600 rounded border-red-600 focus:ring-red-500 dfocus:ring-2">
                                        <label class="px-2 text-sm text-gray-500 peer-focus:left-0 peer-focus:text-blue-600 peer-placeholder-shown:scale-100">
                                            Cobrar suscripción DTH
                                        </label>
                                        <div v-if="errors.DTH" class="text-xs text-red-500">{{ errors.IDENTIFICACION }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div v-if="activeTab == 'internet' && form.INC_INT" class="p-2 border-l-2 border-r-2 border-b-2 rounded-lg">
                            <div class="px-4 py-4">
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full my-2 group">
                                        <select @change="getSalesPlan(form.PLAN_CCIAL_INT, 'internet'), getVelocidades(form.PLAN_CCIAL_INT)" v-model="form.PLAN_CCIAL_INT" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                            <option value="0" >Seleccione</option>
                                            <option v-for="opcion in arrayPlanesComInternet" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Plan comercial
                                        </label>
                                        <div v-if="errors.PLAN_CCIAL_INT" class="text-xs text-red-500">{{ errors.PLAN_CCIAL_INT }}</div>
                                    </div>
                                    <div class="relative z-0 w-full my-2 group">
                                        <select v-model="form.PLAN_VTA_INT" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                            <option value="0" >Seleccione</option>
                                            <option v-for="opcion in arrayPlanesVentaInternet" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Plan Venta
                                        </label>
                                        <div v-if="errors.PLAN_VTA_INT" class="text-xs text-red-500">{{ errors.PLAN_VTA_INT }}</div>
                                    </div>
                                    <div class="relative z-0 w-full my-2 group">
                                        <select v-model="form.VELOCIDAD" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                            <option value="0" >Seleccione</option>
                                            <option v-for="opcion in arrayVelocidadesInt" :key="opcion.CLASE_SERVICIO" :value="opcion.CLASE_SERVICIO" v-text="opcion.DESCRIPCION"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Velocidades Internet
                                        </label>
                                        <div v-if="errors.VELOCIDAD" class="text-xs text-red-500">{{ errors.VELOCIDAD }}</div>
                                    </div>
                                    <div class="relative z-0 w-full my-4 group">
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Wifi Pro arriendo
                                        </label>
                                        <div class="flex flex-wrap pt-2">
                                            <div class="flex items-center mr-2">
                                                <input v-model="wifiselect" type="radio" value="incluido" name="colored-radio" class="w-6 h-6 text-red-600 bg-gray-100 border-gray-300 focus:ring-red-500 focus:ring-1">
                                                <label class="ml-2 text-sm font-medium text-gray-900">Incluido</label>
                                            </div>
                                            <div class="flex items-center mr-2">
                                                <input v-model="wifiselect" type="radio" value="arriendo" name="colored-radio" class="w-6 h-6 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 focus:ring-1">
                                                <label class="ml-2 text-sm font-medium text-gray-900">Arriendo</label>
                                            </div>
                                            <div class="flex items-center">
                                                <input v-model="wifiselect" type="radio" value="fideliza" name="colored-radio" class="w-6 h-6 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-1">
                                                <label class="ml-2 text-sm font-medium text-gray-900">Fideliza</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Fin Ventana productos -->

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
                        Guardar
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
            </div>


            <!-- Ventana modal dirección de instalación -->
            <!-- Main modal -->
            <section> <!-- Ventana modal -->
                <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpenModalDirInsta">
                    <div class="items-end justify-center min-h-screen pt-4 px-2 pb-20 text-center sm:block sm:p-0">

                        <div class="fixed inset-0 transition-opacity">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                        <div class="inline-block px-2 py-4 w-10/12 lg:w-6/12 align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                            <button type="button" @click="closeModal('dirinsta')" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                            <div class="">
                                <h2 class="text-xl font-bold text-gray-900">Dirección de instalación</h2>
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 w-full my-2 group">
                                    <input type="text" v-model="form.DIRECCION" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Dirección
                                    </label>
                                    <div v-if="errors.DIRECCION" class="text-xs text-red-500">{{ errors.DIRECCION }}</div>
                                </div>
                                <div class="relative z-0 w-full my-2 group">
                                    <select v-model="form.BARRIO" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                        <option value="0" >Seleccione</option>
                                        <option v-for="opcion in arrayBarrios" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                    </select>
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Barrio
                                    </label>
                                    <div v-if="errors.BARRIO" class="text-xs text-red-500">{{ errors.BARRIO }}</div>
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 w-full my-2 group">
                                    <input type="text" v-model="form.COMPLEMENTO_DIRECCION_INST" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Complemento
                                    </label>
                                    <div v-if="errors.COMPLEMENTO_DIRECCION_INST" class="text-xs text-red-500">{{ errors.COMPLEMENTO_DIRECCION_INST }}</div>
                                </div>
                            </div>
                            <div class="w-full inline-flex mt-2">
                                <div class="text-right pr-2 mx-auto">
                                    <button type="button" @click="crearDireccion('dirinsta', form.DIRECCION, form.BARRIO)" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center">
                                        Aceptar
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </section>
            <!-- Fin Ventana modal dirección de instalación -->

            <!-- Ventana modal dirección de cobro -->
            <!-- Main modal -->
            <section> <!-- Ventana modal -->
                <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpenModalDirfact">
                    <div class="items-end justify-center min-h-screen pt-4 px-2 pb-20 text-center sm:block sm:p-0">

                        <div class="fixed inset-0 transition-opacity">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                        <div class="inline-block px-2 py-4 w-10/12 lg:w-6/12 align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                            <button type="button" @click="closeModal('dircobro')" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            </button>
                            <div class="">
                                <h2 class="text-xl font-bold text-gray-900">Dirección de cobro</h2>
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 w-full my-2 group">
                                    <input type="text" v-model="form.DIRECCION_COBR" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Dirección
                                    </label>
                                    <div v-if="errors.DIRECCION_COBR" class="text-xs text-red-500">{{ errors.DIRECCION_COBR }}</div>
                                </div>
                                <div class="relative z-0 w-full my-2 group">
                                    <select v-model="form.BARRIO_COBR" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                                        <option value="0" >Seleccione</option>
                                        <option v-for="opcion in arrayBarrios" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                                    </select>
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Barrio
                                    </label>
                                    <div v-if="errors.BARRIO_COBR" class="text-xs text-red-500">{{ errors.BARRIO_COBR }}</div>
                                </div>
                            </div>
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <div class="relative z-0 w-full my-2 group">
                                    <input type="text" v-model="form.COMPLEMENTO_DIRECCION_CBR" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                    <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                        Complemento
                                    </label>
                                    <div v-if="errors.COMPLEMENTO_DIRECCION_CBR" class="text-xs text-red-500">{{ errors.COMPLEMENTO_DIRECCION_CBR }}</div>
                                </div>
                            </div>
                            <div class="w-full inline-flex mt-2">
                                <div class="text-right pr-2 mx-auto">
                                    <button type="button" @click="crearDireccion('dirinsta', form.DIRECCION_COBR, form.BARRIO_COBR)" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center">
                                        Aceptar
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.5c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75A2.25 2.25 0 0116.5 4.5c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23H5.904M14.25 9h2.25M5.904 18.75c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 01-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 10.203 4.167 9.75 5 9.75h1.053c.472 0 .745.556.5.96a8.958 8.958 0 00-1.302 4.665c0 1.194.232 2.333.654 3.375z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Fin Ventana modal dirección de cobro -->


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

    },
    data() {
        return {
            loading: false,
            pqvoz: [],
            pqtv: [],
            //segmento: '',
            //tipocliente: '',
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
            formpasswd: {
                _token: usePage().props.value._token,
                id: '',
                password: '',
                password_confirmation: '',
            },
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
                NOMBRE: '',
                APELLIDO: '',
                IDENTIFICACION: '',
                TIPO_IDENT: 0,
                TIPO_CLIENTE: 0,
                SEGMENTO: 0,
                CICLO: 0,
                INC_VOZ: 0,
                INC_INT: 0,
                INC_TV: 0,
                EMPAQUETAR: 0,
                PLAN_CCIAL_LB: 0,
                PLAN_VTA_LB: 0,
                APL_DCTO_LB: 'N',
                PLAN_CCIAL_INT: 0,
                PLAN_VTA_INT: 0,
                APL_DCTO_INT: 'N',
                PLAN_CCIAL_TV: 0,
                PLAN_VTA_TV: 0,
                APL_DCTO_TV: 'N',
                TECNOLOGIA: 0,
                ESTRATO: 0,
                LOCALIDAD: 0,
                DIRECCION: '',
                BARRIO: 0,
                LOCALIDAD_COBR: 0,
                DIRECCION_COBR: '',
                BARRIO_COBR: 0,
                PROD_BASE: '',
                PAQUETE_SS: 0,
                RETRICCION: '',
                VELOCIDAD: 0,
                PAQ_TELEVISION: '',
                DECOS_ST: 0,
                DECOS_HD: 0,
                VENDEDOR: 0,
                PRODUCTO_BASE: '',
                COOR_X: 0,
                COOR_Y: 0,
                OBSERVACIONES: '',
                SECTOR: '',
                CONTADOR: '',
                DTH: 0,
                NUMERO_PRIVADO: 0,
                WIFIPROINCLUIDO: 0,
                WIFIPROARRIENDO: 0,
                WIFIPROFIDELIZA: 0,
                COMPLEMENTO_DIRECCION_CBR: '',
                COMPLEMENTO_DIRECCION_INST: ''
            }
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
                case 'dirinsta':
                    this.isOpenModalDirInsta = true;
                    break;
                case 'dircobro':
                    this.isOpenModalDirfact = true;
                    break;
            }
        },
        closeModal: function (accion) {
            switch (accion) {
                case 'dirinsta':
                    this.isOpenModalDirInsta = false;
                    break;
                case 'dircobro':
                    this.isOpenModalDirfact = false;
                    break;
                //this.reset();
                //this.editMode = false;
                //this.verMode  = false;
                //this.$page.props.errors = [];
            }
        },
        closeModalPass: function () {
            this.isOpencambiopass = false
            this.$page.props.errors.updatePassword = null;
        },
        reset: function () {
            this.tituloModal = '';
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
            this.navState = 'facturacion';
            this.isValidategeneral = false;
            this.errors = [];
        },
        savex: function (data) {
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
                this.errors.IDENTIFICACION = 'Ingrese el número de documento';
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
            if (this.form.CICLO  == 0) {
                statuserror =  false;
                this.errors.CICLO = 'Seleccione el ciclo';
            } else {
                this.errors.CICLO = null;
            }

            if (this.form.INC_VOZ == 'N' && this.form.INC_INT == 'N' && this.form.INC_TV == 'N') {
                statuserror =  false;
                this.errors.AUTORIZA = 'Seleccione al menos un producto';
            }

            if (this.form.EMPAQUETAR  == 'Y') {
                let cantProd = this.form.INC_VOZ + this.form.INC_INT + this.form.INC_TV;
                if (cantProd < 2)
                statuserror =  false;
                this.errors.EMPAQUETAR = 'Seleccione por lo menos dos productos para empaquetar';
            } else {
                this.errors.EMPAQUETAR = null;
            }

            if (this.form.INC_VOZ) {
                if (this.form.PLAN_CCIAL_LB == 0) {
                    statuserror = false;
                    this.errors.PLAN_CCIAL_LB = 'Seleccione el plan comercial de Voz';
                } else {
                    this.errors.PLAN_CCIAL_LB = null;
                }
                if (this.form.PLAN_VTA_LB == 0) {
                    statuserror = false;
                    this.errors.PLAN_VTA_LB = 'Seleccione el plan de venta de Voz';
                } else {
                    this.errors.PLAN_VTA_LB = null;
                }
                if (this.pqvoz.length > 0) {
                    this.form.PAQUETE_SS = this.pqvoz[0];
                    for(let i = 1; i < this.pqvoz.length; i++) {
                        this.form.PAQUETE_SS += ','+this.pqvoz[i];
                    }
                }
            }
            if (this.form.INC_INT) {
                if (this.form.PLAN_CCIAL_INT == 0) {
                    statuserror = false;
                    this.errors.PLAN_CCIAL_INT = 'Seleccione el plan comercial de Internet';
                } else {
                    this.errors.PLAN_CCIAL_INT = null;
                }
                if (this.form.PLAN_VTA_INT == 0) {
                    statuserror = false;
                    this.errors.PLAN_VTA_INT = 'Seleccione el plan de venta de Internet';
                } else {
                    this.errors.PLAN_VTA_INT = null;
                }
                if (this.form.VELOCIDAD  == 0) {
                    statuserror =  false;
                    this.errors.VELOCIDAD = 'Seleccione la velocidad';
                } else {
                    this.errors.VELOCIDAD = null;
                }
                switch (this.wifiselect) {
                    case "incluido":
                        this.form.WIFIPROINCLUIDO = 1;
                        break;
                    case "arriendo":
                        this.form.WIFIPROARRIENDO = 1;
                        break;
                    case "fideliza":
                        this.form.WIFIPROFIDELIZA = 1;
                        break;
                }
            }
            if (this.form.INC_TV) {
                if (this.form.PLAN_CCIAL_TV == 0) {
                    statuserror = false;
                    this.errors.PLAN_CCIAL_TV = 'Seleccione el plan comercial de Tv';
                } else {
                    this.errors.PLAN_CCIAL_TV = null;
                }
                if (this.form.PLAN_VTA_TV == 0) {
                    statuserror = false;
                    this.errors.PLAN_VTA_TV = 'Seleccione el plan de venta de Tv';
                } else {
                    this.errors.PLAN_VTA_TV = null;
                }
                if ((this.form.DECOS_ST + this.form.DECOS_HD) == 0) {
                    statuserror =  false;
                    this.errors.DECOS_ST = 'Seleccione al menos un deco';
                } else {
                    this.errors.DECOS_ST = null;
                }
                if (this.pqtv.length > 0) {
                    this.form.PAQ_TELEVISION = this.pqtv[0];
                    for(let i = 1; i < this.pqtv.length; i++) {
                        this.form.PAQ_TELEVISION += ','+this.pqtv[i];
                    }
                }
            }
            if (this.form.TECNOLOGIA  == 0) {
                statuserror =  false;
                this.errors.TECNOLOGIA = 'Seleccione la tecnología';
            } else {
                this.errors.TECNOLOGIA = null;
            }
            if (this.form.ESTRATO  == 0) {
                statuserror =  false;
                this.errors.ESTRATO = 'Seleccione el estrato';
            } else {
                this.errors.ESTRATO = null;
            }
            if (this.form.DIRECCION  == '') {
                statuserror =  false;
                this.errors.DIRECCION = 'Ingrese la dirección del servicio';
            } else {
                this.errors.DIRECCION = null;
            }
            if (this.form.DIRECCION_COBR  == '') {
                statuserror =  false;
                this.errors.DIRECCION_COBR = 'Ingrese la dirección de cobro';
            } else {
                this.errors.DIRECCION_COBR = null;
            }

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

            console.log('creación de solicitud de venta');

            let res;
            try {
                res = await axios.get('/venta/store', {
                    params: {
                        XmlVenta: this.form
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
        },
        getComercialPlan: async function (producto) {
            this.loading = true;
            console.log('loading...');
            if (this.form.EMPAQUETAR) {
                console.log('consultar plan comercial');
                let res;
                console.log('INC_VOZ ' + this.form.INC_VOZ);
                console.log('INC_INT ' + this.form.INC_INT);
                console.log('INC_TV ' + this.form.INC_TV);
                try {
                    res = await axios.get('/venta/getComercialPlan', {
                        params: {
                            producto: producto,
                            prod_voz: this.form.INC_VOZ,
                            prod_int: this.form.INC_INT,
                            prod_tv: this.form.INC_TV,
                            estrato: this.form.ESTRATO, //104
                            segmento: this.form.SEGMENTO, //120
                            tipo_cliente: this.form.TIPO_CLIENTE, //99
                            prod_empaquetado: this.form.EMPAQUETAR
                        }
                    });
                } catch (error) {
                    console.log(error);
                    return false;
                }
                console.log(res.data);
                this.arrayPlanesComVoz = [];
                this.arrayPlanesComTv = [];
                this.arrayPlanesComInternet = [];
                this.arrayPlanesComVoz = res.data.planesvoz;
                this.arrayPlanesComTv = res.data.planestv;
                this.arrayPlanesComInternet = res.data.planesint;
                this.form.PLAN_CCIAL_LB = 0;
                this.form.PLAN_VTA_LB = 0;
                this.form.PLAN_CCIAL_INT = 0;
                this.form.PLAN_VTA_INT = 0;
                this.form.VELOCIDAD;
                this.form.PLAN_CCIAL_TV = 0;
                this.form.PLAN_VTA_TV = 0;

            } else {
                if (this.form.INC_VOZ) {
                    this.getComercialPlanInd('voz');
                }
                if (this.form.INC_INT) {
                    this.getComercialPlanInd('internet');
                }
                if (this.form.INC_TV) {
                    this.getComercialPlanInd('tv');
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
                    //this.getComercialPlan('voz');
                    break;
                case 'tv':
                    this.activeTab = 'tv';
                    //this.getComercialPlan('tv');
                    break;
                case 'internet':
                    this.activeTab = 'internet';
                    //this.getComercialPlan('internet');
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
        }
    },
    created: function () {
        this.arrayBarrios = this.barrios;
        this.arraySegmentos = this.segmentos
        this.arrayTiposclientes = this.tipoclientes;
        this.arrayTiposdocumento = this.tipoidentificaciones;
        this.arrayCiclos = this.ciclos;
        this.arrayEstratos = this.estratos;
        this.arrayTecnologias = this.tecnologias;
        this.arrayRestricciones = this.restricciones;
    },
    mounted: function () {

    },
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
