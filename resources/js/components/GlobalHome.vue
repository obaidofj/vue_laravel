<template>
<div>    
    <br>
    <div v-show="isLogged"> welcome : {{userName.name}}</div>
<router-view :key="$route.path"></router-view>
</div>
</template>

<script>
    export default {
      data(){
          return {
              name:''
          }
      },
      computed:{
          isLogged(){
                        
              return this.$store.getters.isLogged;
          },
          userName(){
              return this.$store.getters.getUser;
          }
      },
      
    }
</script>
