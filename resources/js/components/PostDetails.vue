<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8"><div v-if="post.category[name]" align="right">{{post.category[name]}}</div>
              <br><br> <img :src="'/img/'+post.image" width="100" >
<router-link :to="'/post/'+post.slug">{{post.title}}</router-link>
{{post.body}}
posted by : {{post.user}}
   <!-- Comments Form -->
        <div class="card my-4" v-show="isLogged">
          <h5 class="card-header">Leave a Comment:</h5>
          <div class="card-body">
            <form>
              <input type="hidden" name="" v-model="post_id">
              <div class="form-group">
                <textarea class="form-control" rows="3" v-model="body"></textarea>
              </div>
              <button type="submit" class="btn btn-primary" @click.prevent="addComment">Submit</button>
            </form>
          </div>
        </div>
<div v-if="comments.length>0"> {{comments.length}} Comments:</div>
<div v-for="comment in comments" :key="comment.id">
{{comment.body}}
    </div>
            </div>
        </div>
       
    </div>
</template>

<script>
    export default {
        data(){
return { post: '',
post_id:'',
body:'',
comments:[] }
        },
        created() {
           
            this.getPost();
        },
        methods:{
            getPost(){
                axios.get("/api/posts/"+this.$route.params.slug)
                .then(res=>{this.post=res.data; 
                this.post_id=this.post.id;
                this.comments=this.post.comments; //console.log(res)
                })
                .catch(err=>console.log(err));
            },
            addComment(){
                let {body , post_id} =this;
                axios.post('/api/comment/create',{body, post_id})
                .then(res=>{console.log("res create comment",res); this.body="";  this.comments.unshift(res.data); })
                .catch(err=>console.log(err));
            }
        },
        computed:{
            isLogged(){
                return this.$store.getters.isLogged;
            }
        }
    }
</script>
