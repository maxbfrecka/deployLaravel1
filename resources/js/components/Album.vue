<template>
    <div class="container albumViewContainer">
        <img v-bind:src="album.coverartURL" width="400">
        <br>
        <h1>{{album.title}}</h1>
        <br>
        <vue-audio :file="album.previewURL" />
        <br>
        <p>{{album.blurb}}</p>
        <br>
        <h3>Price: {{album.price}}</h3>

    </div>
</template>

<script>
    import VueAudio from 'vue-audio';
    export default {
        mounted() {
        },
        data(){
            return  { 
                album: {
                    id: '',
                    title: '',
                    catalogID: '',
                },
                catalogID: this.$route.params.catalogID,
                audio: true,
            }
        },
        components: {
            'vue-audio': VueAudio
        },
        methods: {
            playAudio(){
            },
            getAlbum(){
                //using Fetch API   
                fetch(`../api/albumcatalogid/${this.catalogID}`)
                    .then(res=>res.json())
                    .then(res=>{
                        this.album = res.data
                    })
                }
        },
        created() {
            this.getAlbum();
        }
    }
</script>
