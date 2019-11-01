<template>
    <div class="container albumsContainer">




        <div class="albumsRow row pt-3 pb-3 pl-3 pr-3">
            
           <div class="col-3 p-4" id="albumArtColumn">
               <a href="music/wingnut"><img class="w-100" src='/../img/currentworks.png'></a>
           </div>   

           <div class="col-6 pt-4" id="albumsInfoColumn">
               <div id="albumsInfoContainer">
                    <h2><a id="albumTitle" href="music/wingnut">Wingnut</a></h2>
                    <div id="albumsAudioContainer">
                        <vue-audio id="vueAudioThing" :file="audio_wingnut"/>
                    </div>

                    <br>

                    <div id="albumsBlurb">
                        <p>New electronic drum beat - full version contains additional materials</p>
                    </div>    
               </div>
           </div>


            <div class="priceColumn">
                <div id="priceBox">
                    $2 Dollars
                </div>
                <div id="addToCart">
                    Add to Cart
                </div>
            </div>

        </div>

        

        <!-- low IQ way of doing it
            remove pt-3 from the lower entries to maintain equal spacing
         -->
        <div class="albumsRow row pb-3 pl-3 pr-3">
           <div class="col-3 p-4" id="albumArtColumn">
               <a href="music/guigui"><img class="w-100" src='/../img/bigpoppin.jpg'></a>
           </div>   
           <div class="col-6 pt-4" id="albumsInfoColumn">
               <div id="albumsInfoContainer">
                    <h2><a id="albumTitle" href="music/guigui">Gui-Gui</a></h2>
                    <div id="albumsAudioContainer">
                        <vue-audio id="vueAudioThing" :file="audio_guigui"/>
                    </div>

                    <br>

                    <div id="albumsBlurb">
                        <p>Houndlike body blow from a shoegaze pipe</p>
                    </div>
               </div>
           </div>

           <div class="priceColumn">
                <div id="priceBox">
                    $2 Dollars
                </div>
                <div id="addToCart">
                    Add to Cart
                </div>
            </div>


        </div>





    </div>
</template>

<script>
    import VueAudio from 'vue-audio';
    export default {
        mounted() {
            console.log('albums view mounted.')
        },
        data(){
            return  { 
                audio_wingnut: '/../audio/Wingnut.wav',
                audio_guigui: '/../audio/guigui.mp3',
                cover_wingnut: '/../img/currentworks.png',
                cover_guigui: '/../img/bigpoppin.png',
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
        }
    }
</script>