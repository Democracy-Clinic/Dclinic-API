<template>
  <div class="container">
    <div class="card">
      <ul class="list-group list-group-flush" >
        <li class="list-group-item">
          <a href="javascript:void(0)" style="text-decoration: none" @click="unsetCategoryIdVideo()">
            နောက်ဆုံးရဗီဒီယိုများ
          </a>
        <span class="badge badge-pill badge-danger">{{this.videos_count | myanmarNumber}}</span>
        </li>
        <li class="list-group-item" v-for="category in this.categories" :key="category.id">
          <a href="javascript:void(0)" style="text-decoration: none" @click="setCategoryIdVideo(category.id)">
          {{category.name}}
          </a>
        <span class="badge badge-pill badge-danger" >{{category.videos_count | myanmarNumber}}</span>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
  import EventBus from './event-bus.js';
  var myanmarNumbers = require("myanmar-numbers");
	export default{
    props: {
      myProp: String
    },
    data(){
      return {
        categories: [],
        videos_count: 0,
      }
    },
    created(){
        axios.get('/api/categories/videos')
              .then( (response) => this.categories = response.data  )
              .then( (response) => console.log(this.categories) )
              .catch( (error) => console.log(error) );

        EventBus.$on('allVideoCount', (videos_count) => {
          console.log(videos_count + ' videos');
          this.videos_count = videos_count;
        });
    },
    filters: {
      myanmarNumber(value) {
        return myanmarNumbers(value, "my");
        console.log(value);
      }
    },
    methods:{
        setCategoryIdVideo(category_id){
            EventBus.$emit('setCategoryVideo', category_id);
        },
        unsetCategoryIdVideo(){
            EventBus.$emit('unsetCategoryVideo');
        }
    }
	}
</script>