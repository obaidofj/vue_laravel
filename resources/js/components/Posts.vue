<template>
 <div class="container intro-container">
 <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">
    <div class="container">
        <br><br>
        <div v-if="issearching">searching..</div>
        <div v-if="posts.length==0">No results</div>
        <div class="row justify-content-center" v-else>
            <div class="col-md-8" v-for="post in posts.data" :key="post.id">
               <img :src="'/img/'+post.image" width="100" >
<router-link :to="'/post/'+post.slug">{{post.title}}</router-link>
{{post.body.substr(0,150)}}
posted by : {{post.user.name}} category: {{post.category.name}}
            </div>
        </div>
    </div>
    <pagination :data="laravelData" @pagination-change-page="getPosts"></pagination>
      </div>

        <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Search for..." v-model="postsearch">
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
return { posts: {},
         issearching:false,
         postsearch:'',
          laravelData: {} }
        },
        mounted() {
            //console.log('Component mounted.')
            
            if(this.$route.path=='/category/'+this.$route.params.slug+'/posts')
            this.getPosts2();
            else
            this.getPosts();
        },
        watch:{
          postsearch(query){
            this.issearching=true;
            if(query.length>0)
            {
            //console.log(query);
            
            axios.get('/api/searchposts/'+query+'?page=1' )
            .then( res=>{ //console.log(res.data); 
            this.posts=res.data; this.laravelData = res.data; this.issearching=false;})
            .catch(err=>console.log(err));
            }
            // else if(this.$route.path=='/category/'+this.$route.params.slug+'/posts')
            // this.getPosts2();
            else
            {    
             this.getPosts();
             this.issearching=false;
            } 
            
          }
        },
        methods:{
            getPosts(page=1){
              const userToken=this.$store.getters.getToken;
              console.log(`Bearer ${userToken}`);
            axios.defaults.headers.common.Authorization = `Bearer ${userToken}`
                axios.get('/api/posts?page=' + page)
                .then(res=>{this.posts=res.data; this.laravelData = res.data; //console.log(res.data)
                })
                .then(err=>console.log(err));
            },
            getPosts2(page=1){
              const userToken=localStorage.getItem('userToken');
            axios.defaults.headers.common.Authorization = `Bearer ${userToken}`
                axios.get('/api/category/'+this.$route.params.slug+'/posts?page=' + page)
                .then(res=>{this.posts=res.data; this.laravelData = res.data;//console.log("category posts",res.data)
                           })
                .then(err=>console.log(err));
            }

        }
    }
</script>
