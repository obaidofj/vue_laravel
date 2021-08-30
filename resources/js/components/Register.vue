<template>
<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="login-form">
          <form action="/examples/actions/confirmation.php" method="post" nonvalidate>
              <h2 class="text-center">Create New Account</h2>
              <div class="form-group">
                  <input type="text" class="form-control" placeholder="first name" v-model="firstname">
                  <div v-show="firstnameError" class="text-danger">
                     ... the firstname is too short
                  </div>
              </div>
               <div class="form-group">
                  <input type="text" class="form-control" placeholder="lastname" v-model="lastname">
                  <div v-show="lastnameError" class="text-danger">
                     ... the lastname is too short
                  </div>
              </div> 
              <div class="form-group">
                  <input type="email" class="form-control" placeholder="email" v-model="email" @blur="checkEmailExist">
                  <div v-show="emailError" class="text-danger">
                     ... the email is not valid
                  </div>
                  <div v-show="isEmailExist" class="text-danger">
                     ... this email is already registred
                  </div>
              </div>
              <div class="form-group">
                  <input type="password" class="form-control" placeholder="Password" v-model="password">
                  <div v-show="passwordError" class="text-danger">
                     ... the password is too short
                  </div>
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-block"
                  :disabled="!isValidForm"
                  @click.prevent="submitRegister"
                  >Create Account</button>
              </div>
              <div v-if="isExists">
                user already exists
              </div>
              <div class="clearfix">
                  <a href="#" class="pull-right">Forgot Password?</a>
              </div>
          </form>
          <p class="text-center">having account ?
             <strong class="switch-tologin-modal" ><a href="#">Login</a></strong>
          </p>
        </div>
      </div>
    </div>
  </div>
 </div>
</template>

<script>
export default {
     data(){
         return {
             firstname : '',
             lastname : '' ,
             password : '',
             email : '',
             isExists:false,
         }
     },
     created(){
         console.log("register created");
     },
     computed:{
         firstnameError(){
             return this.firstname.length > 0 && this.firstname.length < 4
         },
         lastnameError(){
             return this.lastname.length > 0 && this.lastname.length < 4
         },
         emailError(){
           return !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) && this.email.length > 0
         },
         passwordError(){
             return this.password.length > 0 && this.password.length < 7
         },
         isEmailExist(){
            return this.isExists
         },
         isValidForm(){
             return this.firstname.length > 4   && this.lastname.length > 4   && !this.isExists &&
             this.password.length > 5 && (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email))
         },
         name(){
           return this.firstname+' '+this.lastname;
         }
         
     },
     methods:{
       submitRegister(){
           //console.log('submitted');
           //client sid  localstorage sessionstorage indexed db   state managment system
           //vue vuex

           //this.$store.state.userToken = "amine"

           //this.$store.commit('setUserToken',{userToken:'sdmfjsdkfjlsds'})
            //console.log(this.$store.getters.isLogged)
            let  {name,email,password} = this;
            this.$store.dispatch('RegisterUser',{name,email,password}).then(() => {
  // ... 
            
            //console.log("exists2",this.$store.getters.isExists);
            if(this.$store.getters.isExists=='yes'){
              this.isExists=true;
            }
            if(this.$store.getters.isLogged){
            
            $('#register-modal').hide();
            //this.$router.go(this.$router.currentRoute)
            this.getBos();
            }
});
            
            //this.er=this.$store.getters.isRegistred;
            //if(this.eremail[0]=="The email has already been taken.")
            //alert("already");
            //console.log("error",this.er);
            /*console.log(this.$store.state.userToken);
          axios.post('api/register',{"name":name,"email":email,"password":password})
          .then(res=>{console.log("register",res.data)})
          .catch(err=>console.log(err));*/

       },
       async checkEmailExist(){
         //alert("check func");
         this.isExists=false;
         try
         {
          const res= await axios.get('/api/checkEmailExist/'+this.email);
          console.log("awit res",res);
         if(res.data.exist=='yes')
            {
              this.isExists=true;
            }
         
         }catch (err) 
         {
           console.log("check email exist errore",err);
           }
       },
        getBos: function() {
             this.$root.$emit('getBo');
        }
     }
}
</script>

