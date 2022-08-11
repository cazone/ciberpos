require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
// Import my modules
import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'
import es from 'element-plus/lib/locale/lang/es'
import VueNumerals from 'vue-numerals';
import moment from 'moment'


const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'SC Redes';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ElementPlus,{
                locale: es
            })
            .use(VueNumerals)

            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' , showSpinner: true});
