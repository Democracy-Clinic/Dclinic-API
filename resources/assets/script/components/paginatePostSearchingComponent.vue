<template>
    <div class="container">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" v-model="search">
            <div class="input-group-append">
                <button class="btn btn-info"><span class="fa fa-search"></span></button>
            </div>
        </div>
        <div class="post-preview" v-for="post in filteredPosts">
          <a :href="postUrl + post.id">
            <h2 class="post-title"> {{ post.title }} </h2>
            <span class="text-success">continue reading</span>
          </a>
          <br>
            <span class="badge badge-danger" v-for="categories in post.categories" style="margin-left: 5px"><a href="javascript:void(0)" class="text-white" style="text-decoration: none">
            {{ categories.name }}</a></span>
            
            
          <p class="post-meta"></p>
        </div>
    <hr>
    <!-- Pager -->
    <div class="clearfix">
      <a class="btn btn-primary float-left" v-if="firstPage !== 1" @click="previousPaginate" > Previous</a>
      <a class="btn btn-primary float-right" v-if="currentPage !== checkLastPage" @click="nextPaginate" >Next</a>
    </div>
    </div>
</template>

<script>
import EventBus from './event-bus.js' 

  export default {

    props: {
      myProp: String
    },
    data(){
      return {
        search: '',
        posts: [],
        category_id: '',
        postUrl: '/posts/',
        categoryUrl: '/categories/',
        paginate: {},
        jsonUrl: '/api/categories/posts',
        firstPage: '',
        currentPage: '',
        total: '',
        perPage: '',
      }
    },
    created(){
        this.getJson();
              
        EventBus.$on('setCategory', (category_id) => {
          this.category_id = category_id;  
          console.log('setCategory event caught', this.category_id);
          axios.get('/categories/'+ this.category_id +'/posts')
              .then( (response) => this.posts = response.data  )
              .catch( (error) => console.log(error) );
        });

        EventBus.$on('unsetCategory', () => {
          console.log('unsetCategory event caught');
          axios.get(this.jsonUrl)
              .then( (response) => this.paginate = response.data  )
              .then( (response) => this.posts = this.paginate.data  )
              .catch( (error) => console.log(error) );
        });

    },
    methods: {
      nextPaginate(){
        this.jsonUrl = this.paginate.next_page_url;
        this.getJson();
        // console.log(this.jsonUrl);
      },
      previousPaginate(){
        this.jsonUrl = this.paginate.prev_page_url;
        this.getJson();
        // console.log(this.jsonUrl);
      },
      getJson(){
        axios.get(this.jsonUrl)
          .then( (response) => this.paginate = response.data  )
          .then( (response) => this.posts = this.paginate.data  )
          .then( (response) => this.firstPage = this.paginate.from  )
          .then( (response) => this.currentPage = this.paginate.current_page  )
          .then( (response) => this.total = this.paginate.total  )
          .then( (response) => this.perPage = this.paginate.per_page  )
          .then( (response) => console.log(this.paginate)  )
          .then( (response) => EventBus.$emit('allPostCount', this.posts.length) )
          .catch( (error) => console.log(error) );
      },
      isFloat(n){
        return Number(n) === n && n % 1 !== 0;
      }
    },
    computed: {
      filteredPosts() {
        return this.posts.filter(item => {
          return item.title.toLowerCase().includes(this.search.toLowerCase())
        })
      },
      checkLastPage(){
        var checkPage = this.total / this.perPage;
        if( this.isFloat (checkPage)){
          return ~~checkPage + 1;
        }
        return checkPage;        
      }
    }
  }
</script>
