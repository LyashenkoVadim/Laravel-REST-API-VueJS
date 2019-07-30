require('./bootstrap');

window.Vue = require('vue');
import Vuex from 'vuex';
import VueRouter from 'vue-router';

window.Vue.use(VueRouter);
Vue.use(Vuex);

import Login from './components/auth/Login.vue';

import LibrariesIndex from './components/libraries/LibrariesIndex.vue';
import LibrariesCreate from './components/libraries/LibrariesCreate.vue';
import LibrariesEdit from './components/libraries/LibrariesEdit.vue';

const routes = [
    // {
    //     path: '/',
    //     components: {
    //         Login: Login,
    //         LibrariesIndex: LibrariesIndex
    //     }
    // },
    {path: '/login', component: Login, name: 'login'},
    {path: '/admin/libraries', component: LibrariesIndex, name: 'librariesIndex'},
    {path: '/admin/libraries/create', component: LibrariesCreate, name: 'createLibrary'},
    {path: '/admin/libraries/edit/:id', component: LibrariesEdit, name: 'editLibrary'},
]

const router = new VueRouter({ routes });

export const store = new Vuex.Store({
    state: {
        token: localStorage.getItem('access_token') || null,
    },
    mutations: {
        retrieveToken(state, token) {
            state.token = token
        },
    },
    actions: {
        retrieveToken(context, credentials) {
            return new Promise((resolve, reject) => {
                axios.post('/api/login', {
                    username: credentials.username,
                    password: credentials.password,
                })
                .then(response => {
                    const token = response.data.access_token
                    localStorage.setItem('access_token', token)
                    context.commit('retrieveToken', token)
                    resolve(response)
                    console.log(response);
                    // context.commit('addTodo', response.data)
                })
                .catch(error => {
                    console.log(error)
                    reject(error)
                })
            })
        },
    }
});

const app = new Vue({ router, store }).$mount('#app');
