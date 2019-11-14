import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

//SHARED STATE VARIABLES:
export const store = new Vuex.Store({
    state: {
      counter: 0,
      cart: [],
      test: 'this is a test of the state'
    },
    mutations: {
    },
  })