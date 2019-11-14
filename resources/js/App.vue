<template>
  <div>
    <navbar-component v-bind:cart="cart"></navbar-component>
    
    <router-view></router-view>
    
  </div>
</template>

<script>
export default {
  data () {
    return {
    
    }
  },
  props : ['cart'],
  methods:{
    setCart(){
    }
  },
  //YOU MUST DEFINE ALL STATE VARIABLES AT CREATED!
  created: function() {
  }
}
</script>

<style>
</style>
