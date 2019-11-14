<template>
    <div class=" cart-container">


        <h1>store cart test : {{getStoreCart}}</h1>



        <div class="cart-items">
            <div v-for="item in cart" v-bind:key="item.id">
                <cart-item v-bind:item="item"></cart-item>
                <button class="button-small border-red-600 border-solid border-4 hover:bg-pink-400" v-on:click="removeFromCart(item.rowId)">Remove Item?</button>
            </div>
        </div>

        <div class="bg-teal-300" v-if="subtotal">
            <h3>{{subtotal}}</h3>
            <h3>{{tax}}</h3>
            <h3>{{total}}</h3>
        </div>
        <button class="p-3" v-on:click="emptyCart">Empty Cart?</button>

        <router-link class="btn-outline-dark button-primary bg-pink-400" :to="{ name: 'vcheckout', params: { cart: cart }}" exact>Checkout?</router-link>
    </div>
</template>

<script>
    export default {
        name:'vcart',
        props : [],
        data(){
            return  {
                stateTest: null,
                //prices
                tax:'',
                subtotal:'',
                total:'',
                cart: '',
                rowID: null,
                albums: [],
                fields: {},
                // globalCart:globalCart,
                album: {
                    id: '',
                    title: '',
                    catalogID: '',
                },
                catalogID: '',
                // you need to add the csrf in the form above
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                audio: true,
            }
        },
        computed: {
            // a computed getter
            getStore: function(){
                return this.$store.state.counter
            },
            getStoreCart: function(){
                return this.$store.state.cart
            },
            updateCart: function () {
            // `this` points to the vm instance
                this.getCart()
                return this.cart
            },
            updateTotals: function(){
                this.getSessionTest()
                return [this.total, this.tax, this.subtotal]
                
            }
        },
        components: {
        },
        methods: {
            getCart(){
                    //using Fetch API
                fetch('api/cart')
                    .then(res=>res.json())
                    .then(res=>{
                        console.log("getCart res ")
                        console.log(res.data)
                        console.log("store inside cart ")
                        console.log(this.$store.state.cart)
                        this.cart = res.data
                        this.$store.state.cart = res.data
                    })
                    .then(this.updateTotals)
            },
            getSessionTest(){
                fetch('api/session')
                    .then(res=>res.json())
                    .then(res=>{
                        this.total=res.total
                        this.subtotal=res.subtotal
                        this.tax=res.tax
                    })
            },
            getAlbums(){
                //using Fetch API
                fetch('api/albums')
                    .then(res=>res.json())
                    .then(res=>{
                        this.albums = res.data
                    })
            },
            emptyCart(){
                fetch('api/emptycart')
                    .then(res=>res.json())
                    .then(res=>{
                        console.log("getCart res ")
                        console.log(res.data)
                        console.log("store inside cart ")
                        console.log(this.$store.state.cart)
                        this.cart = res.data
                        this.$store.state.cart = res.data
                    })
                    .then(this.updateTotals)
            },
            removeFromCart(rowID){
                this.fields.rowId = rowID
                axios.post('/api/removeitem', this.fields)
                    .then(res=>{
                        console.log("getCart res ")
                        console.log(res.data)
                        console.log("store inside cart ")
                        console.log(this.$store.state.cart)
                        this.cart = res.data
                        this.$store.state.cart = res.data
                    })
                    .then(this.updateTotals)
            },
        },
        created() {
            //debugger
        },
        mounted() {
            this.getCart()
            // this.getSessionTest()
            // this.updateCart
            //debugger
        },
        beforeUpdate(){
            //debugger
        }
    }
</script>