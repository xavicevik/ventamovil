<script setup>
import { ref, computed  } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue';
import JetBanner from '@/Jetstream/Banner.vue';
import JetDropdown from '@/Jetstream/Dropdown.vue';
import JetDropdownLink from '@/Jetstream/DropdownLink.vue';
import JetNavLink from '@/Jetstream/NavLink.vue';
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue';
import { usePage } from '@inertiajs/inertia-vue3'

defineProps({
    title: String,
    isOpenCart: false,
    total: null,
});
import Button from "../Jetstream/Button";
const showingNavigationDropdown = ref(false);

const logout = () => {
    Inertia.post(route('logout'));
};

</script>
<script>
export default {
    data() {
        return {
            isMenutransac: false,
            isMenuConfig: false,
            isMenuUsers: false,
            isMenuPuntoventa: false,
            isMenuCajas: false,
            isMenuRifas: false,
            isMenuVentas: false,
            isMenuComision: false,
            sidebarOpen: true,
            selectedRow: null,
        }
    },
    computed: {

    },
}
</script>


<template>

    <div class="flex overflow-x-hidden h-screen">
        <aside class="h-screen bg-white text-red-900 overflow-auto sticky top-0 flex-shrink-0 w-64 flex flex-col border-r transition-all duration-300" :class="{ '-ml-64': !sidebarOpen }">

            <div class="flex flex-col h-full">
                <div class="flex-grow">
                    <ul class="flex flex-col py-2 space-y-1">
                        <span>
                            <img src="/storage/img/logo_fondo.jpg" class="mx-auto" alt="" />
                        </span>
                        <li class="px-5 md:block">
                            <div class="flex flex-row items-center h-8">
                                <div class="text-sm font-bold tracking-wide text-gray-900 uppercase">Principal</div>
                            </div>
                        </li>
                        <li>
                            <Link :href="route('dashboard')" @click="rowSelect('dashboard')" :class=" (selectedRow === 'dashboard' || route().current('dashboard')) ? 'border-blue-500 bg-blue-200' : 'hover:border-gray-500'" class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-blue-200 text-white-600 hover:text-white-800 border-l-4 border-transparent pr-6">
                                <span class="inline-flex justify-center items-center ml-4 text-red-500">
                                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
                            </Link>
                        </li>
                        <li>
                            <a href="#" @click="isMenuVentas = !isMenuVentas; rowSelect('isMenuVentas')" :class=" (selectedRow === 'isMenuVentas' || route().current('ventas.index')) ? 'border-blue-500 bg-blue-200' : 'hover:border-gray-500'" class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-blue-200 text-white-600 hover:text-white-800 border-l-4 border-transparent pr-6">
                                <span class="inline-flex justify-center items-center ml-4 text-blue-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                </span>
                                <span class="ml-2 text-sm tracking-wide truncate">Ventas</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <footer class="text-center text-white">
                    <div class="container pt-4">
                        <div class="flex justify-center mb-4">
                            <a href="#!" class="mr-4 text-gray-800">
                                <svg
                                    aria-hidden="true"
                                    focusable="false"
                                    data-prefix="fab"
                                    data-icon="facebook-f"
                                    class="svg-inline--fa fa-facebook-f w-2.5"
                                    role="img"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 320 512"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"
                                    ></path>
                                </svg>
                            </a>


                            <a href="#!" class="mr-9 text-gray-800">
                                <svg
                                    aria-hidden="true"
                                    focusable="false"
                                    data-prefix="fab"
                                    data-icon="instagram"
                                    class="svg-inline--fa fa-instagram w-3.5"
                                    role="img"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"
                                    ></path>
                                </svg>
                            </a>
                            <a href="#!" class="mr-9 text-gray-800">
                                <svg
                                    aria-hidden="true"
                                    focusable="false"
                                    data-prefix="fab"
                                    data-icon="linkedin-in"
                                    class="svg-inline--fa fa-linkedin-in w-3.5"
                                    role="img"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M100.28 448H7.4V148.9h92.88zM53.79 108.1C24.09 108.1 0 83.5 0 53.8a53.79 53.79 0 0 1 107.58 0c0 29.7-24.1 54.3-53.79 54.3zM447.9 448h-92.68V302.4c0-34.7-.7-79.2-48.29-79.2-48.29 0-55.69 37.7-55.69 76.7V448h-92.78V148.9h89.08v40.8h1.3c12.4-23.5 42.69-48.3 87.88-48.3 94 0 111.28 61.9 111.28 142.3V448z"
                                    ></path>
                                </svg>
                            </a>

                        </div>
                    </div>

                    <div class="text-center text-gray-800 p-2 text-sm bg-gray-200">
                        © 2022 Copyright:
                        <a class="text-gray-800 text-sm" href="https://www.shoppingred.com.co/">ShoppingRed</a>
                    </div>
                </footer>
            </div>
        </aside>
        <div class="flex-1">
            <header class="sticky top-0 w-full flex items-center p-4 text-semibold text-red-900 bg-white">
                <button class="p-1 mr-4" @click="sidebarOpen = !sidebarOpen;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-6 w-6">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Header -->
                <div class="flex items-center w-1/3 justify-start md:justify-center pl-3 h-10 border-none">

                </div>
                <div class="flex w-1/3 justify-end pr-2 items-right h-10 header-right">
                    <ul class="flex">
                        <Popper content="Profile" hover=true placement="top" arrow=true>
                            <a href="/user/profile">
                                <button class="flex mr-4 hover:text-blue-100">
                                    <li>
                                        <div class="block w-px h-7 mx-3 px-3 text-blue-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                        </div>
                                    </li>
                                </button>
                            </a>
                        </Popper>
                        <li>
                            <div class="block w-px h-7 mx-3 px-3 text-yellow-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                                </svg>
                            </div>
                        </li>

                        <li>
                            <div class="block w-px h-7 mx-3 px-4 text-black">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0M3.124 7.5A8.969 8.969 0 015.292 3m13.416 0a8.969 8.969 0 012.168 4.5" />
                                </svg>
                            </div>
                        </li>
                        <li>
                            <div class="block w-px h-7 mx-3 px-4">
                                <!-- Authentication -->
                                <Popper content="Salir" hover=true placement="top" arrow=true>
                                    <form method="POST" @submit.prevent="logout">
                                        <button class="flex mr-4 hover:text-blue-100">
                                        <span class="inline-flex mr-1">
                                          <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        </span>
                                        </button>
                                    </form>
                                </Popper>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- ./Header -->

            </header>
            <main class="p-4">
                <!-- Page Content -->
                <main>
                    <slot />
                </main>
            </main>
        </div>
    </div>
</template>
