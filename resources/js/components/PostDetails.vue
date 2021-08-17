<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
               <img :src="'img/'+post.image" width="100" >
<a :href="'/post/'+post.slug">{{post.title}}</a>
{{post.body}}
posted by :detail {{post.name}}
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
