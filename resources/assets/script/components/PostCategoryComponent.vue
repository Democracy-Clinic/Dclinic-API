<template>
  <div class="container">
    <div class="card">
      <ul class="list-group list-group-flush" >
        <li class="list-group-item">
          <a href="javascript:void(0)" style="text-decoration: none" @click="unsetCategoryId()">
            နောက်ဆုံးရပို့စ်များ
          </a>
        <span class="badge badge-pill badge-danger">{{this.posts_count | myanmarNumber}}</span>
        </li>
        <li class="list-group-item" v-for="category in this.categories" :key="category.id">
          <a href="javascript:void(0)" style="text-decoration: none" @click="setCategoryId(category.id)">
          {{category.name}}
          </a>
        <span class="badge badge-pill badge-danger">{{category.posts_count | myanmarNumber}}</span>
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
        posts_count: 0,
      }
    },
    created(){
        axios.get('/api/categories/posts')
              .then( (response) => this.categories = response.data  )
              .then( (response) => console.log(this.categories) )
              .catch( (error) => console.log(error) );

        EventBus.$on('allPostCount', (posts_count) => {
          console.log(posts_count + ' posts');
          this.posts_count = posts_count;
        });
    },
    filters: {
      myanmarNumber(value) {
        return myanmarNumbers(value, "my");
        console.log(value);
      }
    },
    methods:{
        setCategoryId(category_id){
            EventBus.$emit('setCategory', category_id);
        },
        unsetCategoryId(){
            EventBus.$emit('unsetCategory');
        }
    }
	}
</script>