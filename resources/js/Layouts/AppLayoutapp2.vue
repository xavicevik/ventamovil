<template>
<div>
<div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
    <!-- Sidebar -->
    <div class="flex flex-shrink-0 transition-all">
        <div
            v-if="isSidebarOpen"
            @click="isSidebarOpen = false"
            class="fixed inset-0 z-10 bg-black bg-opacity-50 lg:hidden"
        ></div>
        <div v-if="isSidebarOpen" class="fixed inset-y-0 z-10 w-16 bg-white"></div>

        <!-- Left mini bar -->
        <nav
            aria-label="Options"
            class="z-20 flex-col items-center flex-shrink-0 hidden w-16 py-4 bg-white border-r-2 border-indigo-100 shadow-md sm:flex rounded-tr-3xl rounded-br-3xl"
        >
            <!-- Logo -->
            <div class="flex-shrink-0 py-2">
                <a href="#">
                    <img
                        class="w-10 h-auto"
                        src="storage/img/tigo_une_logo.jpg"
                        alt="VentaMovil"
                    />
                </a>
            </div>
            <div class="flex flex-col items-center flex-1 p-2 space-y-4">
                <!-- Menu button -->
                <button
                    @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
                    class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                    :class="(isSidebarOpen && currentSidebarTab == 'linksTab') ? 'text-white bg-indigo-600' : 'text-gray-500 bg-white'"
                >
                    <span class="sr-only">Toggle sidebar</span>
                    <svg
                        aria-hidden="true"
                        class="w-6 h-6"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                    </svg>
                </button>
                <!-- Messages button -->
                <button
                    @click="(isSidebarOpen && currentSidebarTab == 'messagesTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'messagesTab'"
                    class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                    :class="(isSidebarOpen && currentSidebarTab == 'messagesTab') ? 'text-white bg-indigo-600' : 'text-gray-500 bg-white'"
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
                    @click="(isSidebarOpen && currentSidebarTab == 'notificationsTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'notificationsTab'"
                    class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                    :class="(isSidebarOpen && currentSidebarTab == 'notificationsTab') ? 'text-white bg-indigo-600' : 'text-gray-500 bg-white'"
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
            </div>

            <!-- User avatar -->
            <div class="relative flex items-center flex-shrink-0 p-2" x-data="{ isOpen: false }">
                <button
                    @click="isOpen = !isOpen; $nextTick(() => {isOpen ? $refs.userMenu.focus() : null})"
                    class="transition-opacity rounded-lg opacity-80 hover:opacity-100 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                >
                    <img
                        class="w-10 h-10 rounded-lg shadow-md"
                        src="https://avatars.githubusercontent.com/u/57622665?s=460&u=8f581f4c4acd4c18c33a87b3e6476112325e8b38&v=4"
                        alt="Ahmed Kamel"
                    />
                    <span class="sr-only">User menu</span>
                </button>
                <div
                    v-if="isOpen"
                    @click.away="isOpen = false"
                    @keydown.escape="isOpen = false"
                    x-ref="userMenu"
                    tabindex="-1"
                    class="absolute w-48 py-1 mt-2 origin-bottom-left bg-white rounded-md shadow-lg left-10 bottom-14 focus:outline-none"
                    role="menu"
                    aria-orientation="vertical"
                    aria-label="user menu"
                >
                    <a href="/user/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                    >Your Profile</a
                    >

                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Settings</a>

                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Sign out</a>
                </div>
            </div>
        </nav>

        <transition
            enter-active-class="transform transition-transform duration-300"
            leave-active-class="transform transition-transform duration-300"
            enter-from-class="-translate-x-full"
            enter-to-class="translate-x-0"
            leave-from-class="translate-x-0"
            leave-to-class="-translate-x-full"
        >
            <div
                v-if="isSidebarOpen"
                class="fixed inset-y-0 left-0 z-10 flex-shrink-0 w-64 bg-white border-r-2 border-indigo-100 shadow-lg sm:left-16 rounded-tr-3xl rounded-br-3xl sm:w-72 lg:static lg:w-64"
            >
                <nav v-if="currentSidebarTab == 'linksTab'" aria-label="Main" class="flex flex-col h-full">
                    <!-- Logo -->
                    <div class="mx-auto items-center justify-center py-4">
                        <a href="#">
                            <img
                                class="w-24 h-auto"
                                src="storage/img/tigo_une_logo.jpg"
                                alt="VentaMovil"
                            />
                        </a>
                        <div class="mx-auto">
                            Venta Movil Edatel
                        </div>
                    </div>

                    <!-- Links -->
                    <div class="flex-1 px-4 space-y-2 overflow-hidden hover:overflow-auto">
                        <a :href="route('cliente.create')" class="flex items-center w-full space-x-2 text-white bg-blue-600 rounded-lg">
                            <span aria-hidden="true" class="p-2 bg-red-700 text-white rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                </svg>
                            </span>
                            <span>Clientes</span>
                        </a>
                        <a
                            href="#"
                            class="flex items-center space-x-2 text-white bg-blue-600 transition-colors rounded-lg group hover:bg-indigo-600 hover:text-white"
                        >
                            <span
                                aria-hidden="true"
                                class="p-2 transition-colors bg-red-700 text-white rounded-lg group-hover:bg-indigo-700 group-hover:text-white"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </span>
                            <span>Consulta de contratos</span>
                        </a>
                        <a
                            href="#"
                            class="flex items-center space-x-2 text-white bg-blue-600 transition-colors rounded-lg group hover:bg-indigo-600 hover:text-white"
                        >
                            <span
                              aria-hidden="true"
                              class="p-2 transition-colors bg-red-700 text-white rounded-lg group-hover:bg-indigo-700 group-hover:text-white"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                            </span>
                            <span>Registro</span>
                        </a>
                        <a
                            href="#"
                            class="flex items-center space-x-2 text-white bg-blue-600 transition-colors rounded-lg group hover:bg-indigo-600 hover:text-white"
                        >
                            <span
                                aria-hidden="true"
                                class="p-2 transition-colors bg-red-700 text-white rounded-lg group-hover:bg-indigo-700 group-hover:text-white"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>

                            </span>
                            <span>Productos</span>
                        </a>
                        <a
                            :href="route('venta.create')"
                            class="flex items-center space-x-2 text-white bg-blue-600 transition-colors rounded-lg group hover:bg-indigo-600 hover:text-white"
                        >
                            <span
                                aria-hidden="true"
                                class="p-2 transition-colors bg-red-700 text-white rounded-lg group-hover:bg-indigo-700 group-hover:text-white"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                </svg>

                            </span>
                            <span>Venta</span>
                        </a>
                        <a
                            href="#"
                            class="flex items-center space-x-2 text-white bg-blue-600 transition-colors rounded-lg group hover:bg-indigo-600 hover:text-white"
                        >
                            <span
                                aria-hidden="true"
                                class="p-2 transition-colors bg-red-700 text-white rounded-lg group-hover:bg-indigo-700 group-hover:text-white"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 002.25-2.25V6a2.25 2.25 0 00-2.25-2.25H6A2.25 2.25 0 003.75 6v2.25A2.25 2.25 0 006 10.5zm0 9.75h2.25A2.25 2.25 0 0010.5 18v-2.25a2.25 2.25 0 00-2.25-2.25H6a2.25 2.25 0 00-2.25 2.25V18A2.25 2.25 0 006 20.25zm9.75-9.75H18a2.25 2.25 0 002.25-2.25V6A2.25 2.25 0 0018 3.75h-2.25A2.25 2.25 0 0013.5 6v2.25a2.25 2.25 0 002.25 2.25z" />
                                </svg>

                            </span>
                            <span>Empaquetar</span>
                        </a>
                        <a
                            href="#"
                            @click="logout"
                            class="flex pt-4 items-center space-x-2 text-blue-800 transition-colors rounded-lg group hover:bg-indigo-600 hover:text-white"
                        >
                            <span
                                aria-hidden="true"
                                class="p-2 transition-colors bg-red-700 text-white rounded-lg group-hover:bg-indigo-700 group-hover:text-white"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                                </svg>


                            </span>
                            <span>Salir</span>
                        </a>
                    </div>

                    <footer class="text-center text-white">
                        <div class="text-center text-blue-800 p-4 text-sm">
                            © 2022 Copyright<br>
                            <a class="text-gray-800 text-sm" href="">Venta Movil v2.0</a>
                        </div>
                    </footer>
                </nav>
            </div>
        </transition>
    </div>
    <div class="flex flex-col flex-1">
        <header class="relative flex items-center justify-between flex-shrink-0 w-full">
            <div>
                <img
                    src="storage/img/logo_fondo.jpg"
                    alt="VentaMovil"
                />
            </div>
        </header>

        <div class="flex-1 pb-8"><!-- flex -->
            <!-- Main -->
            <!-- flex items-center justify-center flex-1 px-4 py-8 -->
            <main>

                <slot />
                <!-- Content -->
            </main>
        </div>
        <!-- Mobile bottom bar -->
        <nav
            aria-label="Options"
            class="fixed inset-x-0 bottom-0 flex flex-row-reverse items-center justify-between px-4 py-2 bg-white border-t border-indigo-100 sm:hidden shadow-t rounded-t-3xl"
        >
            <!-- Menu button -->
            <button
                @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'"
                class="p-2 transition-colors rounded-lg shadow-md hover:bg-indigo-800 hover:text-white focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                :class="(isSidebarOpen && currentSidebarTab == 'linksTab') ? 'text-white bg-indigo-600' : 'text-gray-500 bg-white'"
            >
                <span class="sr-only">Toggle sidebar</span>
                <svg
                    aria-hidden="true"
                    class="w-6 h-6"
                    xmlns="http://www.w3.org/2000/svg"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </button>


            <div class="flex items-center flex-shrink-0 mx-auto">
                Vendedor {{ Vendedor }}
            </div>


            <!-- User avatar button -->
            <div class="relative flex items-center flex-shrink-0 p-2" x-data="{ isOpen: false }">
                <button
                    @click="isOpen = !isOpen; $nextTick(() => {isOpen ? $refs.userMenu.focus() : null})"
                    class="transition-opacity rounded-lg opacity-80 hover:opacity-100 focus:outline-none focus:ring focus:ring-indigo-600 focus:ring-offset-white focus:ring-offset-2"
                >
                    <img v-if="$page.props.user.profile_photo_path" class="w-8 md:w-8 mr-2 rounded-md overflow-hidden" :src="'../storage/' + $page.props.user.profile_photo_path" />
                    <img v-else class="w-8 h-8 md:w-7 md:h-7 mr-2 rounded-md overflow-hidden" src="https://therminic2018.eu/wp-content/uploads/2018/07/dummy-avatar.jpg" />

                    <span class="sr-only">Menú Usuario</span>
                </button>
                <div
                    v-if="isOpen"
                    @click.away="isOpen = false"
                    @keydown.escape="isOpen = false"
                    x-ref="userMenu"
                    tabindex="-1"
                    class="absolute w-48 py-1 mt-2 origin-bottom-left bg-white rounded-md shadow-lg left-10 bottom-14 focus:outline-none"
                    role="menu"
                    aria-orientation="vertical"
                    aria-label="user menu"
                >
                    <a href="/user/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem"
                    >Perfil</a
                    >

                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Configuración</a>

                    <a href="*" @click="logout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Salir</a>
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Panels -->

<!-- Settings Panel -->
<!-- Backdrop -->
<div
    v-if="isSettingsPanelOpen"
    class="fixed inset-0 bg-black bg-opacity-50"
    @click="isSettingsPanelOpen = false"
    aria-hidden="true"
></div>



</div>

</template>

<script>

import {Inertia} from "@inertiajs/inertia";

export default {

    components: {

    },
    props:{
        Vendedor: 0,
        localidad: 0,
        localidaddesc: ''
    },
    computed: {
    },
    data() {
        return {
            isSidebarOpen: false,
            currentSidebarTab: null,
            isSettingsPanelOpen: false,
            isSubHeaderOpen: false,
        }
    },
    methods: {
        watchScreen() {
            if (window.innerWidth <= 1024) {
                this.isSidebarOpen = false
            }
        },
        logout: function() {
            Inertia.post(route('logout'));
        }
    },
    created: function () {
    },
    mounted() {
        this.watchScreen();
    },
}
</script>
