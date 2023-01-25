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
                                    Registrar paquete
                                </h1>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Encabezado y titulo -->

                    <section>
                        <div class="px-4 pb-4">
                            <div class="grid xl:grid-cols-2 xl:gap-6">
                                <form @submit.prevent="getContratoProd(form.SUBSCRIPTION_ID)" @keyup.enter="getContratoProd(form.SUBSCRIPTION_ID)">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <div class="relative w-full">
                                            <input type="text" @change="getContratoProd(form.SUBSCRIPTION_ID)" v-model="form.SUBSCRIPTION_ID" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                            <button type="submit" class="absolute top-0 right-0 p-2.5 text-sm font-medium text-blue-900 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                                <svg aria-hidden="true" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                                <span class="sr-only">Search</span>
                                            </button>
                                        </div>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Contrato
                                        </label>
                                        <div v-if="errors.SUBSCRIPTION_ID" class="text-xs text-red-500">{{ errors.SUBSCRIPTION_ID }}</div>
                                    </div>
                                </form>
                                <div class="text-bold text-sm">
                                    {{ form.NOMBRE?form.NOMBRE:'' }}
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

<!--                Productos  -->
                <div name="productos" id="productos" class="mb-4 mt-2 bg-white overflow-hidden shadow-xl rounded-lg">
                    <!-- Ventana modal productos -->
                    <div class="my-6 ml-4 flex grid grid-cols-2 xl:gap-6">
                        <a class="py-2 inline-flex" :class="{'text-gray-300': (!form.INC_VOZ_ACT && !form.INC_SOLVOZ), 'text-gray-800' : (form.INC_VOZ_ACT || form.INC_SOLVOZ)}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-2 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                            </svg>
                            <input type="checkbox" @change="valSelTab('voz'); getComercialPlan('voz')" value="1" :disabled="!form.INC_VOZ_ACT && !form.INC_SOLVOZ" v-model="form.INC_VOZ" :class="{'text-gray-300': (!form.INC_VOZ_ACT && !form.INC_SOLVOZ), 'border-gray-300': (!form.INC_VOZ_ACT && !form.INC_SOLVOZ), 'border-red-600': (form.INC_VOZ_ACT || form.INC_SOLVOZ), 'text-red-600' : (form.INC_VOZ_ACT || form.INC_SOLVOZ) }" class="px-2 w-6 h-6 rounded focus:ring-red-500 focus:ring-2">
                            <span class="mx-2">
                                Voz
                            </span>
                        </a>
                        <a class="py-2 inline-flex" :class="{'text-gray-300': (!form.INC_INT_ACT && !form.INC_SOLINC), 'text-gray-800' : (form.INC_INT_ACT || form.INC_SOLINC)}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mx-2 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z" />
                            </svg>
                            <input type="checkbox" @change="valSelTab('internet'); getComercialPlan('internet')" value="1" :disabled="!form.INC_INT_ACT && !form.INC_SOLINT" :class="{'text-gray-300': (!form.INC_INT_ACT && !form.INC_SOLINT), 'border-gray-300': (!form.INC_INT_ACT && !form.INC_SOLINT), 'border-red-600': (form.INC_INT_ACT || form.INC_SOLINT), 'text-red-600' : (form.INC_INT_ACT || form.INC_SOLINT) }" v-model="form.INC_INT" class="px-2 w-6 h-6 rounded focus:ring-red-500 dfocus:ring-2">
                            <span class="mx-2">
                                Internet
                            </span>
                        </a>
                        <a class="inline-flex" :class="{'text-gray-300': (!form.INC_TV_ACT && !form.INC_SOLTV), 'text-gray-800' : (form.INC_TV_ACT || form.INC_SOLTV)}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" :class="{'text-gray-300': (!form.INC_TV_ACT && !form.INC_SOLTV)}" class="mx-2 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 20.25h12m-7.5-3v3m3-3v3m-10.125-3h17.25c.621 0 1.125-.504 1.125-1.125V4.875c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                            <input type="checkbox" @change="valSelTab('tv'); getComercialPlan('tv')" value="1" :disabled="!form.INC_TV_ACT && !form.INC_SOLTV" :class="{'text-gray-300': (!form.INC_TV_ACT && !form.INC_SOLTV), 'border-gray-300': (!form.INC_TV_ACT && !form.INC_SOLTV), 'border-red-600': (form.INC_TV_ACT || form.INC_SOLTV), 'text-red-600' : (form.INC_TV_ACT || form.INC_SOLTV) }" v-model="form.INC_TV" class="px-2 w-6 h-6 rounded focus:ring-red-500 dfocus:ring-2">
                            <span class="mx-2">
                                TV
                            </span>
                        </a>
                        <a class="inline-flex" :class="{'text-gray-300': (form.INC_TV + form.INC_INT + form.INC_VOZ) < 2, 'text-gray-800' : (form.INC_TV + form.INC_INT + form.INC_VOZ) > 1}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" :class="{'text-gray-300': (form.INC_TV + form.INC_INT + form.INC_VOZ) < 2}" class="mx-2 w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                            <input type="checkbox" @change="getComercialPlan('paquete')" :disabled="(form.INC_TV + form.INC_INT + form.INC_VOZ) < 2" :class="{'text-gray-300': (form.INC_TV + form.INC_INT + form.INC_VOZ) < 2, 'border-gray-300': (form.INC_TV + form.INC_INT + form.INC_VOZ) < 2, 'border-red-600': (form.INC_TV + form.INC_INT + form.INC_VOZ) > 1, 'text-red-600' : (form.INC_TV + form.INC_INT + form.INC_VOZ) > 1}" value="Y" v-model="form.EMPAQUETADO" class="px-2 w-6 h-6 rounded focus:ring-red-500 dfocus:ring-2">
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
                            <li class="mr-2" v-show="form.INC_INT" role="presentation">
                                <button @click="changeTab('internet')" :disabled="step<2" :class="{'bg-gradient-to-r from-blue-500 via-blue-600 to-blue-800 text-white': activeTab == 'internet'}" class="inline-block px-4 py-2 rounded-t-lg border-b-2 border-transparent" type="button">INTERNET</button>
                            </li>
                            <li class="mr-2" v-show="form.INC_TV" role="presentation">
                                <button @click="changeTab('tv')" :disabled="step<3" :class="{'bg-gradient-to-r from-blue-500 via-blue-600 to-blue-800 text-gray-100': activeTab == 'tv'}" class="inline-block px-4 py-2 rounded-t-lg border-b-2 border-transparent" type="button" role="tab">TV</button>
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
                                        <input type="text" v-model="voz.PRODUCTO" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Producto
                                        </label>
                                    </div>
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

                                </div>
                            </div>
                        </div>
                        <div v-if="activeTab == 'internet' && form.INC_INT" class="p-2 border-l-2 border-r-2 border-b-2 rounded-lg">
                            <div class="px-4 py-4">
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full my-2 group">
                                        <input type="text" v-model="int.PRODUCTO" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Producto
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full my-2 group">
                                        <select @change="getSalesPlan(form.PLAN_CCIAL_INT, 'internet')" v-model="form.PLAN_CCIAL_INT" class="block py-4 px-0 w-full text-sm text-black bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer">
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

                                </div>
                            </div>
                        </div>
                        <div v-if="activeTab == 'tv' && form.INC_TV" class="p-2 border-l-2 border-r-2 border-b-2 rounded-lg">
                            <div class="px-4 py-4">
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div v-if="form.INC_TV_ACT && !form.INC_SOLTV" class="relative z-0 w-full my-2 group">
                                        <input type="text" v-model="tv.PRODUCTO" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Producto
                                        </label>
                                    </div>
                                    <div v-else-if="!form.INC_TV_ACT && form.INC_SOLTV" class="relative z-0 w-full my-2 group">
                                        <input type="text" v-model="soltv.MOTIVE_ID" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Motivo
                                        </label>
                                    </div>
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
                    <button type="button" @click="prev()" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                        Anterior
                    </button>
                </div>
                <div class="text-right pr-2 ml-auto">
                    <button type="button" @click="next()" class="text-white bg-red-600 hover:bg-red-800 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center">
                        {{ valFinish }}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </button>
                </div>
            </div>

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
            loading: false,
            step: 1,
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
                IDENTIFICACION: '',
                SUBSCRIPTION_ID: '',
                INC_VOZ: 0,
                INC_INT: 0,
                INC_TV: 0,
                INC_SOLVOZ: 0,
                INC_SOLINT: 0,
                INC_SOLTV: 0,
                EMPAQUETADO: 'N',
                INC_VOZ_ACT: 0,
                INC_INT_ACT: 0,
                INC_TV_ACT: 0,
                PLAN_CCIAL_LB: 0,
                PLAN_VTA_LB: 0,
                PLAN_CCIAL_INT: 0,
                PLAN_VTA_INT: 0,
                PLAN_CCIAL_TV: 0,
                PLAN_VTA_TV: 0,
            },
            voz: {
                NOMBRE: '',
                IDENTIFICACION: '',
                SUBSCRIPTION_ID: '',
                PRODUCTO: 0,
                TIPO_PRODUCTO: 0,
                PLAN_FACTURACION: 0,
                EMPAQUETADO: 'N',
                COMERCIAL_PLAN: 0
            },
            int: {
                NOMBRE: '',
                IDENTIFICACION: '',
                SUBSCRIPTION_ID: '',
                PRODUCTO: 0,
                TIPO_PRODUCTO: 0,
                PLAN_FACTURACION: 0,
                EMPAQUETADO: 'N',
                COMERCIAL_PLAN: 0
            },
            tv: {
                NOMBRE: '',
                IDENTIFICACION: '',
                SUBSCRIPTION_ID: '',
                PRODUCTO: 0,
                TIPO_PRODUCTO: 0,
                PLAN_FACTURACION: 0,
                EMPAQUETADO: 'N',
                COMERCIAL_PLAN: 0
            },
            solvoz: {
                PACKAGE_ID: 0,
                MOTIVE_ID: 0,
                PRODUCT_TYPE_ID: 0,
                COMMERCIAL_PLAN_ID: 0,
                PLANFACT: 0,
                REQUEST_DATE: ''
            },
            solint: {
                PACKAGE_ID: 0,
                MOTIVE_ID: 0,
                PRODUCT_TYPE_ID: 0,
                COMMERCIAL_PLAN_ID: 0,
                PLANFACT: 0,
                REQUEST_DATE: ''
            },
            soltv: {
                PACKAGE_ID: 0,
                MOTIVE_ID: 0,
                PRODUCT_TYPE_ID: 0,
                COMMERCIAL_PLAN_ID: 0,
                PLANFACT: 0,
                REQUEST_DATE: ''
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
                        if (this.form.INC_INT || this.form.INC_SOLINT) {
                            this.activeTab = 'internet';
                        } else if (this.form.INC_TV || this.form.INC_SOLTV) {
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

        getContratoProd: async function (contrato) {
            this.loading = true;
            console.log('consultar contrato');
            let res;
            try {
                res = await axios.get('/cliente/getContratoProd', {
                    params: {
                        contrato: contrato
                    }
                });
            } catch (error) {
                console.log(error);
                return false;
            }
            console.log(res.data.contrato);
            if (res.data.contrato != null) {
                this.form = res.data.contrato;
                this.voz = res.data.voz;
                this.int = res.data.int;
                this.tv = res.data.tv;

                this.solvoz = res.data.solvoz;
                this.solint = res.data.solint;
                this.soltv = res.data.soltv;

                this.form.PLAN_CCIAL_LB = 0;
                this.form.PLAN_VTA_LB = 0;
                this.form.PLAN_CCIAL_INT = 0;
                this.form.PLAN_VTA_INT = 0;
                this.form.PLAN_CCIAL_TV = 0;
                this.form.PLAN_VTA_TV = 0;

                this.getComercialPlan('all');

                if(this.form.INC_VOZ) {
                    this.activeTab = 'voz';
                } else if(this.form.INC_INT) {
                    this.activeTab = 'internet';
                } else if(this.form.INC_TV) {
                    this.activeTab = 'tv';
                }
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'No se encontró información para el contrato',
                    showConfirmButton: true
                })
            }
            this.loading = false;
        },
    },
    created: function () {
        if (this.form.INC_VOZ) {
            this.activeTab = 'voz';
        } else if (this.form.INC_INT) {
            this.activeTab = 'internet';
        } else if (this.form.INC_TV) {
            this.activeTab = 'tv';
        }
    },
    mounted: function () {

    },
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
