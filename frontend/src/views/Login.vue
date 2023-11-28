<template>
  <div class="login-container">
    <v-card class="elevation-12" width="930px">
      <v-window v-model="step">
        <div class="sign-up">
          <v-window-item :value="1">
            <v-row>
              <v-col cols="12" md="8">
                <v-card-text class="mt-6">
                  <h1 class="text-center">Sign in to Barqun SCM</h1>
                  <v-form class="pt-10">
                    <v-text-field
                      label="Email"
                      name="Email"
                      prepend-icon="email"
                      type="text"
                      color="#0284D0"
                    />

                    <v-text-field
                      id="password"
                      label="Password"
                      name="password"
                      prepend-icon="lock"
                      type="password"
                      color="#0284D0"
                    />
                  </v-form>
                </v-card-text>
                <div class="text-center mt-3">
                  <v-btn rounded color="#0284D0" dark to="/home">SIGN IN</v-btn>
                </div>
              </v-col>
            </v-row>
          </v-window-item>
        </div>
        <v-window-item :value="2">
          <v-row>
            <v-col cols="12" md="4" class="py-0 px-2">
              <div class="ocean2">
              </div>
            </v-col>
          </v-row>
        </v-window-item>
      </v-window>
    </v-card>
  </div>
</template>
props: {
        source: String,
      },
<script>
import axios from 'axios';

export default {
  data() {
    return {
      step: 1,
      loginForm: {
        email: '',
        password: '',
      },
    };
  },
  methods: {
    async signIn() {
      try {
        const response = await axios.post('http://your-api-endpoint/login', {
          email: this.loginForm.email,
          password: this.loginForm.password,
        });

        // Assuming your backend returns a token upon successful login
        const token = response.data.token;

        // Save the token to localStorage or Vuex store for future requests
        localStorage.setItem('token', token);

        // Redirect to the home page or perform other actions upon successful login
        this.$router.push('/home');
      } catch (error) {
        console.error('Login failed:', error);
        // Handle login failure, show an error message, etc.
      }
    },
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