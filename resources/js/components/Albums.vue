<template>
    <div class="container albumsContainer">
        <div class="card card-body" v-for="album in albums" v-bind:key="album.id">
            <div class="well">
                <router-link :to="{ name: 'AlbumVue', params: { catalogID: album.catalogID }}">{{album.title}}</router-link>
                <h2>{{album.title}}</h2>
                <img v-bind:src="album.coverartURL" height="300px">
                <h3> PRICE : {{album.price}}</h3>
                <audio controls>
                    <source v-bind:src="album.previewURL">    
                </audio>
                <p>DESCRIPTION: {{album.blurb}}</p>


                <form @submit.prevent="addToVueCart(album)">
                    <input type="hidden" name="_token" :value="csrf">
                    <input type="hidden" v-model="id">
                    <input type="hidden" v-model="name">
                    <input type="hidden" v-model="price">
                    <button type="submit" class="btn btn-primary hover:bg-purple-500 border-orange-500 border-8">Add to Cart</button>
                </form> -->
















<!-- UNCOMMENT THIS IF VUE CART FAILS!!!!!!
                <a href="/cart">go to cart</a>
                <form @submit.prevent="addToCart(album)">

                    <input type="hidden" name="_token" :value="csrf">

                    <input type="hidden" v-model="id">
                    <input type="hidden" v-model="name">
                    <input type="hidden" v-model="price">
                    <button type="submit" class="btn btn-primary hover:bg-purple-500 border-orange-500 border-8">Add to Cart</button>
                </form> -->
                


        <!-- <form action="{{route('cart.store')}}" method="POST">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{$album->catalogID}}">
            <input type="hidden" name="name" value="{{$album->title}}">
            <input type="hidden" name="price" value="{{$album->price}}">
            <button type="submit" class="button button-plain">Add to Cart</button>
        </form> -->
            </div>
        </div>


    </div>
</template>

<script>
    import VueAudio from 'vue-audio';
    export default {
        mounted() {
        },
        data(){
            return  { 
                id:'',
                name:'',
                price:null,
                fields: {},
                errors: {},
                albums: [],
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
        components: {
            'vue-audio': VueAudio,
        },
        methods: {
            //new function for cart purely in Vue
            addToVueCart(album){
                var item = {
                    'id':album.catalogID,
                    'price':album.price,
                    'name':album.title,
                }
                this.$store.state.cart.push(item)
                this.$session.set('cart',this.$store.state.cart)

                this.$router.push('/vuecart')
            },
            playAudio(){
            },

            getAlbums(){
                //using Fetch API
                fetch('api/albums')
                    .then(res=>res.json())
                    .then(res=>{
                        this.albums = res.data
                    })
            },
            //I really need to fix this so that it returns proper messages such as "already in cart"
            //and "succes" with correct references
            addToCart(album){
                this.errors = {};
                this.fields.id = album.catalogID;
                this.fields.price = album.price;
                this.fields.name = album.title;
                axios.post('/api/cart', this.fields).then(response => {
                    //!!!!! STORE NEW CART IN STATE !!!!!!!!!!!
                    //!!! I know this is a shit tier design pattern.!!!
                    this.$store.state.cart = response.data.cart
                //this is how to reroute in a method
                },
                this.$router.push('vcart'),
                // this.$forceUpdate()
                ).catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            }
        },
        created() {
            this.getAlbums();
        }
    }
</script>