<template>
    <div class="container albumViewContainer">
       
        <audio controls>
            <source src="audio/Wingnut.wav">
        </audio>
        <br>
        <img src="img/currentworks.png" width="400">

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('album view mounted.')
        }
    }
</script>
