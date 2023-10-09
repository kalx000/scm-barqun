<template>
  <v-navigation-drawer
    v-model="drawer"
    app
    height="100%"
    width="200"
    :mini-variant.sync="mini"
    permanent
  >
    <v-list-item>
      <v-list-item-avatar class="ml-n2">
        <v-img src="barqunBlack.png"></v-img>
      </v-list-item-avatar>
      <v-list-item-title><h5>Supply Chain</h5></v-list-item-title>
      <v-btn icon @click.stop="mini = !mini">
        <v-icon>mdi-chevron-left</v-icon>
      </v-btn>
    </v-list-item>
    <v-divider></v-divider>
    <v-list dense nav>
      <v-list-item-group class="mt-4" active-class="nyala">
        <v-list-item to="/home" class="mb-4">
          <v-list-item-icon>
            <v-icon>fas fa-gauge</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle><h3>Dashboard</h3></v-list-item-subtitle>
        </v-list-item>
        <v-list-item to="/product" class="mb-4">
          <v-list-item-icon>
            <v-icon>fas fa-box</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle><h3>Product</h3></v-list-item-subtitle>
        </v-list-item>
        <v-list-item to="/supplier" class="mb-4">
          <v-list-item-icon>
            <v-icon>fas fa-industry</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle><h3>Supplier</h3></v-list-item-subtitle>
        </v-list-item>
        <v-list-item to="/warehouse" class="mb-4">
          <v-list-item-icon>
            <v-icon>fas fa-warehouse</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle><h3>Warehouse</h3></v-list-item-subtitle>
        </v-list-item>
        <v-list-item to="/customers" class="mb-4">
          <v-list-item-icon>
            <v-icon>fas fa-user</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle><h3>Customer</h3></v-list-item-subtitle>
        </v-list-item>
        <v-list-item to="/order" class="mb-4">
          <v-list-item-icon>
            <v-icon>fas fa-inbox</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle><h3>Order</h3></v-list-item-subtitle>
        </v-list-item>
        <!-- <v-list-item to="/distributor" class="mb-2">
          <v-list-item-icon>
            <v-icon>fas fa-truck</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle><h3>Distributor</h3></v-list-item-subtitle>
        </v-list-item> -->
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
.nyala {
  background-color: #191d88 !important;
  color: white !important;
}

.darkmode {
  display: flex;
}
</style>