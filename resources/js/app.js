require('./bootstrap');
require('popper.js');
// require('vue');
require('chart.js');
require('aos');
require('swiper');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';

createInertiaApp({
    resolve: name => require(`./pages/${name}`),
    setup({el, App, props, plugin}){
        createApp({
            render: () => h(App, props)
        })
        .use(plugins)
        .mount(el)
    }
});
