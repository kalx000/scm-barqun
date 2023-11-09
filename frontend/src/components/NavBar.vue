<template>
  <v-app-bar :elevation="10" border="rounded-0" style="width:2000px;" color="secondary" class="navbar">
  <div class="darkmode">
        <v-icon class="mr-1 sun">fa-solid fa-sun</v-icon>
        <v-switch  class="mt-4 mx-1" v-model="$vuetify.theme.dark"></v-switch>
        <v-icon class="mr-2 moon">fa-solid fa-moon</v-icon>
      </div>
      <v-divider
  vertical
></v-divider>
    <div class="profile">
        <v-list-item>
          <v-list-item-avatar class="ml-n2">
            <v-img src="bongo.gif"></v-img>
          </v-list-item-avatar>
          <v-list-item-title><h5 class="teks">Fransiscus</h5></v-list-item-title>
          <v-btn icon @click.stop="dialog = true">
            <v-icon class="teks">fa-solid fa-arrow-right-from-bracket</v-icon>
          </v-btn>
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
            color="secondary"
            text
            to="/"
            class="mb-5"
          >
            Logout
          </v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
        </v-list-item>
      </div>
  </v-app-bar>
</template>

<script>
export default {
   data () {
      return {
        dialog: false,
      }
    },
}
</script>


<style>
.navbar{
  position:fixed;
  top: 0;
  right: 0;
  z-index: 100;
}
.profile{
position:absolute;
font-size: 13px;
margin-left: 85%;
bottom: 10%;
}
.darkmode{
position:block;
margin-left: 79%;
}


</style>