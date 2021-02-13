<template>
  <div class="container">
    <div class="card">
      <ul class="list-group list-group-flush" >
        <li class="list-group-item">
          <a href="javascript:void(0)" style="text-decoration: none" @click="unsetCategoryIdBook()">
            နောက်ဆုံးရစာအုပ်များ
          </a>
        <span class="badge badge-pill badge-danger">{{this.books_count | myanmarNumber}}</span>
        </li>
        <li class="list-group-item" v-for="category in this.categories" :key="category.id">
          <a href="javascript:void(0)" style="text-decoration: none" @click="setCategoryIdBook(category.id)">
          {{category.name}}
          </a>
        <span class="badge badge-pill badge-danger" >{{category.books_count | myanmarNumber}}</span>
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
        books_count: 0,
      }
    },
    created(){
        axios.get('/api/categories/books')
              .then( (response) => this.categories = response.data  )
              .then( (response) => console.log(this.categories) )
              .catch( (error) => console.log(error) );

        EventBus.$on('allBookCount', (books_count) => {
          console.log(books_count + ' books');
          this.books_count = books_count;
        });
    },
    filters: {
      myanmarNumber(value) {
        return myanmarNumbers(value, "my");
        console.log(value);
      }
    },
    methods:{
        setCategoryIdBook(category_id){
            EventBus.$emit('setCategoryBook', category_id);
        },
        unsetCategoryIdBook(){
            EventBus.$emit('unsetCategoryBook');
        }
    }
	}
</script>