<template>
 <div class="container intro-container">
 <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
    <div class="container">
        <br><br>
        <div class="row justify-content-center">
            <div class="col-md-8" v-for="post in posts" :key="post.id">
               <img :src="'img/'+post.image" width="100" >
<router-link :to="'/post/'+post.slug">{{post.title}}</router-link>
{{post.body.substr(0,150)}}
posted by : {{post.user.name}} category: {{post.category.name}}
            </div>
        </div>
    </div>
      </div>

        <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>

      <categories></categories>


      </div>
 </div>
 </div>

</template>

<script>
import categories from './Categories.vue' ;

    export default {
  components: { categories },
        data(){
return { posts: {} }
        },
        mounted() {
            console.log('Component mounted.')
            this.getPosts();
        },
        methods:{
            getPosts(){
                axios.get('/api/category/'+this.$route.params.slug+'/posts')
                .then(res=>{this.posts=res.data; console.log("category posts",res.data)})
                .then(err=>console.log(err));
            }
        }
    }
</script>
