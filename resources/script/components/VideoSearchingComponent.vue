<template>
    <div class="container">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" v-model="search">
            <div class="input-group-append">
                <button class="btn btn-info"><span class="fa fa-search"></span></button>
            </div>
        </div>
        <span class="text-success" >ရှာဖွေရလဒ်စုစုပေါင်း {{videos.length | myanmarNumber}}</span>

        <div class="post-preview" v-for="video in videos">
          <a :href="videoUrl + video.id">
            <h2 class="post-title"> {{ video.name }} </h2>
            <span class="badge bg-danger text-white" >{{video.recommends_count | myanmarNumber}}</span> recommended </p>
            <span class="badge badge-danger" v-for="categories in video.categories" style="margin-left: 5px"><a href="javascript:void(0)" class="text-white" style="text-decoration: none">
            {{ categories.name }}</a></span>
          </a>
          <br>
            
          <p class="post-meta"></p>
        </div>
    <hr>
    <!-- Pager -->
    </div>
</template>

<script>
import EventBus from './event-bus.js';
var myanmarNumbers = require("myanmar-numbers");

  export default {

    props: {
      myProp: String
    },
    data(){
      return {
        search: '',
        videos: [],
        category_id: '',
        videoUrl: '/videos/',
        jsonUrl: '/api/videos/categories/',
        
      }
    },
    created(){
        this.getJson();
              
        EventBus.$on('setCategoryVideo', (category_id) => {
          this.category_id = category_id;  
          console.log('setCategory Video event caught', this.category_id);
          axios.get('/categories/'+ this.category_id +'/videos')
              .then( (response) => this.videos = response.data  )
              .catch( (error) => console.log(error) );
        });

        EventBus.$on('unsetCategoryVideo', () => {
          console.log('unsetCategory Video event caught');
          axios.get(this.jsonUrl)
              .then( (response) => this.videos = response.data  )
              .catch( (error) => console.log(error) );
        });

    },
    watch: {
        search(after, before) {
            this.getSearchResult();
        }
    },
    filters: {
      myanmarNumber(value) {
        return myanmarNumbers(value, "my");
        console.log(value);
      }
    },
    methods: {
      getJson(){
        axios.get(this.jsonUrl)
          .then( (response) => this.videos = response.data  )
          .then( (response) => EventBus.$emit('allVideoCount', this.videos.length) )
          .catch( (error) => console.log(error) );
      },
      getSearchResult(){
        axios.get('api/search/videos', {params: {name : this.search}})
              .then((response) => this.videos = response.data)
              .catch((error) => console.log(error));
      }

    }
  }
</script>
