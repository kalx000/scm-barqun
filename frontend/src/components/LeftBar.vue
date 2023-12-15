<template>
  <v-navigation-drawer
    v-model="drawer"
    app
    height="100%"
    color="primary"
    :mini-variant.sync="mini"
    class="teks"
    style="z-index: 101"
  >
    <v-list-item>
      <v-list-item-avatar class="ml-n2">
        <v-img v-if="$vuetify.theme.dark" src="barqun.png"></v-img>
        <v-img v-else src="barqun.png"></v-img>
      </v-list-item-avatar>
      <v-list-item-title style="color: white"
        ><h3>Supply Chain</h3></v-list-item-title
      >
      <v-btn icon @click.stop="mini = !mini">
        <v-icon style="color: #fff">fas fa-chevron-left fa-2xs</v-icon>
      </v-btn>
    </v-list-item>
    <v-divider></v-divider>
    <v-list dense nav>
      <v-list-item-group class="mt-4" active-class="active1">
        <v-list-item to="/home" class="mb-4">
          <v-list-item-icon>
            <v-icon>mdi-home</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle class="teks"
            ><h3>Dashboard</h3></v-list-item-subtitle
          >
        </v-list-item>
        <v-list-item to="/product" class="mb-4">
          <v-list-item-icon>
            <v-icon>mdi-package</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle class="teks"
            ><h3>Product</h3></v-list-item-subtitle
          >
        </v-list-item>
        <v-list-item to="/supplier" class="mb-4">
          <v-list-item-icon>
            <v-icon>mdi-factory</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle class="teks"
            ><h3>Supplier</h3></v-list-item-subtitle
          >
        </v-list-item>

        <v-list-group class="mb-4" prepend-icon="mdi-warehouse" 
        :active-color="$vuetify.theme.dark ? 'activeDark' : 'activeLight'">
          <template v-slot:activator>
            <v-list-item-title class="teks">
              <h3>Warehouse</h3>
            </v-list-item-title>
          </template>
          <v-list-item to="/inventory" class="mb-4">
            <v-list-item-icon>
              <v-icon>mdi-archive-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-subtitle class="teks"
              ><h3>Inventory</h3></v-list-item-subtitle
            >
          </v-list-item>
          <v-list-item to="/stockin" class="mb-4">
            <v-list-item-icon>
              <v-icon>mdi-plus-box-multiple-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-subtitle class="teks"
              ><h3>Stock In</h3></v-list-item-subtitle
            >
          </v-list-item>
          <v-list-item to="/stockout" class="mb-4">
            <v-list-item-icon>
              <v-icon>mdi-minus-box-multiple-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-subtitle class="teks"
              ><h3>Stock Out</h3></v-list-item-subtitle
            >
          </v-list-item>
          <v-list-item to="/stockopname" class="mb-4">
            <v-list-item-icon>
              <v-icon>mdi-star-box-multiple-outline</v-icon>
            </v-list-item-icon>
            <v-list-item-subtitle class="teks"
              ><h3>Stock Opname</h3></v-list-item-subtitle
            >
          </v-list-item>
        </v-list-group>

        <v-list-item to="/customers" class="mb-4">
          <v-list-item-icon>
            <v-icon>mdi-account-group</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle class="teks"
            ><h3>Customer</h3></v-list-item-subtitle
          >
        </v-list-item>
        <v-list-item to="/order" class="mb-4">
          <v-list-item-icon>
            <v-icon>mdi-inbox-full</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle class="teks"
            ><h3>Order</h3></v-list-item-subtitle
          >
        </v-list-item>
        <v-list-item to="/user" class="mb-2">
          <v-list-item-icon>
            <v-icon>mdi-account</v-icon>
          </v-list-item-icon>
          <v-list-item-subtitle class="teks"
            ><h3>User</h3></v-list-item-subtitle
          >
        </v-list-item>
          <div class="propil" >
            <v-list-item  to="/profile">
          <v-list-item-avatar class="ml-0">
            <v-img src="bongo.gif"></v-img>
          </v-list-item-avatar>
          <v-list-item-title><h5 style="font-size:1rem;" class="teks">{{name}}</h5></v-list-item-title>
        </v-list-item>
        
        <v-list-item @click="dialog = true">
            <v-icon class="teks">fa-solid fa-arrow-right-from-bracket</v-icon>
            <h3 style="font-size:16px;" class="teks pl-6">Log out</h3>
           <v-dialog
      v-model="dialog"
      max-width="500"
    >
      <v-card>
        <v-card-text class="text-center pt-5">
      <v-icon size="75" color="red">
        fa-solid fa-triangle-exclamation fa-2xl
      </v-icon>
      </v-card-text>


        <v-card-text class="text-h5 text-center font-weight-bold">
          Are You Sure Want To Logout?
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="secondary"
            text
            @click="dialog = false"
            class="mb-5"
          >
            Cancel
          </v-btn>

          <v-btn
          @click="logoutAction()"
            color="secondary"
            text
            class="nav-link mb-5"
          >
            Logout
          </v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
        </v-list-item>
          </div>
      </v-list-item-group>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  data: () => ({
    drawer: true,
    mini: false,
    dialog: false,

  name: localStorage.getItem("name")

    
  }),
  methods: {
    logoutAction () {
      localStorage.removeItem("token");
      localStorage.removeItem("name");
      localStorage.removeItem("email");
      localStorage.removeItem("password");
      window.location.href="/"
    }
  }
};
</script>

<style>
.profile {
  position: absolute;
  bottom: 50px;
  color: white !important;
}
.active1 {
  color: white !important;
}
.active1 .teks {
  color: white !important;
}

.darkmode {
  display: flex;
}

.teks {
  color: white !important;
}

.propil{
  position: fixed;
  bottom: 0;
  width: 100%;
  padding-bottom: 20px;
}

</style>
