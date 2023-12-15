<template>
  <div class="login-container">
    <v-card class="elevation-12" width="940px">
      <v-window v-model="step">
        <div class="sign-up">
          <v-window-item :value="1">
            <v-row>
              <v-col cols="12" md="8">
                <v-card-text class="mt-9 pt-16">
                  <h1 class="text-center">Sign in to Barqun SCM</h1>
                  <v-form class="pt-10" autocomplete="off">
                    <v-text-field
                      v-model="email"
                      id="email"
                      label="email"
                      name="Email"
                      prepend-icon="mdi-email-outline"
                      type="text"
                      color="#0284D0"
                    />

                    <v-text-field
                      v-model="password"
                      :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                      id="password"
                      label="Password"
                      name="password"
                      prepend-icon="mdi-lock-outline"
                      :type="show1 ? 'text' : 'password'"
                      color="#0284D0"
                      @click:append="show1 = !show1"
                    />
                  </v-form>
                  <!-- <div class="text-center">
                        <v-btn rounded color="#0284D0" class=" mt-4" dark>Forgot your password ?</v-btn>
                        </div> -->
                </v-card-text>
                <div class="text-center mt-3">
                  <v-btn rounded color="#0284D0" dark @click="loginAction()"
                    >SIGN IN</v-btn
                  >
                </div>
              </v-col>
              <div class="ocean">
                <v-card-text class="white--text text-center mt-16 pt-13 px-2">
                  <v-img
                    class="mt-12"
                    width="270px"
                    src="../public/image 2.png"
                  />
                  <br />
                  <h5 class="text-center">
                    Enter your personal details and start journay with us
                  </h5>
                </v-card-text>
                <div class="text-center">
                  <v-btn rounded outlined dark @click="step++">SIGN UP</v-btn>
                </div>
              </div>
            </v-row>
          </v-window-item>
        </div>
        <v-window-item :value="2">
          <v-row>
            <v-col cols="12" md="4" class="py-0 px-2">
              <div class="ocean2">
                <v-card-text class="white--text">
                  <v-img
                    class="mt-12"
                    width="250px"
                    src="../public/image 2.png"
                  />
                  <br />
                  <h5 class="text-center">
                    To Keep connected with us please login with your personnel
                    info
                  </h5>
                </v-card-text>
                <div class="text-center">
                  <v-btn rounded outlined dark @click="step--">Sign in</v-btn>
                </div>
              </div>
            </v-col>

                    <v-col cols="12" md="8">
                      <v-card-text class="mt-6">
                        <h1 class="text-center display-2 blue--text">Create Account</h1>
                        <h4 class="text-center mt-4">Ensure your email for registration</h4>
                        <v-form autocomplete="off">
                          <v-text-field
                            v-model=isi.namargstr
                            label="Name"
                            name="Name"
                            prepend-icon="mdi-account-outline"
                            type="text"
                            color="#0284D0"
                          />
                          <v-text-field
                            v-model=isi.emailrgstr
                            label="Email"
                            name="Email"
                            prepend-icon="mdi-email-outline"
                            type="text"
                            color="#0284D0"
                          />

                          <v-text-field
                            v-model=isi.passwordrgstr
                            id="password"
                            :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                            label="Password"
                            name="password"
                            prepend-icon="mdi-lock-outline"
                            :type="show2 ? 'text' : 'password'"
                            color="#0284D0"
                            @click:append="show2 = !show2"
                          />
                        </v-form>
                      </v-card-text>
                      <div class="text-center mt-n5">
                        <v-btn rounded color="#0284D0" dark @click="registerAction()">SIGN UP</v-btn>
                      </div>
                    </v-col>
                  </v-row>
                </v-window-item>
              </v-window>
            </v-card>

            <v-snackbar
           v-model="snackbar1"
           absolute
          top
          color="success"
          outlined
          right
          timeout= 1500
           >
            The Data Successfully Add
          </v-snackbar>
          <v-snackbar
           v-model="snackbar2"
            absolute
          top
          color="error"
          outlined
          right
          timeout = 1500
           >
            The Data Successfully Delete
          </v-snackbar>
          <v-snackbar
           v-model="snackbar3"
            absolute
          top
          color="error"
          outlined
          right
          timeout = 1500
           >
            fill the field first
          </v-snackbar>
    </div>
</template>

<script>
import axios from "axios";
export default {
  data: () => ({
    step: 1,
    email: "",
    password: "",

        isi: {
          namargstr: '',
          emailrgstr: '',
          passwordrgstr: '',
        },

        kosong: {
          namargstr: '',
          emailrgstr: '',
          passwordrgstr: '',
        },

    snackbar1: false,
    snackbar2: false,
    snackbar3: false,

    show1: false,
    show2: false,
  }),

  created() {
    if (
      localStorage.getItem("token") != "" &&
      localStorage.getItem("token") != null
    ) {
      this.$router.push("/home");
    }
  },

  methods: {
     loginAction(){
        this.isSubmitting = true
        let payload = {
            email: this.email,
            password: this.password,
        }
        axios.post('http://127.0.0.1:8081/api/login', payload)
          .then(response => {
            localStorage.setItem("name", response.data.user.name);
            localStorage.setItem("email", response.data.user.email);
            localStorage.setItem("password", response.data.user.password);
            localStorage.setItem('token', response.data.token)
            this.$router.push('/home')
            console.log(response.data)
          })
          .catch(error => {
            this.isSubmitting = false
           if (error.response.data.errors != undefined) {
                this.validationErrors = error.response.data.errors
            }
            if (error.response.data.error != undefined) { 
                this.validationErrors = error.response.data.error
            }
            this.snackbar3 = true;
            return console.log(error)
          });
     },
     registerAction(){
        let payload = {
            name:this.isi.namargstr,
            email: this.isi.emailrgstr,
            password: this.isi.passwordrgstr,
        }
        axios.post('http://127.0.0.1:8081/api/register', payload)
          .then(response => {
            this.snackbar1 = true;
             this.$nextTick(() => {
          this.isi = Object.assign({}, this.kosong)
        })
            return console.log(response);
          })
          .catch(error => {
            this.snackbar2 = true;
            return console.log(error);
          });
     }
  },
};
</script>

<style scoped>
.login-container {
  width: 100vw;
  height: 100vh;
  background-image: url("../assets/Dashboard Login.png");
  background-size: cover;
  background-repeat: no-repeat;
  box-sizing: border-box;
  overflow: hidden;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}
.login {
  width: 500px;
  height: 500px;
  background: white;
}
.ocean {
  height: 500px;
  background-image: url("../public/Rectangle 2.png");
  background-size: cover;
  background-repeat: no-repeat;
  margin-top: 0px;
  margin-bottom: 0px;
}
.ocean2 {
  height: 500px;
  background-image: url("../public/Rectangle 2.png");
  background-size: cover;
  background-repeat: no-repeat;
  margin-top: 0px;
  margin-bottom: 0px;
}
</style>