<template>
  <div>
    <div class="col-lg-12">
      
      <div class="panel panel-success" v-for="feedback in feedbacks" :key="feedback.id">
          <div class="panel-heading" v-text="feedback.title"></div>

          <div class="panel-body">
            <span class="badge" v-if="feedback.is_solved">Is Solved</span>
            <p v-text="feedback.body"></p>
            <span class="text-info" v-text="feedback.response"></span>
            
            <form @submit.prevent="onSubmit(feedback.id)" 
                  @keydown="form.errors.clear($event.target.name)" v-if="!feedback.is_solved">
              
              <div class="form-group">
                <label for="response" class="form-label">response</label>
                <input type="text" class="form-control" @input="updateResponse($event.target.value)">
                <span class="help-block bg-danger" 
                v-show="form.errors.has('response')" 
                v-text="form.errors.get('response')">
                </span>
              </div>
              <div class="form-submit">
                <button type="submit" class="btn btn-success">Response</button>
              </div>
            </form>
          </div>
      </div>

  </div> 
  </div>
</template>

<script>

export default {
  data(){
      return {
        form: new Form({
          response : ''
        }),
        feedbacks: []
      }
  },
  created(){
    this.getFeedback();
  },
  methods:{
    getFeedback() {
          axios.get( '/api/feedbacks/' )
              .then( (response) => this.feedbacks = response.data  )
              .then( (response) => console.log(this.feedbacks) )
              .catch( (error) => console.log(error) );
        },
    onSubmit(feedback_id) {
        this.form.put( '/admin/feedbacks/'+ feedback_id )
                .then( response => this.getFeedback() );
        event.target.reset();
    },
    updateResponse(response){
      this.form.response = response;
    },
  }
}

</script>

