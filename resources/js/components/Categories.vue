<template>
<div>
      <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0" v-show="categories.length>0">
                  <li v-for="catg in categories" :key="catg.id">
                    <router-link :to="'/category/'+catg.slug+'/posts'">{{catg.name}} </router-link>
                  </li>
               
                </ul>
              </div>
            
            </div>
          </div>
        </div>
</div>
</template>

<script>


export default {
    setup() {
        
    },
    data(){
        return { categories:{},
                 isLogged:false }
    },
    created(){
        this.getCategories();
    },
    computed:{
      isLoged(){
            if(this.$store.getters.isLogged)
             {
             
            this.getCategories();
            this.isLogged=true;
             }
             return this.$store.getters.isLogged;
          }
    },
    methods:{
        getCategories(){
         
            axios.get("http://127.0.0.1:8000/api/categories")
            .then(res=>{this.categories=res.data; //console.log("categories:",res.data);
            })
            .catch(err=>console.log(err));
            
        }
    }
}
</script>
