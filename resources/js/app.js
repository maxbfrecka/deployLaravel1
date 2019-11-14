/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import App from './App.vue'

require('./bootstrap');
import VueRouter from 'vue-router'
import VueAudio from 'vue-audio'
import Routes from './routes'
import VueCsrf from 'vue-csrf'
import {store} from './store/store'
import VueSession from 'vue-session'

//session capabilities
Vue.use(VueSession)
//fixes csrf tokens
Vue.use(VueCsrf);
//routing capabilities
Vue.use(VueRouter)
window.Vue = require('vue');


// const cart = {props:['cart']}

//register the view router
const router = new VueRouter({
    routes:Routes,
    //mode sets so that the /#/ is removed from URL
    //that means the server needs to be configured so that / and anything AFTER / always returns index.html no matter what
    //the # is used to prevent requests to server
    mode:'history'
});

//automatically registers components for us
const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


const app = new Vue({
    el: '#vue-app',
    router:router,
    //this is essential. it holds the store from above from VUEX
    store,
    // render: h => h(App),
    data:{
    },
    props: [],
    components: {
        'vue-audio': VueAudio,
        'vue-router': VueRouter,
    },
    watch: { 
    },
    methods: {
        //grabs the cart on BOOT on app
        getCart(){
          fetch('api/cart')
              .then(res=>res.json())
              .then(res=>{
                  this.$store.state.cart = res.data
              })
        },
        getCartFromSession(){
          if(this.$session.get('cart')){
            console.log('getting cart from session cuz yeah')
            this.$store.state.cart=this.$session.get('cart')}
        },
    },
    created: function(){
        //this.$session.start()
    },
    mounted: function(){
      this.getCartFromSession()
      console.log(this.$store.state.cart)
    }
});
