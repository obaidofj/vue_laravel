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
      created(){
        this.updateToken();
      },
      computed:{
          isLogged(){
                        
              return this.$store.getters.isLogged;
          },
          userName(){
              return this.$store.getters.getUser;
          }
      },
      methods:{
          updateToken(){
              const token=JSON.parse(localStorage.getItem('userToken'));
              const user=JSON.parse(localStorage.getItem('userName'));
              this.$store.commit('setUserToken',token);
              this.$store.commit('setUser',user);
          }
      }
      
    }
</script>
