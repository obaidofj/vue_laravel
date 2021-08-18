<template>
<div>
      <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0" v-if="categories.count>0">
                  <li v-for="catg in categories" :key="catg.id">
                    <router-link to="#">{{catg.name}} </router-link>
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
        return { categories:'' }
    },
    created(){
        this.getCategories();
    },
    methods:{
        getCategories(){
            axios.get("api/categories")
            .then(res=>{this.categories=res.data; console.log("categories:",res);})
            .catch(err=>console.log(err));
            
        }
    }
}
</script>
