<template>
  <div class="container">
    <div class="card">
      <ul class="list-group list-group-flush" >
        <li class="list-group-item">
          <a href="javascript:void(0)" style="text-decoration: none" @click="unsetCategoryIdJob()">
            နောက်ဆုံးရအလုပ်အကိုင်များ
          </a>
        <span class="badge badge-pill badge-danger">{{this.jobs_count | myanmarNumber}}</span>
        </li>
        <li class="list-group-item" v-for="category in this.categories" :key="category.id">
          <a href="javascript:void(0)" style="text-decoration: none" @click="setCategoryIdJob(category.id)">
          {{category.name}}
          </a>
        <span class="badge badge-pill badge-danger" >{{category.jobs_count | myanmarNumber}}</span>
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
        jobs_count: 0,
      }
    },
    created(){
        axios.get('/api/categories/jobs')
              .then( (response) => this.categories = response.data  )
              .then( (response) => console.log(this.categories) )
              .catch( (error) => console.log(error) );

        EventBus.$on('allJobCount', (jobs_count) => {
          console.log(jobs_count + ' jobs');
          this.jobs_count = jobs_count;
        });
    },
    filters: {
      myanmarNumber(value) {
        return myanmarNumbers(value, "my");
        console.log(value);
      }
    },
    methods:{
        setCategoryIdJob(category_id){
            EventBus.$emit('setCategoryJob', category_id);
        },
        unsetCategoryIdJob(){
            EventBus.$emit('unsetCategoryJob');
        }
    }
	}
</script>