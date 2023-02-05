<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue';
import JetButton from '@/Jetstream/Button.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetCheckbox from '@/Jetstream/Checkbox.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';
import { usePage } from '@inertiajs/inertia-vue3'
import Input from "../../Jetstream/Input";
import NavLink from "../../Jetstream/NavLink";
import Button from "../../Jetstream/Button";
import {Icon} from "@iconify/vue/dist/iconify";
import Toggle from "@vueform/toggle";
import {QuillEditor} from "@vueup/vue-quill";
import {Money3Component} from "v-money3";
import Swal from "sweetalert2";

defineProps({
    canResetPassword: Boolean,
    status: String,
    arrayDepartamentos: [],
    _token: String,
    macAddr: ''
});

const form = useForm({
    Vendedor: '',
    Identificacion: '',
    departamento: 0,
    localidad: 0,
    telefono: '',
    _token: usePage().props.value._token,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login.authenticate'), {
        onFinish: () => form.reset('IMEI'),
    });
};

</script>

<script>

export default {
    data() {
        return {
            arrayLocalidades: []
        }
    },
    methods: {
        getLocalidadDepartamento: async function (departamento) {
            let url = '/master/getLocalidadDepartamento';
            var res = await axios.get(url, {
                params: {
                    departamento: departamento,
                }
            });
            console.log(res);
            let respuesta = res.data;
            this.arrayLocalidades = respuesta.data;
        }
    },
}
</script>

<template>
    <Head title="Log in" />

    <JetAuthenticationCard class="text-sm lg:text-md">
        <template #logo>
            <JetAuthenticationCardLogo />
        </template>

        <JetValidationErrors class="mb-4" />

        <div mx-auto class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-show="$page.props.flash.message">
            <div class="flex">
                <div>
                    <p class="text-sm">{{ $page.props.flash.message }}</p>
                </div>
            </div>
        </div>

        <form @submit.prevent="submit">
            <div>
                <JetLabel for="Vendedor" value="Codigo de vendedor" />
                <JetInput
                    id="Vendedor"
                    v-model="form.Vendedor"
                    type="number"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
            </div>

            <div>
                <JetLabel for="Identificacion" value="Identificación" />
                <JetInput
                    id="Identificacion"
                    v-model="form.Identificacion"
                    type="number"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
            </div>

            <div class="mt-4">
                <JetLabel for="departamento" value="Departamento" />

                <select @click="getLocalidadDepartamento(form.departamento)" @change="getLocalidadDepartamento(form.departamento)" class="block w-full rounded-lg text-gray-700 text-sm" required v-model="form.departamento">
                    <option value="0" >Seleccione el departamento</option>
                    <option v-for="opcion in arrayDepartamentos" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                </select>
            </div>

            <div class="mt-4">
                <JetLabel for="localidad" value="Localidad" />

                <select class="block w-full rounded-lg text-gray-700 text-sm" required v-model="form.localidad">
                    <option value="0" >Seleccione una localidad</option>
                    <option v-for="opcion in arrayLocalidades" :key="opcion.CODIGO" :value="opcion.CODIGO" v-text="opcion.DESCRIPCION"></option>
                </select>
            </div>

            <div>
                <JetLabel for="telefono" value="Teléfono" />
                <JetInput
                    id="telefono"
                    v-model="form.telefono"
                    type="number"
                    class="mt-1 block w-full"
                    required
                    autofocus
                />
            </div>

            <div class="flex items-center justify-end mt-4">

                <JetButton class="mx-auto text-red-white bg-red-700" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Ingresar
                </JetButton>
            </div>
        </form>
    </JetAuthenticationCard>
</template>
