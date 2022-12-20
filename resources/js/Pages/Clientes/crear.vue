<template>
    <AppLayoutapp2 title="Clientes">
        <header class="relative flex items-center justify-between flex-shrink-0 p-4">
            <form action="#" class="flex-1">
                <!--  -->
            </form>
            <div class="items-center hidden ml-4 sm:flex">
                <button
                    @click="isSettingsPanelOpen = true"
                    class="p-2 mr-4 text-gray-400 bg-white rounded-lg shadow-md hover:text-gray-600 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4"
                >
                    <span class="sr-only">Settings</span>
                    <svg
                        aria-hidden="true"
                        class="w-6 h-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                    </svg>
                </button>

                <!-- Github link -->
                <a
                    href="https://github.com/kamona-ui/dashboard-alpine"
                    target="_blank"
                    class="p-2 text-white bg-black rounded-lg shadow-md hover:text-gray-200 focus:outline-none focus:ring focus:ring-black focus:ring-offset-gray-100 focus:ring-offset-2"
                >
                    <span class="sr-only">github link</span>
                    <svg
                        aria-hidden="true"
                        class="w-6 h-6"
                        fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.026,2c-5.509,0-9.974,4.465-9.974,9.974c0,4.406,2.857,8.145,6.821,9.465 c0.499,0.09,0.679-0.217,0.679-0.481c0-0.237-0.008-0.865-0.011-1.696c-2.775,0.602-3.361-1.338-3.361-1.338 c-0.452-1.152-1.107-1.459-1.107-1.459c-0.905-0.619,0.069-0.605,0.069-0.605c1.002,0.07,1.527,1.028,1.527,1.028 c0.89,1.524,2.336,1.084,2.902,0.829c0.091-0.645,0.351-1.085,0.635-1.334c-2.214-0.251-4.542-1.107-4.542-4.93 c0-1.087,0.389-1.979,1.024-2.675c-0.101-0.253-0.446-1.268,0.099-2.64c0,0,0.837-0.269,2.742,1.021 c0.798-0.221,1.649-0.332,2.496-0.336c0.849,0.004,1.701,0.115,2.496,0.336c1.906-1.291,2.742-1.021,2.742-1.021 c0.545,1.372,0.203,2.387,0.099,2.64c0.64,0.696,1.024,1.587,1.024,2.675c0,3.833-2.33,4.675-4.552,4.922 c0.355,0.308,0.675,0.916,0.675,1.846c0,1.334-0.012,2.41-0.012,2.737c0,0.267,0.178,0.577,0.687,0.479 C19.146,20.115,22,16.379,22,11.974C22,6.465,17.535,2,12.026,2z"
                        ></path>
                    </svg>
                </a>
            </div>

            <!-- Mobile sub header button -->
            <button
                @click="isSubHeaderOpen = !isSubHeaderOpen"
                class="p-2 text-gray-400 bg-white rounded-lg shadow-md sm:hidden hover:text-gray-600 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4"
            >
                <span class="sr-only">More</span>

                <svg
                    aria-hidden="true"
                    class="w-6 h-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"
                    />
                </svg>
            </button>

            <!-- Mobile sub header -->
            <div
                transition-all duration-300
                v-if="isSubHeaderOpen"
                @click.away="isSubHeaderOpen = false"
                class="absolute flex items-center justify-between p-2 bg-white rounded-md shadow-lg sm:hidden top-16 left-5 right-5"
            >
                <!-- Seetings button -->
                <button
                    @click="isSettingsPanelOpen = true; isSubHeaderOpen = false"
                    class="p-2 text-gray-400 bg-white rounded-lg shadow-md hover:text-gray-600 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4"
                >
                    <span class="sr-only">Settings</span>
                    <svg
                        aria-hidden="true"
                        class="w-6 h-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
                        />
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                    </svg>
                </button>
                <!-- Messages button -->
                <button
                    @click="isSidebarOpen = true; currentSidebarTab = 'messagesTab'; isSubHeaderOpen = false"
                    class="p-2 text-gray-400 bg-white rounded-lg shadow-md hover:text-gray-600 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4"
                >
                    <span class="sr-only">Toggle message panel</span>
                    <svg
                        aria-hidden="true"
                        class="w-6 h-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
                        />
                    </svg>
                </button>
                <!-- Notifications button -->
                <button
                    @click="isSidebarOpen = true; currentSidebarTab = 'notificationsTab'; isSubHeaderOpen = false"
                    class="p-2 text-gray-400 bg-white rounded-lg shadow-md hover:text-gray-600 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4"
                >
                    <span class="sr-only">Toggle notifications panel</span>
                    <svg
                        aria-hidden="true"
                        class="w-6 h-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                        />
                    </svg>
                </button>
                <!-- Github link -->
                <a
                    href="https://github.com/kamona-ui/dashboard-alpine"
                    target="_blank"
                    class="p-2 text-white bg-black rounded-lg shadow-md hover:text-gray-200 focus:outline-none focus:ring focus:ring-black focus:ring-offset-gray-100 focus:ring-offset-2"
                >
                    <span class="sr-only">github link</span>
                    <svg
                        aria-hidden="true"
                        class="w-6 h-6"
                        fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                    >
                        <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M12.026,2c-5.509,0-9.974,4.465-9.974,9.974c0,4.406,2.857,8.145,6.821,9.465 c0.499,0.09,0.679-0.217,0.679-0.481c0-0.237-0.008-0.865-0.011-1.696c-2.775,0.602-3.361-1.338-3.361-1.338 c-0.452-1.152-1.107-1.459-1.107-1.459c-0.905-0.619,0.069-0.605,0.069-0.605c1.002,0.07,1.527,1.028,1.527,1.028 c0.89,1.524,2.336,1.084,2.902,0.829c0.091-0.645,0.351-1.085,0.635-1.334c-2.214-0.251-4.542-1.107-4.542-4.93 c0-1.087,0.389-1.979,1.024-2.675c-0.101-0.253-0.446-1.268,0.099-2.64c0,0,0.837-0.269,2.742,1.021 c0.798-0.221,1.649-0.332,2.496-0.336c0.849,0.004,1.701,0.115,2.496,0.336c1.906-1.291,2.742-1.021,2.742-1.021 c0.545,1.372,0.203,2.387,0.099,2.64c0.64,0.696,1.024,1.587,1.024,2.675c0,3.833-2.33,4.675-4.552,4.922 c0.355,0.308,0.675,0.916,0.675,1.846c0,1.334-0.012,2.41-0.012,2.737c0,0.267,0.178,0.577,0.687,0.479 C19.146,20.115,22,16.379,22,11.974C22,6.465,17.535,2,12.026,2z"
                        ></path>
                    </svg>
                </a>
            </div>
        </header>
        <template #header>
            <div class="flex-shrink-0 py-2">
            <a href="#">
                <img
                    class="w-10 h-auto"
                    src="storage/img/tigo_une_logo.jpg"
                    alt="VentaMovil"
                />
            </a>
        </div>
        </template>

        <div class="py-4 lg:px-4 md:px-2 sm:px-2">
            <div class="mx-auto 2xl:8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
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
                    <section>
                        <div class="px-4">
                            <form @submit.prevent="getUsers('', '', form)" @keyup.enter="getUsers('', '', form)">
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.documento" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Documento
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.nombre" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Nombre
                                        </label>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.apellido" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Apellido
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.movil" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Movil
                                        </label>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="form.correo" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Correo
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <select class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" v-model="form.idrol">
                                            <option value="" >Seleccione perfil</option>
                                            <option value="2">Cliente</option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Perfil
                                        </label>
                                    </div>
                                </div>
                                <div class="flex mx-auto">
                                    <button type="button" @click="getUsers('', '', form)" class="mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                                    <a  href="#" @click="UsersExport(form)">
                                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" class="h-8 w-8"><path fill="#4CAF50" d="M41,10H25v28h16c0.553,0,1-0.447,1-1V11C42,10.447,41.553,10,41,10z"/><path fill="#FFF" d="M32 15H39V18H32zM32 25H39V28H32zM32 30H39V33H32zM32 20H39V23H32zM25 15H30V18H25zM25 25H30V28H25zM25 30H30V33H25zM25 20H30V23H25z"/><path fill="#2E7D32" d="M27 42L6 38 6 10 27 6z"/><path fill="#FFF" d="M19.129,31l-2.411-4.561c-0.092-0.171-0.186-0.483-0.284-0.938h-0.037c-0.046,0.215-0.154,0.541-0.324,0.979L13.652,31H9.895l4.462-7.001L10.274,17h3.837l2.001,4.196c0.156,0.331,0.296,0.725,0.42,1.179h0.04c0.078-0.271,0.224-0.68,0.439-1.22L19.237,17h3.515l-4.199,6.939l4.316,7.059h-3.74V31z"/></svg>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </section>
                    <!-- Tabla de contenido -->
                    <section>
                        <div class="lg:px-4 md:px-2 sm:px-0 py-2 pb-6">
                            <table class="table-fixed w-full">
                                <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 w-1/12 text-sm font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                        <button @click="getUsers(buscar, 'documento')" class="font-bold">
                                            Documento
                                            <div v-show="sortBy == 'nombre'">
                                                <span v-show="!sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span v-show="sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </button>
                                    </th>
                                    <th class="px-4 py-2 w-2/12 text-sm font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                        <button @click="getUsers(buscar, 'nombre')" class="font-bold">
                                            Nombre
                                            <div v-show="sortBy == 'nombre'">
                                                <span v-show="!sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span v-show="sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </button>
                                    </th>
                                    <th class="px-4 py-2 text-sm w-1/12 font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                        <button @click="getUsers(buscar, 'movil')" class="font-bold">
                                            Celular
                                            <div v-show="sortBy == 'movil'">
                                                <span v-show="!sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span v-show="sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </button>
                                    </th>
                                    <th class="px-4 py-2 text-sm w-2/12 font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                        <button @click="getUsers(buscar, 'ciudad.precio')" class="font-bold">
                                            Correo
                                            <div v-show="sortBy == 'ciudad.precio'">
                                                <span v-show="!sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span v-show="sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </button>
                                    </th>
                                    <th class="px-4 py-2 text-sm font-bold w-1/12 hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                        <button @click="getUsers(buscar, 'estado')" class="font-bold">
                                            Estado
                                            <div v-show="sortBy == 'estado'">
                                                <span v-show="!sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span v-show="sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </button>
                                    </th>
                                    <th class="lg:px-4 md:px-1 mx-auto py-2 text-sm font-bold lg:w-1/12 md:w-1/11 hover:bg-blue-500 hover:text-gray-50 rounded-b">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="text-center" text-sm v-if="arrayData.data" v-for="(user, id) in arrayData.data" :key="id">
                                    <td class="border px-1 py-2 text-sm truncate" v-text="user.documento"></td>
                                    <td class="border px-1 py-2 text-sm truncate" v-text="user.nombre + ' ' + user.apellido"></td>
                                    <td class="border px-1 py-2 text-sm truncate" v-text="user.movil"></td>
                                    <td class="border px-1 py-2 text-sm truncate" v-text="user.correo"></td>
                                    <td class="border px-2 py-2 text-sm truncate" v-if="user.estado">
                                        <span class="inline-flex px-2 text-sm font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                            Activo
                                        </span>
                                    </td>
                                    <td class="border px-2 py-2 text-sm" v-else>
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                            Inactivo
                                        </span>
                                    </td>
                                    <td class="border px-1 py-1 mx-auto text-center flex items-center">
                                        <button @click="ver(user)" class="hover:bg-green-700 text-green-400 font-bold rounded" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                                            </svg>
                                        </button>
                                        <button @click="edit(user)" class="hover:bg-blue-700 text-white font-bold rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button @click="deleteRow(user)" class="hover:bg-red-700 text-white font-bold rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path v-if="user.estado" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                <path v-else fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>

                                        </button>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <td class="border px-4 py-2 text-xs text-center" colspan="7"> La consulta no obtuvo datos</td>
                                </tr>
                                </tbody>
                            </table>
                            <section class="mt-6">
                                <div v-if="arrayData.links.length > 3">
                                    <div class="flex flex-wrap -mb-1">
                                        <template v-for="(link, p) in arrayData.links" :key="p">
                                            <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                                                 v-html="link.label" />
                                            <button  v-else
                                                     class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                                                     :class="{ 'bg-blue-700 text-white': link.active }"
                                                     v-on:click="cambiarPage(link.url, 'vendedor', form)"
                                                     v-html="link.label" />
                                        </template>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </section>
                    <!-- Fin Tabla de contenido -->

                    <!-- Ventana modal Detalles -->
                    <section> <!-- Ventana modal -->
                        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                                <div class="fixed inset-0 transition-opacity">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>
                                <!-- This element is to trick the browser into centering the modal contents. -->
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                                <div class="inline-block lg:w-8/12 align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                    <button type="button" @click="closeModal()" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </button>
                                    <div class="">
                                        <h2 v-text="tituloModal" class="text-sm font-bold text-gray-900 px-4 py-4"></h2>
                                    </div>
                                    <form>
                                        <div class="bg-white px-4 pt-2 pb-4 sm:p-6 sm:pb-4">
                                            <div class="">
                                                <section>
                                                    <div class="mt-2 grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-4">
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Nombre</label>
                                                            <div class="mt-1">
                                                                <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.nombre" autocomplete="given-name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <div v-if="$page.props.errors.nombre" class="text-red-500">{{ $page.props.errors.nombre }}</div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Apellido</label>
                                                            <div class="mt-1">
                                                                <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.apellido" autocomplete="family-name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <div v-if="$page.props.errors.apellido" class="text-red-500">{{ $page.props.errors.apellido }}</div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Correo</label>
                                                            <div class="mt-1">
                                                                <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.correo" autocomplete="street-address" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <div v-if="$page.props.errors.correo" class="text-red-500">{{ $page.props.errors.correo }}</div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Movil</label>
                                                            <div class="mt-1">
                                                                <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.movil" autocomplete="street-address" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <div v-if="$page.props.errors.movil" class="text-red-500">{{ $page.props.errors.movil }}</div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Tipo documento</label>
                                                            <div class="mt-1">
                                                                <select :disabled="verMode" :class="{'bg-blue-100' : verMode}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.idtipos_documento">
                                                                    <option value="0" >Seleccione</option>
                                                                    <option v-for="tipodoc in arrayTiposdocumento" :key="tipodoc.id" :value="tipodoc.id" v-text="tipodoc.nombre_corto"></option>
                                                                </select>
                                                                <div v-if="$page.props.errors.idtipos_documento" class="text-red-500">{{ $page.props.errors.idtipos_documento }}</div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Documento</label>
                                                            <div class="mt-1">
                                                                <input type="text" :verMode="editMode" :class="{'bg-blue-100' : verMode}" v-model="form.documento" autocomplete="postal-code" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <div v-if="$page.props.errors.documento" class="text-red-500">{{ $page.props.errors.documento }}</div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Username</label>
                                                            <div class="mt-1">
                                                                <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.username" autocomplete="postal-code" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <div v-if="$page.props.errors.username" class="text-red-500">{{ $page.props.errors.username }}</div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Password</label>
                                                            <div class="mt-1">
                                                                <input type="password" v-if="!editMode" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.password" autocomplete="postal-code" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <div v-if="$page.props.errors.password" class="text-red-500">{{ $page.props.errors.password }}</div>

                                                                <div class="flex items-center">
                                                                    <input v-if="!verMode" checked v-model="form.cambiarpassword" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                                                                    <label v-if="!verMode" class="ml-2 text-sm font-medium text-gray-900">Solicitar cambio?</label>
                                                                    <a href="#" @click="cambiarPass()" v-if="editMode">
                                                                        <span class="ml-2 underline text-sm text-blue-600"> Cambiar Password</span>
                                                                    </a>

                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                                                            <div class="mt-1">
                                                                <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.telefono" autocomplete="postal-code" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <div v-if="$page.props.errors.telefono" class="text-red-500">{{ $page.props.errors.telefono }}</div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">País</label>
                                                            <div class="mt-1">
                                                                <select :disabled="verMode" :class="{'bg-blue-100' : verMode}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.idpais" @change="getDepartamentos()">
                                                                    <option value="0" >Seleccione País</option>
                                                                    <option v-for="pais in arrayPaises" :key="pais.id" :value="pais.id" v-text="pais.nombre"></option>
                                                                </select>
                                                                <div v-if="$page.props.errors.idpais" class="text-red-500">{{ $page.props.errors.idpais }}</div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Departamento</label>
                                                            <div class="mt-1">
                                                                <select :disabled="verMode" :class="{'bg-blue-100' : verMode}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.iddepartamento" @change="getCiudades">
                                                                    <option value="0" >Seleccione departamento</option>
                                                                    <option v-for="departamento in arrayDepartamentos" :key="departamento.id" :value="departamento.id" v-text="departamento.nombre"></option>
                                                                </select>
                                                                <div v-if="$page.props.errors.iddepartamento" class="text-red-500">{{ $page.props.errors.iddepartamento }}</div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Ciudad</label>
                                                            <div class="mt-1">
                                                                <select :disabled="verMode" :class="{'bg-blue-100' : verMode}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.idciudad">
                                                                    <option value="0" >Seleccione Ciudad</option>
                                                                    <option v-for="ciudad in arrayCiudades" :key="ciudad.id" :value="ciudad.id" v-text="ciudad.nombre"></option>
                                                                </select>
                                                                <div v-if="$page.props.errors.idciudad" class="text-red-500">{{ $page.props.errors.idciudad }}</div>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Dirección</label>
                                                            <div class="mt-1">
                                                                <input type="email" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.direccion" autocomplete="email" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <div v-if="$page.props.errors.direccion" class="text-red-500">{{ $page.props.errors.direccion }}</div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Rol</label>
                                                            <div class="mt-1">
                                                                <select :disabled="verMode" @change="getEmpresas()" :class="{'bg-blue-100' : verMode}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.idrol">
                                                                    <option value="0" >Seleccione Rol</option>
                                                                    <option v-show="rol.id == 5" v-for="rol in arrayRoles" :key="rol.id" :value="rol.id" v-text="rol.nombre"></option>
                                                                </select>
                                                                <div v-if="$page.props.errors.idrol" class="text-red-500">{{ $page.props.errors.idrol }}</div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Empresa</label>
                                                            <div class="mt-1">
                                                                <select :disabled="verMode" :class="{'bg-blue-100' : verMode}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.idempresa">
                                                                    <option value="0" >Seleccione empresa</option>
                                                                    <option v-for="empresa in arrayEmpresas" :key="empresa.id" :value="empresa.id" v-text="empresa.razon_social"></option>
                                                                </select>
                                                                <div v-if="$page.props.errors.idempresa" class="text-red-500">{{ $page.props.errors.idempresa }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                              <button v-show="newMode" @click="save(form)" wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                Guardar
                                              </button>
                                            </span>
                                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                              <button v-show="editMode" @click="update(form)" wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                Actualizar
                                              </button>
                                            </span>
                                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                                          <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                            Cancelar
                                          </button>
                                        </span>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Ventana modal Detalles -->

                    <!-- Ventana modal cambiar passwd -->
                    <!-- Main modal -->
                    <section> <!-- Ventana modal -->
                        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpencambiopass">
                            <div class="items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                                <div class="fixed inset-0 transition-opacity">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>

                                <!-- This element is to trick the browser into centering the modal contents. -->
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                                <div class="inline-block lg:w-6/12 align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                    <button type="button" @click="closeModalPass()" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </button>
                                    <div class="">
                                        <h2 v-text="tituloModal" class="text-xl font-bold text-gray-900 px-4 py-4"></h2>
                                    </div>
                                    <form @submit.prevent="submit">
                                        <div class="bg-white px-4 pt-2 pb-4 ">
                                            <div class="">
                                                <section>
                                                    <div class="mt-2 grid gap-y-6 ">
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Password</label>
                                                            <div class="mt-1">
                                                                <input type="password" v-model="formpasswd.password" autocomplete="given-name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                <div v-if="$page.props.errors.updatePassword" class="text-red-500">{{ $page.props.errors.updatePassword }}</div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Confirmar Password</label>
                                                            <div class="mt-1">
                                                                <input type="password" v-model="formpasswd.password_confirmation" autocomplete="given-name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                              <button wire:click.prevent="updatePass()" @click="updatePass(formpasswd)" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                Cambiar password
                                              </button>
                                            </span>
                                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                                          <button @click="closeModalPass()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                            Cancelar
                                          </button>
                                        </span>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Ventana modal passwd -->


                </div>
            </div>
        </div>
    </AppLayoutapp2>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Swal from "sweetalert2";
import { Icon } from '@iconify/vue';
import Pagination from '@/Components/Pagination';

import Toggle from '@vueform/toggle';
import '@vueform/toggle/themes/default.css';
import Button from "../../Jetstream/Button";

import moment from 'moment'
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref, onMounted } from 'vue';

