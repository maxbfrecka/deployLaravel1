<template>
    <div class="container">
        <div class="row justify-content-center page-navbar__wrapper">
            <ul class=" page-navbar">
                <li><router-link class="vuelink" id="homeLink" to="/" exact>Big Poppin</router-link></li>
                <!-- <li><router-link class="vuelink" :to="{path: 'albums'}" exact>Albums</router-link></li> -->
                <li><router-link class="vuelink" :to="{ name: 'vue-cart'}" exact>Cart Cart {{cartSize}}</router-link></li>
                <li><router-link class="vuelink" :to="{ name: 'checkout'}" exact>Checkout</router-link></li>
                <li><router-link class="vuelink" :to="{ name: 'stripe-checkout'}" exact>Stripe Checkout</router-link></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
        },
        props : [
        ],
        computed: {
            cartSize: function(){
                return _.size(this.$store.state.cart)
            }
        },
        created(){
        }
    }
</script>
