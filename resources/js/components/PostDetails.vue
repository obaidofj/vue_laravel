<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8"><div v-if="post.category[name]" align="right">{{post.category[name]}}</div>
               <img :src="'img/'+post.image" width="100" >
<a :href="'/post/'+post.slug">{{post.title}}</a>
{{post.body}}
posted by : {{post.user.name}}
<div v-if="post.comments_count>0"> {{post.comments_count}} Comments:</div>
<div v-for="comment in post.comments" :key="comment.id">
{{comment.body}}
    </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
return { post: '' }
        },
        created() {
           
            this.getPost();
        },
        methods:{
            getPost(){
                axios.get("/api/posts/"+this.$route.params.slug)
                .then(res=>{this.post=res.data; console.log(res)})
                .catch(err=>console.log(err));
            }
        }
    }
</script>
