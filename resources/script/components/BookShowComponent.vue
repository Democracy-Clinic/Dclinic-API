<template>

  <div>
    <br>
      <div class="row">
        <div class="col-lg-12">
          <img :src="book.book_image" >
        </div>
      </div>
      <div class="row">
        
        <div class="col-lg-12">
          <h2 v-text="book.book_name"></h2>
          <h4 class="text-success" v-text="book.author"></h4>
          <span class="badge bg-info" v-for="category in book.categories" :key="category.id + '-label'" v-text="category.name" style="margin-left: 10px"></span>
          <p> 
            <span class="badge bg-danger text-white">{{book.recommends_count | myanmarNumber}}</span> recommended </p>
          <form @submit.prevent="onSubmitRecommend" v-if="isUserLogin">
            <input type="hidden" v-model="formRecommend.recommendable_id = this.book_id">
            <input type="hidden" v-model="formRecommend.user_id = this.user.id">
            <input type="hidden" v-model="formRecommend.recommendable_type = 'ElectricalBlog\\Book'">
            <input type="hidden" v-model="formRecommend.recommendable">
            <button type="submit" @click="recommendOption" :class="recommendSign" v-text="recommendText"></button>
          </form>

          <small v-if="!isUserLogin"><a href="/login" class="text-info">Sign in</a> to recommend. Not Yet Register ? <a href="/register" class="text-info">Register Here</a></small> 
        </div>
      </div>
      
      <br>
      <br>
      <div v-html="book.review"></div>
      <br>
      <a :href="book.book_link" class="btn btn-success text-white" >Download The Book</a>
      <p class="text-info">Credit to the book author <span class="text-primary">{{book.author}}</span></p>
</div>
</template>

<script>
  var myanmarNumbers = require("myanmar-numbers");
  // console.log(myanmarNumbers);
  export default {
    data(){
        return {
          formRecommend: new Form({
            recommendable_type: 'ElectricalBlog\\Book',
            recommendable_id: '',
            user_id: '',
            recommendable: false
          }),
          book: [],
          user: [],
          currentUser: false,
          book_id: window.location.href.split('books/').pop(),
          displayNone: true,
          display: false,
          recommendSign: 'btn btn-secondary',
          recommendText: 'Recommend',

        }
    },
    mounted(){
        this.getBook();
    },
    computed: {
        isUserLogin(){
          if(this.user == ''){
            return false;
          }else{
            return true;
          }
          
        }
    },
    filters: {
      myanmarNumber(value) {
        return myanmarNumbers(value, "my");
        console.log(value);
      }
    },
    methods: {
        getBook() {
          axios.get( '/api/books/' + this.book_id  )
              .then( (response) => {
                this.book = response.data;
                axios.get( '/api/isCurrentUsers/' )
                    .then( (response) => this.user = response.data  )
                    .then( (response) => this.isCurrentUser(this.book.recommends, this.user))
                    .then( (response) => console.log(this.currentUser))
                    .catch( (error) => console.log(error) );
              })
              .then( (response) => console.log(this.book) )
              .catch( (error) => console.log(error) );
        },
      
        onSubmitRecommend(){
            this.formRecommend.post('/admin/recommends')
                    .then( response => this.getBook());
        },
        
        isCurrentUser(recommends , user){
          if(recommends.length > 0){
            for(var i=0; i<recommends.length; i++){
              // console.log(recommends);
              // console.log(user.id == recommends[i].user_id);
              if( user.id == recommends[i].user_id){
                this.recommendText = 'Recommended';
                this.recommendSign = 'btn btn-success';
                this.formRecommend.recommendable = true;
              }
            }
          }else{
            this.recommendText = 'Recommend';
            this.recommendSign = 'btn btn-secondary';
            this.formRecommend.recommendable = false;
          }
        },
        recommendOption() {

          if(this.recommendSign == 'btn btn-secondary'){
            this.recommendSign = 'btn btn-success';
            this.recommendText = 'Recommended';
            this.formRecommend.recommendable = true;
          }else{
            this.recommendSign = 'btn btn-secondary';
            this.recommendText = 'Recommend';
            this.formRecommend.recommendable = false;
          }
        },
        
    }

  }
</script>

<style scoped>
  .boxShadow{
    padding: 15px;
    box-shadow: 0px 0px 20px -5px grey;
  }
</style>