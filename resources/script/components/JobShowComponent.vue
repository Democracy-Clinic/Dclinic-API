<template>

  <div>
    <br>

      <h2 v-text="job.title"></h2>
      <h4 class="text-success" v-text="job.author"></h4>
      <span class="badge bg-info" v-for="category in job.categories" :key="category.id + '-label'" v-text="category.name" style="margin-left: 10px"></span>
      <p> <span class="badge bg-danger text-white" >{{job.recommends_count | myanmarNumber}}</span> recommended </p>
          <form @submit.prevent="onSubmitRecommend" v-if="isUserLogin">
            <input type="hidden" v-model="formRecommend.recommendable_id = this.job_id">
            <input type="hidden" v-model="formRecommend.user_id = this.user.id">
            <input type="hidden" v-model="formRecommend.recommendable_type = 'ElectricalBlog\\Job'">
            <input type="hidden" v-model="formRecommend.recommendable">
            <button type="submit" @click="recommendOption" :class="recommendSign" v-text="recommendText"></button>
          </form>

      <br>
      <br>
      <div v-html="job.body"></div>
</div>
</template>

<script>
var myanmarNumbers = require("myanmar-numbers");
  export default {
    data(){
        return {
          formRecommend: new Form({
            recommendable_type: 'ElectricalBlog\\Job',
            recommendable_id: '',
            user_id: '',
            recommendable: false
          }),
          job: [],
          user: [],
          job_id: window.location.href.split('jobs/').pop(),
          recommendSign: 'btn btn-secondary',
          recommendText: 'Recommend',
          currentUser: false
        }
    },
    mounted(){
        this.getJob();
    },
    filters: {
      myanmarNumber(value) {
        return myanmarNumbers(value, "my");
        console.log(value);
      }
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
    methods: {
        getJob() {
          axios.get( '/api/jobs/' + this.job_id  )
              .then( (response) => {
                this.job = response.data;
                axios.get( '/api/isCurrentUsers/' )
                    .then( (response) => this.user = response.data  )
                    .then( (response) => this.isCurrentUser(this.job.recommends, this.user))
                    .catch( (error) => console.log(error) );
              })
              .catch( (error) => console.log(error) );
        },
        onSubmitRecommend(){
            this.formRecommend.post('/admin/recommends')
                    .then( response => this.getJob());
        },
        isCurrentUser(recommends , user){
          if(recommends.length > 0){
            for(var i=0; i<recommends.length; i++){
              console.log(user);
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
</style>