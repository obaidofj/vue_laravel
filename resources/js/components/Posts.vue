<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" v-for="post in posts" :key="post.id">
               <img :src="'img/'+post.image" width="100" >
<router-link :to="'/post/'+post.slug">{{post.title}}</router-link>
{{post.body.substr(0,150)}}
posted by : {{post.name}}
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
return { posts: {} }
        },
        mounted() {
            console.log('Component mounted.')
            this.getPosts();
        },
        methods:{
            getPosts(){
                axios.get('api/posts')
                .then(res=>{this.posts=res.data; console.log(res.data)})
                .then(err=>console.log(err));
            }
        }
    }
</script>
