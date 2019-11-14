<template>
    <div class="container cart-container">
        <h1>Vue-Cart</h1>
        <div class="cart-items" v-if="cartSize>0">
            <div v-for="item in getStoreCart" v-bind:key="item.id">
                <cart-item v-bind:item="item"></cart-item>
                <button class="button-small border-red-600 border-solid border-4 hover:bg-pink-400" v-on:click="removeItem(item)">Remove Item?</button>
            </div>
        </div>

        <div class="bg-teal-300" >
            <h3>{{getSubtotal}}</h3>
            <h3>{{getTax}}</h3>
            <h3>{{getTotal}}</h3>
        </div>

        <div class="cart-options" v-if="cartSize>0">
            <button class="p-3" v-on:click="emptyCart">Empty Cart?</button>
            <router-link class="btn-outline-dark button-primary bg-pink-400" :to="{ name: 'checkout'}" exact>Checkout?</router-link>
        </div>
        <div class="cart-options" v-if="cartSize==0">
            <p>Nothing in cart!</p>
        </div>

        <button @click="deleteSession">deletesession</button>

    </div>
</template>

<script>
    export default {
        name:'vue-cart',
        props : [],
        data(){
            return  {
                taxRate:.10,
                // you need to add the csrf in the form above
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        computed: {
            getStoreCart: function(){
                return this.$store.state.cart
                // return this.$store.state.cart
            },
            cartSize: function(){
                return _.size(this.$store.state.cart)
                //return _.size(this.$store.state.cart)
            },
            getSubtotal: function(){
                var subtotal =0
                this.$store.state.cart.forEach(item =>{
                    subtotal+=item.price
                })
                return subtotal
            },
            getTax: function(){
                var totalTax =0
                this.$store.state.cart.forEach(item =>{
                    totalTax += item.price*this.taxRate
                })
                return totalTax
            },
            getTotal: function(){
                return this.getTax+this.getSubtotal
            }
            // getTax: function(){
            //     var totalTax =0
            //     for(item in this.$store.state.cart){
            //         var tax = item.price*this.taxRate
            //         totalTax+=tax
            //     }
            //     return totalTax
            // },
            // getTotal: function(){
            //     return this.getTax + this.getSubtotal
            // }
        },
        components: {
        },
        methods: {
            deleteSession(){
                this.$session.destroy()
            },
            removeItem(item){
                //this uses underscore.js which i installed with npm install underscore
                //it simplifies complicated management of arrays, etc
                var newCart = _.without(this.$store.state.cart, item)
                this.$store.state.cart = newCart
                this.$session.set('cart', this.$store.state.cart)
            },
            emptyCart(){
                //this uses underscore.js which i installed with npm install underscore
                //it simplifies complicated management of arrays, etc
                this.$store.state.cart = []
                this.$session.clear()
            }
        },
        created() {
        },
        mounted() {
        },
        beforeUpdate(){
        }
    }
</script>