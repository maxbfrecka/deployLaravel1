<template>
    <div class="container albumViewContainer">
        <img src="/../img/currentworks.png" width="400">
        <br>
        <h1>Wingnut</h1>
        <br>
        <vue-audio :file="audiofile1" />
        <br>

    </div>
</template>

<script>
    import VueAudio from 'vue-audio';
    export default {
        mounted() {
            console.log('album view mounted.')
        },
        data(){
            return  { 
                testmessage: 'testdata1',
                audiofile1: '/../audio/Wingnut.wav',
                audio: true,
            }
        },
        components: {
            'vue-audio': VueAudio
        },
        methods: {
            playAudio(){
                console.log('Vue thang test');
            },
        },
    }
</script>
