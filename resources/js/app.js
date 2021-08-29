/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('Posts', require('./components/Posts.vue'));
Vue.component('Categories', require('./components/Categories.vue'));
Vue.component('register', require('./components/Register.vue').default);
Vue.component('login', require('./components/Login.vue').default);
Vue.component('test', require('./components/Test.vue'));
Vue.component('global-home', require('./components/GlobalHome.vue').default);
Vue.component('pagination', require('laravel-vue-pagination'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import routes from './routes/routes';
import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

const store=new Vuex.Store({
    state: {
        userToken: null,
        user: null,
        EditedPost: {},
        isExists:'no'
    },
    getters: { //center
        isLogged(state) {
            return !!state.userToken;
        },
        isAdmin(state) {
            if (state.user) {
                return state.user.is_admin
            }
            return null

        },
        PostToEdit(state) {
            return state.EditedPost
        },
        isExists(state){
            return state.isExists
        }
    },
    mutations: {
        setUserToken(state, userToken) {
            state.userToken = userToken;
            localStorage.setItem('userToken', JSON.stringify(userToken));
            axios.defaults.headers.common.Authorization = `Bearer ${userToken}`
        },
        removeUserToken(state) {

            state.userToken = null;
            localStorage.removeItem('userToken')
        },
        setUser(state, user) {
            state.user = user
        },
        logout(state) {
            state.userToken = null;
            localStorage.removeItem('userToken');
            window.location.pathname = "/"
        },
        EditPost(state, post) {
            state.EditedPost = post;
        },
        setExist(state, val)
        {
            state.isExists=val;
        }
    },
    actions: {
        async RegisterUser({ commit }, payload) {
           try{
            commit('setExist','no');
            const res = await axios.post('/api/register', payload);
               
                    //console.log(res)
                    //console.log("exist val",res.data)
                    if(res.data.exist=='yes')
                    {
                      commit('setExist','yes');
                      //console.log('exist yessss');
                    }
                    else
                    {
                        commit('setUserToken', res.data.token);
                        commit('setExist','no');
                    }
                } catch(err) {
                    console.log(err)
                }
        },
        LoginUser({ commit }, payload) {
            axios.post('/api/login', payload)
                .then(res => {
                    console.log(res)
                    commit('setUserToken', res.data.token)
                    axios.get('/api/user')
                        .then(res => {
                            //console.log(res.data)
                            commit('setUser', res.data.user)
                        })
                })
                .catch(err => {
                    console.log(err)
                })

        }

    }

})

const app = new Vue({
    el: '#app',
    router:routes,
    store: store
    
});
