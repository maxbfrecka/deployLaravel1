<template>
    <div class="container albumsContainer">




        <div class="albumsRow row pt-3 pb-5 pl-3 pr-3">
            
           <div class="col-3 p-4" id="albumArtColumn">
               <a href="music/wingnut"><img class="w-100" src='/../img/iwanttobewithher.png'></a>
           </div>   

           <div class="col-6 pt-4" id="albumsInfoColumn"  style="background-color:pink">
               <div id="albumsInfoContainer">
                    <h2><a id="albumTitle" href="music/wingnut">I Want to Be With Her</a></h2>
                    <h3><span>  [DM001]</span> <span>  (2019)</span></h3>
                    <div id="albumsAudioContainer">
                        <vue-audio id="vueAudioThing" :file="audio_iwanttobewithher"/>
                    </div>

                    <br>

                    <div id="albumsBlurb">
                        <p>Full purchase contains 5 page PDF with supplemental material</p>
                    </div>    
               </div>
           </div>


            <div class="priceColumn">
                <div id="priceBox">
                    $2 Dollars
                </div>
                <div id="addToCart">
                   <!-- <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="Z6GWPZGFA93QQ">
                        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    </form> -->
                    <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
                        <input type="hidden" name="cmd" value="_s-xclick">
                        <input type="hidden" name="hosted_button_id" value="Y737MEDEDLYKW">
                        <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                        <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    </form>
                </div>

            </div>

        </div>

        

        <!-- low IQ way of doing it
            remove pt-3 from the lower entries to maintain equal spacing
         -->
        <div class="albumsRow row pb-5 pl-3 pr-3">
           <div class="col-3 p-4" id="albumArtColumn">
               <a href="music/savetheworld"><img class="w-100" src='/../img/savetheworld.jpg'></a>
           </div>   
           <div class="col-6 pt-4" id="albumsInfoColumn">
               <div id="albumsInfoContainer">
                    <h2><a id="albumTitle" href="music/savetheworld">Save the World</a></h2>
                    <h3><span>  [DM002]</span> <span>  (2019)</span></h3>
                    <div id="albumsAudioContainer">
                        <vue-audio id="vueAudioThing" :file="audio_savetheworld"/>
                    </div>

                    <br>

                    <div id="albumsBlurb">
                        <p>The full version has a 3 page PDF with art, lyrics and intellectual rambling</p>
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





        <div class="albumsRow row pb-5 pl-3 pr-3">
           <div class="col-3 p-4" id="albumArtColumn">
               <a href="music/somehow"><img class="w-100" src='/../img/currentworks.png'></a>
           </div>   
           <div class="col-6 pt-4" id="albumsInfoColumn" style="background-color:rgb(120, 238, 120)">
               <div id="albumsInfoContainer">
                    <h2><a id="albumTitle" href="music/guigui">Somehow</a></h2>
                    <h3><span>  [DM003]</span> <span>  (2019)</span></h3>
                    <div id="albumsAudioContainer">
                        <vue-audio id="vueAudioThing" :file="audio_somehow"/>
                    </div>

                    <br>

                    <div id="albumsBlurb">
                        <p>Purchase contains additional materials</p>
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
        },
        data(){
            return  { 
                audio_wingnut: '/../audio/Wingnut.wav',
                audio_iwanttobewithher: '/../audio/iwanttobewithher.mp3',
                audio_somehow: '/../audio/somehow.mp3',
                audio_savetheworld: '/../audio/savetheworld.wav',
                audio_guigui: '/../audio/guigui.mp3',
                audio: true,
            }
        },
        components: {
            'vue-audio': VueAudio
        },
        methods: {
            playAudio(){
            },
        }
    }
</script>