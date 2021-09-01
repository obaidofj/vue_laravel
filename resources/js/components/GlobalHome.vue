<template>
<div>   
    
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Obaid</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <router-link class="nav-link" to="/">Home
              <span class="sr-only">(current)</span>
            </router-link>
          </li>
        
           <li class="nav-item active">
            <router-link class="nav-link" to="/admin">Admin
              <span class="sr-only">(current)</span>
            </router-link>
          </li>
        
          <li class="nav-item register-btn reg-login-btn" data-toggle="modal" data-target="#register-modal">
            <a class="btn btn-info nav-link" href="" data-toggle="modal" data-target="#register-modal">Register</a>
          </li>
          <li class="nav-item reg-login-btn"  data-toggle="modal" data-target="#login-modal">
            <a class="btn btn-primary text-weight nav-link"  data-toggle="modal" href="#" data-target="#login-modal">login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
 
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
