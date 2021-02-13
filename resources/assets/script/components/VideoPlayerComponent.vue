<template>
	<div>
        <p>You can check our youtube channel</p>
        <div class="container">
           <vue-plyr>
              <div class="plyr__video-wrapper plyr__video-embed" id="player">
                <iframe
                  src="https://www.youtube.com/embed/bTqVqk7FSmY?iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1"
                  allowfullscreen allowtransparency allow="autoplay">
                </iframe>
              </div>
            </vue-plyr> 
            
        </div>
	</div>

</template>

<script>
    import 'vue-plyr';
    import 'vue-plyr/dist/vue-plyr.css';
    export default {
        data() {
            return {
                
            }
        },

        mounted() {
        }
    }
</script>
<style scoped>
    #player{
        width: 500px;
        height: auto;
    }
</style>