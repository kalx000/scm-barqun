<template>
  <div class="dashboard">
  <Navbar />
    <v-row class="px-12 py-12">
      <v-col cols="12" sm="4">
      <router-link style="text-transform:none; text-decoration:none;" to="/product">
        <v-card flat class="rounded-lg" :class="$vuetify.theme.dark ===true ? 'total-items':'total-items2'" height="200" width="auto">
          <v-list-item>
              <v-list-item-content>
                <v-list-item-title>
                  <h3>Product</h3>
                </v-list-item-title>
                <v-list-item-subtitle>
                  <h1></h1>
                </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
        </v-card>
      </router-link>
      </v-col>

      <v-col cols="12" sm="4" >
      <router-link style="text-transform:none; text-decoration:none;" to="/supplier">      
        <v-card flat class="rounded-lg supplier" :class="$vuetify.theme.dark ===true ? 'supplier':'supplier2'" height="200" width="auto">
          <v-list-item>
              <v-list-item-content>
                <v-list-item-title>
                  <h3>Supplier</h3>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
        </v-card>
      </router-link>
      </v-col>

      <v-col cols="12" sm="4" >
      <router-link style="text-transform:none; text-decoration:none;" to="/inventory">      
        <v-card flat class="rounded-lg warehouse" :class="$vuetify.theme.dark ===true ? 'warehouse':'warehouse2'" height="200" width="AUTO">
          <v-list-item >
              <v-list-item-content>
                <v-list-item-title>
                  <h3>Warehouse</h3>
                </v-list-item-title>
                <v-list-item-subtitle>
                </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
        </v-card>
      </router-link>
      </v-col>

      <v-col cols="12" sm="4" >
      <router-link style="text-transform:none; text-decoration:none;" to="/customers">
        <v-card flat class="rounded-lg customer" :class="$vuetify.theme.dark ===true ? 'customer':'customer2'" height="200" width="AUTO">
          <v-list-item >
              <v-list-item-content>
                <v-list-item-title>
                  <h3>Customer</h3>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
        </v-card>
      </router-link>
      </v-col>

      <v-col cols="12" sm="4" >
      <router-link style="text-transform:none; text-decoration:none;" to="/order">
        <v-card flat class="rounded-lg order" :class="$vuetify.theme.dark ===true ? 'order':'order2'" height="200" width="AUTO">
          <v-list-item >
              <v-list-item-content>
                <v-list-item-title>
                  <h3>Order</h3>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
        </v-card>
      </router-link>
      </v-col> 

      <v-col cols="12" sm="4" > 
      <router-link style="text-transform:none; text-decoration:none;" to="/user">
        <v-card flat class="rounded-lg user" :class="$vuetify.theme.dark ===true ? 'user':'user2'" height="200" width="AUTO">
          <v-list-item >
              <v-list-item-content>
                <v-list-item-title>
                  <h3>User </h3>
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
        </v-card>
      </router-link>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import axios from 'axios';
import Navbar from "../components/NavBar.vue"
export default {
  components:{
    Navbar,
  },
   name: "HomeView",
   data() {
    return {
      user: {},
    };
  },
}
</script>
<style scoped>
.total-items{
  background-image: url("@/assets/1.png");
  /* background-image: url("../assets/1b.png");  */
  background-size: cover;
  background-position: top right ;
}
.total-items2{
  /* background-image: url("@/assets/1.png"); */
  background-image: url("../assets/1b.png"); 
  background-size: cover;
  background-position: top right ;
}
.supplier { 
  background-image: url("../assets/2.png");
  /* background-image: url("../assets/2b.png"); */
  background-size: cover;
  background-position: top right ;
}
.supplier2 { 
  /* background-image: url("../assets/2.png"); */
  background-image: url("../assets/2b.png");
  background-size: cover;
  background-position: top right ;
}
.warehouse {
  background-image: url("../assets/3.png");
  /* background-image: url("../assets/3b.png"); */
  background-size: cover;
  background-position: top right ;
}
.warehouse2 {
  /* background-image: url("../assets/3.png"); */
  background-image: url("../assets/3b.png");
  background-size: cover;
  background-position: top right ;
}
.customer {
  background-image: url("../assets/4.png");
  /* background-image: url("../assets/4b.png"); */
  background-size: cover;
  background-position: top right ;
}
.customer2 {
  /* background-image: url("../assets/4.png"); */
  background-image: url("../assets/4b.png");
  background-size: cover;
  background-position: top right ;
}
.order {
  background-image: url("../assets/5.png");
  /* background-image: url("../assets/5b.png"); */
  background-size: cover;
  background-position: top right ;
}
.order2 {
  /* background-image: url("../assets/5.png"); */
  background-image: url("../assets/5b.png");
  background-size: cover;
  background-position: top right ;
}
.user {
  background-image: url("../assets/6.png");
  /* background-image: url("../assets/6b.png"); */
  background-size: cover;
  background-position: top right ;
}
.user2 {
  /* background-image: url("../assets/6.png"); */
  background-image: url("../assets/6b.png");
  background-size: cover;
  background-position: top right ;
}
.dashboard {
    height: 92vh;
}
.rounded-lg {
    cursor: pointer;
    transition: all 0.15s ease;
}
.rounded-lg:hover {
    scale: 1.02;
}
</style>
