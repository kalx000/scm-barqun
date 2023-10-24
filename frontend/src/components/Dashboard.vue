 <template>
  <div class="dashboard">
  <!-- <div class="greetings"> -->
  
  <!-- <h1>Hello there, Nice to meet you Fransiscus 😎🤙</h1> -->
  <!-- <v-divider :thickness="100" color="white" style="width:55%;"></v-divider> -->
  <!-- </div> -->
    <v-row class="px-12 py-12">
      <v-col cols="12" sm="4">
      <router-link style="text-transform:none; text-decoration:none;" to="/product">
        <v-card flat class="rounded-lg" :class="$vuetify.theme.dark ===true ? 'total-items':'total-items2'" height="200" width="auto">
          <!-- <v-img v-if="$vuetify.theme.dark" src="@/assets/1.png"></v-img>
          <v-img v-else src="@/assets/1b.png"></v-img> -->
          <v-list-item>
              <v-list-item-content>
                <v-list-item-title>
                  <h3>Total Items</h3>
                </v-list-item-title>
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
      <router-link style="text-transform:none; text-decoration:none;" to="/warehouse">      
        <v-card flat class="rounded-lg warehouse" :class="$vuetify.theme.dark ===true ? 'warehouse':'warehouse2'" height="200" width="AUTO">
          <v-list-item >
              <v-list-item-content>
                <v-list-item-title>
                  <h3>Warehouse</h3>
                </v-list-item-title>
                <v-list-item-subtitle>
                <h1>10</h1>
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
export default {
  name: "HomeView",
};
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
.greetings{
margin-left: 5rem;
margin-top: 2rem;
margin-bottom: 1rem;
}
</style>
