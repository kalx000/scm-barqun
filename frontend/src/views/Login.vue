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
                        <div class="text-center">
                        <v-btn rounded color="#0284D0" class=" mt-4" dark>Forgot your password ?</v-btn>
                        </div>
                      </v-card-text>
                      <div class="text-center mt-3">
                        <v-btn rounded color="#0284D0" dark to="/home">SIGN IN</v-btn>
                      </div>
                    </v-col>
                    <div class="ocean">
                      <v-card-text class="white--text text-center mt-16 pt-13">
                        <v-img class="mt-16" width="250px" src="../assets/image 2.png" />
                        <h5
                          class="text-center"
                        >Enter your personal details and start journay with us</h5>
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
                    <v-col cols="12" md="4" class="py-0 px-0">
                      <div class="ocean2">
                      <v-card-text class="white--text">
                        <v-img class="mt-16" width="250px" src="../assets/image 2.png" />
                        <h5
                          class="text-center"
                        >To Keep connected with us please login with your personnel info</h5>
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
                        <v-form>
                          <v-text-field
                            label="Name"
                            name="Name"
                            prepend-icon="person"
                            type="text"
                            color="#0284D0"
                          />
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
                      <div class="text-center mt-n5">
                        <v-btn rounded color="#0284D0" dark>SIGN UP</v-btn>
                      </div>
                    </v-col>
                  </v-row>
                </v-window-item>
              </v-window>
            </v-card>
    </div>
</template>

<script>
export default {
  data: () => ({
    step: 1
  }),
  props: {
    source: String
  }
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
.login{
    width: 500px;
    height: 500px;
    background: white;
}
.ocean{
  height: 500px;
  background-image: url("../assets/Rectangle 2.png");
  background-size: cover;
  background-repeat: no-repeat;
  margin-top: 0px;
  margin-bottom: 0px;
}
.ocean2{
  height: 500px;
  background-image: url("../assets/Rectangle 2.png");
  background-size: cover;
  background-repeat: no-repeat;
  margin-top: 0px;
  margin-bottom: 0px;
}

</style>