import { Money3Component } from 'v-money3'


import { Inertia } from '@inertiajs/inertia';
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
        Pagination,
        Toggle,
        QuillEditor,
        JetNavLink,
        Link,
        money3: Money3Component,

    },
    props:{
        vendedores : [],
        errors: Object
    },
    computed: {

    },
    data() {
        return {
            tituloModal: '',
            formpasswd: {
                _token: usePage().props.value._token,
                id: '',
                tipouser: 'vendedor',
                password: '',
                password_confirmation: '',
            },
            form: {
                id: null,
                nombre: '',
                correo: null,
                username: null,
                apellido: null,
                idrol: 5,
                estado: 1,
                idtipos_documento: 0,
                documento: null,
                direccion: null,
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
                    //this.getUsers('','nombre');
                    //this.editMode = false;
                    //this.closeModal();
                },
            });
        },
        openModal: function (accion, data = []) {
            this.isOpen = true;

            switch (accion) {
                case 'registrar':
                {
                    this.tituloModal = 'Crear nuevo Vendedor';
                    this.form.idpais = 0;
                    this.form.iddepartamento = 0;
                    this.form.idciudad = 0;
                    this.form.idtipos_documento = 0;
                    this.form.idrol = 5;
                    this.form.idempresa = 0;
                    this.form.username = null;
                    this.form.password = null;
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
            this.tituloModal = 'Crear nuevo rifa de venta';
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
            this.form.fechafin = null;
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
                    this.getUsers('','nombre');
                    this.closeModal();
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
            this.$inertia.post('/users/vendedor/'  + data.id, data, {
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

            var url= '/users/indexvendedores';
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
                this.arrayData = respuesta.vendedores;
            })
        },
        UsersExport: function (filtros = []) {
            let fecha = moment(new Date()).format('DDMMYYYY');
            var url= '/clientes/export';
            axios.get(url, {
                params: {
                    filtros: filtros,
                },
                responseType: 'blob',
            }).then((response) => {
                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement('a');

                fileLink.href = fileURL;
                fileLink.setAttribute('download', 'clientes_'+ fecha + '.xlsx');
                document.body.appendChild(fileLink);

                fileLink.click();
            })
        },

    },
    created: function () {
        this.arrayData = this.vendedores;
    },
    mounted() {
    },
}
</script>
