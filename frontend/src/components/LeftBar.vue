<template>
  <v-navigation-drawer
    v-model="drawer"
    app
    height="100%"
    width="200"
    :mini-variant.sync="mini"
    color="primary"
    class="teks"
  >
    <v-list-item>
      <v-list-item-avatar class="ml-n2">
        <v-img v-if="$vuetify.theme.dark" src="barqun.png"></v-img>
        <v-img v-else src="barqunBlack.png"></v-img>
      </v-list-item-avatar>
      <v-list-item-title style="color:white;"><h5>Supply Chain</h5></v-list-item-title>
      <v-btn icon @click.stop="mini = !mini">
        <v-icon style="color:#fff;">fas fa-chevron-left fa-2xs</v-icon>
      </v-btn>
    </v-list-item>
    <v-divider></v-divider>
    <v-list dense nav>
      <v-list-item-group class="mt-4" active-class="active1">
        <v-list-item to="/home" class="mb-4">
          <v-list-item-icon>
            <v-icon size="x-large">fat fa-home</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle class="teks"><h3>Dashboard</h3></v-list-item-subtitle>
        </v-list-item>
        <v-list-item to="/product" class="mb-4">
          <v-list-item-icon>
            <v-icon>fas fa-box</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle class="teks"><h3>Product</h3></v-list-item-subtitle>
        </v-list-item>
        <v-list-item to="/supplier" class="mb-4">
          <v-list-item-icon>
            <v-icon>fas fa-industry</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle class="teks"><h3>Supplier</h3></v-list-item-subtitle>
        </v-list-item>
        <v-list-item to="/warehouse" class="mb-4">
          <v-list-item-icon>
            <v-icon>fas fa-warehouse</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle class="teks"><h3>Warehouse</h3></v-list-item-subtitle>
        </v-list-item>
        <v-list-item to="/customers" class="mb-4">
          <v-list-item-icon>
            <v-icon>fas fa-users</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle class="teks"><h3>Customer</h3></v-list-item-subtitle>
        </v-list-item>
        <v-list-item to="/order" class="mb-4">
          <v-list-item-icon>
            <v-icon>fas fa-inbox</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle class="teks"><h3>Order</h3></v-list-item-subtitle>
        </v-list-item>
        <v-list-item to="/user" class="mb-2">
          <v-list-item-icon>
            <v-icon>fas fa-circle-user</v-icon>
          </v-list-item-icon>
          
          <v-list-item-subtitle class="teks"><h3>User</h3></v-list-item-subtitle>
        </v-list-item>
      </v-list-item-group>
      
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  data: () => ({
    drawer: true,
    mini: false,
  }),
};
</script>

<style>
.profile {
  position: absolute;
  bottom: 50px;
  color: white !important;
}
.active1 {
  background-color: #1565C0 !important;
  color: white !important;
}
.active1 .teks{
  color: white !important;
}

.darkmode {
  display: flex;
}

.teks{
  color: white !important;
}
</style>