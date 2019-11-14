<template>
    <div class="container cart-container">
        <img class="cart-product-image" v-bind:src="album.coverartURL">
        <h1>{{album.title}}</h1>
        <h3>{{item.id}}</h3>
        <h3>{{item.price}}</h3>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('CART ITEM MOUNTED')
        },
        name:'cartitem',
        props : ['item'],
        data(){
            return  { 
                album: {},
                // you need to add the csrf in the form above
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                audio: true,
            }
        },
        components: {
        },
        methods: {
            //grabs album from API in Laravel
            //uses binded id from the CART data "item" in Cart view
            //places in view
            getAlbum(id){
                //using Fetch API
                if(id!=null){
                    var URL = 'api/albumcatalogid/'+id
                    fetch(URL)
                        .then(res=>res.json())
                        .then(res=>{
                            this.album = res.data
                        })
                }
            }
        },
        created() {
            this.getAlbum(this.item.id);
        }
    }
</script>