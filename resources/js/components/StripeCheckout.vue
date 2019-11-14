<template>
    <div class="container cart-container">
        <h1>Checkout</h1>
        <div class="checkout-items" v-if="cartSize>0">
            <div v-for="item in getStoreCart" v-bind:key="item.id">
                <cart-item v-bind:item="item"></cart-item>
            </div>
        </div>

        <div class="bg-teal-300" >
            <h3>{{getSubtotal}}</h3>
            <h3>{{getTax}}</h3>
            <h3>{{getTotal}}</h3>
        </div>

    
        

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
            getSessionTest: function(){
                console.log('get session test:')
                console.log(this.$session.getAll())
                return this.$session.getAll()
            },
            getStoreCart: function(){
                return this.$store.state.cart
            },
            cartSize: function(){
                return _.size(this.$store.state.cart)
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
        },
        components: {
        },
        methods: {
            removeItem(item){
                //this uses underscore.js which i installed with npm install underscore
                //it simplifies complicated management of arrays, etc
                var newCart = _.without(this.$store.state.cart, item)
                this.$store.state.cart = newCart
            },
            emptyCart(){
                //this uses underscore.js which i installed with npm install underscore
                //it simplifies complicated management of arrays, etc
                this.$store.state.cart = []
            }
        },
        created() {
        },
        mounted() {
            this.getSessionTest
        },
        beforeUpdate(){
        }
    }
</script>