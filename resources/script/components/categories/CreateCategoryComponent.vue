<template>
  <div>
    <div class="col-lg-12">
      <div class="panel panel-success" v-for="category in categories" :key="category.id">
          <form @submit.prevent="onDelete(category.id)">
            <button class="btn btn-danger" style="float: right; margin-right: 10px; margin-top: 3px;"><i class="fa fa-trash"></i></button>
          </form>
          <div class="panel-heading">
              {{category.name}}
              

          </div>

          <div class="panel-body" v-text="category.description">

          </div>


      </div>
      <div class="panel panel-success">
          <div class="panel-heading">
              Create Category
          </div>
          <div class="panel-body">
            <form @submit.prevent="onSubmit" 
                  @keydown="form.errors.clear($event.target.name)">
              <div class="form-group">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control" v-model="form.name">
                <span class="help-block bg-danger" 
                v-show="form.errors.has('name')" 
                v-text="form.errors.get('name')">
                </span>
              </div>
              <div class="form-group">
                <label for="description" class="form-label">Category Descriptions</label>
                <input type="text" class="form-control" v-model="form.description">
                <span class="help-block bg-danger" 
                v-show="form.errors.has('description')" 
                v-text="form.errors.get('description')">
                </span>
              </div>
              <div class="form-submit">
                <button type="submit" class="btn btn-success">Create</button>
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
          name: '',
          description : ''
        }),
        categories: []
      }
  },
  created(){
    this.getCategory();
  },
  methods:{
    getCategory() {
          axios.get( '/api/categories/' )
              .then( (response) => this.categories = response.data  )
              .then( (response) => console.log(response) )
              .catch( (error) => console.log(error) );
        },
    onSubmit() {
        this.form.post( '/admin/categories/' )
                .then( response => this.getCategory() );    
    },
    onDelete(category_id) {
        this.form.delete( '/admin/categories/' + category_id )
                .then( response => this.getCategory() );    
    },
  }
}

</script>

