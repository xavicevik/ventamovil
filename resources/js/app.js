import Popper from "vue3-popper";

require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import Submenu from '@/Components/Submenu';
import Utilities from "./mixins/Utilities";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'VentaMovil';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .component('Datepicker', Datepicker)
            .component('Popper', Popper)
            .mixin(Utilities)
            .mount(el);
    },
});

InertiaProgress.init({
    color: '#4B5563',
    // Whether to include the default NProgress styles.
    includeCSS: true,

    // Whether the NProgress spinner will be shown.
    showSpinner: true,
});
