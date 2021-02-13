<template>
  <div>
      <h2 class="section-heading">{{ post.title }}</h2>
      
      
      <span class="badge bg-info" v-for="category in post.categories" :key="category.id + '-label'" v-text="category.name" style="margin-left: 10px"></span>
      <br>
      <br>
      <span class="badge bg-danger text-white" >{{post.recommends_count | myanmarNumber}}</span> recommended </p>

      <form @submit.prevent="onSubmitRecommend" v-if="isUserLogin">
        <input type="hidden" v-model="formRecommend.recommendable_id = this.post_id">
        <input type="hidden" v-model="formRecommend.recommendable_type = 'ElectricalBlog\\Post'">
        <input type="hidden" v-model="formRecommend.user_id = this.user.id">
        <input type="hidden" v-model="formRecommend.recommendable">
        <button type="submit" @click="recommendOption" :class="recommendSign" v-text="recommendText"></button>
      </form>
      <small v-if="!isUserLogin"><a href="/login" class="text-info">Sign in</a> to recommend. Not Yet Register ? <a href="/register" class="text-info">Register Here</a></small>
      <br>
      <br>
      <div v-html="post.body"></div>

      <br>
      <hr>
      <br>
      <h2 class="text-secondary">Questions</h2>
      <div class="card border mb-5 boxShadow" v-for="issue in post.issues" :key="issue.id">
        <div class="card-body">
          <div class="post-heading">
            
            <div class="pull-left meta ml-3">
                <div class="title h5">
                    <a href="#"><b>Ryan Haywood</b></a>
                    made a question.     
                </div>
                <h6 class="text-muted time">1 minute ago</h6>
                <h6 :class="{displayNone: display}">{{ issue.title }}</h6>
                <h6 :class="{displayNone: display}">{{ issue.body }}</h6>
            </div>
            <form @submit.prevent="onDeleteIssue(issue.id)">
              <button type="submit" class="btn small-button" style="float: right; font-size:20px">
                <i class="fa fa-trash-o text-danger" ></i>
              </button>
            </form>
          </div>
            
          
          
        </div>
        <div class="card-body ml-5" style="border-top: 1px solid #e3e3e3" v-for="reply in issue.reply" :key="reply.id">
          <div class="post-heading">
            <div class="pull-left meta ml-3">
                <div class="title h5">
                    <a href="#"><b>Ryan Haywood</b></a>
                    made a Reply.     
                </div>
                <h6 class="text-muted time">1 minute ago</h6>
                <h6 :class="{displayNone: display}">{{ reply.body }}</h6>
            </div>
            <form @submit.prevent="onDeleteReply(issue.id, reply.id)">
              <button type="submit" class="btn small-button" style="float: right; font-size:20px">
                <i class="fa fa-trash-o text-danger" ></i>
              </button>
            </form>
          </div> 
        </div>
        <div class="card-body"  style="border-top: 1px solid #e3e3e3" v-if="isUserLogin">
          <form @submit.prevent="onSubmitReply" 
            @keydown="formReply.errors.clear($event.target.name)">
            <div class="form-body">
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="text" class="form-control" name="body" @input="updateFormReply($event.target.value)">
                        <span class="help-block text-danger" 
                        v-show="formReply.errors.has('body')" 
                        v-text="formReply.errors.get('body')">
                        </span>
                    </div>
                </div>
                <input type="hidden" name="issue_id" v-model="formReply.issue_id">
                <button type="submit" class="ml-3 btn btn-success" @click="formReply.issue_id = issue.id"> Reply</button>
            </div>
          </form>
        </div>
        <br>
      </div>

      <br>
      <small v-if="!isUserLogin"><a href="/login" class="text-info">Sign in</a> to ask. Not Yet Register ? <a href="/register" class="text-info">Register Here</a></small>
      <div class="card boxShadow" v-if="isUserLogin">
        <div class="card-body">
          <div class="container">
            <form @submit.prevent="onSubmit" 
            @keydown="form.errors.clear($event.target.name)">
               
              <div class="form-group row">
                <h2 class="text-secondary">Do You Have Any Question ?</h2>
              </div>
              <div class="form-group row">
                <label for="title">Question Title</label>
                  <input type="text" class="form-control" v-model="form.title" name="title">
                  <span class="help-block text-danger" 
                  v-show="form.errors.has('title')" 
                  v-text="form.errors.get('title')">
                  </span>
              </div>
              <div class="form-group row">
                <label for="body">Question</label>
                  <textarea type="text" class="form-control" rows="5" name="body" v-model="form.body"></textarea>
                  <span class="help-block text-danger" 
                  v-show="form.errors.has('body')" 
                  v-text="form.errors.get('body')">
                  </span>
              </div>
              <div class="form-group row">
                <button class="btn btn-success" 
                :disabled="form.errors.any()">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
</div>
</template>

<script>
  var myanmarNumbers = require("myanmar-numbers");

  export default {
    props: ['post_id'],
    data(){

        return {
          form: new Form({
            title: '',
            body : '',
            recommend: ''
          }),
          formReply: new Form({
            body: '',
            issue_id: ''
          }),
          formRecommend: new Form({
            recommendable_id: '',
            recommendable_type: 'ElectricalBlog\\Post',
            user_id: '',
            recommendable: false
          }),
          post: [],
          user: [],
          currentUser: false,
          displayNone: true,
          display: false,
          recommendSign: 'btn btn-secondary',
          recommendText: 'Recommend',

        }
    },
    mounted(){
        this.getIssue();
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
        getIssue() {
          axios.get( '/api/posts/' + this.post_id + '/issues/replies' )
              .then( (response) => {
                this.post = response.data
                axios.get( '/api/isCurrentUsers/' )
                    .then( (response) => this.user = response.data  )
                    .then( (response) => this.isCurrentUser(this.post.recommends, this.user))
                    .catch( (error) => console.log(error) );
              })
              .catch( (error) => console.log(error) );
        },
        
        updateFormReply(reply){
          this.formReply.body = reply;
        },

        onSubmit() {
            this.form.post( '/admin/posts/' + this.post_id + '/issues' )
                    .then( response => this.getIssue() );    
        },
        onSubmitReply(event){
            this.formReply.post('/admin/replies')
                    .then( response => this.getIssue());
            event.target.reset();
        },
        onSubmitRecommend(){
            this.formRecommend.post('/admin/recommends')
                    .then( response => this.getIssue());
        },
        onDeleteIssue(issue_id){
            axios.delete('/posts/' + this.post_id + '/issues/' + issue_id)
                .then( response => this.getIssue());
        },
        onDeleteReply(issue_id, reply_id){
            axios.delete('/posts/' + this.post_id + '/issues/' + issue_id + '/replies/' + reply_id)
                .then( response => this.getIssue());
        },
        
        isCurrentUser(recommends , user){
          if(recommends.length > 0){
            for(var i=0; i<recommends.length; i++){
              console.log(user.id === recommends[i].user_id);
              if( user.id === recommends[i].user_id){
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
  .small-button{
    padding: 5px 8px 5px 8px;
    background: white
  }
  a{
    text-decoration: none;
  }
</style>