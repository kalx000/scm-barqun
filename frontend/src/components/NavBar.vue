<template>
  <v-app-bar :elevation="5" border="rounded-0" style="width:2000px;" color="secondary">
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
          <v-list-item-title><h5>Fransiscus</h5></v-list-item-title>
          <v-btn icon to="/">
            <v-icon sm>fa-solid fa-arrow-right-from-bracket</v-icon>
          </v-btn>
        </v-list-item>
      </div>
  </v-app-bar>
</template>

<script>
export default {
  
  computed: {
    isDarkMode() {
      return this.$vuetify.theme.dark 
    }
  },
}
</script>


<style>
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