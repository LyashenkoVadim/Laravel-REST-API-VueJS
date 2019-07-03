
require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
window.Vue.use(VueRouter);

import LibrariesIndex from './components/libraries/LibrariesIndex.vue';
import LibrariesCreate from './components/libraries/LibrariesCreate.vue';
import LibrariesEdit from './components/libraries/LibrariesEdit.vue';

const routes = [
    {
        path: '/',
        components: {
            LibrariesIndex: LibrariesIndex
        }
    },
    {path: '/admin/libraries/create', component: LibrariesCreate, name: 'createLibrary'},
    {path: '/admin/libraries/edit/:id', component: LibrariesEdit, name: 'editLibrary'},
]

const router = new VueRouter({ routes });

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({ router }).$mount('#app');
