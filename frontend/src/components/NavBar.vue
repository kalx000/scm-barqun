<template>
  <v-app-bar
    :elevation="4"
    style="position: relative"
    color="secondary"
    class=""
  >
    <div class="darkmode">
      <v-icon class="mr-1 sun">fa-solid fa-sun</v-icon>
      <v-switch
        class="mt-4 mx-1"
        v-model="$vuetify.theme.dark"
        @click="darkMode"
      ></v-switch>
      <v-icon class="mr-2 moon">fa-solid fa-moon</v-icon>
    </div>
  </v-app-bar>
</template>

<script>
export default {
  data() {
    return {
      dialog: false,
    };
  },
  methods: {
    darkMode() {
      const theme = this.$vuetify.theme.dark ? "dark" : "light";
      localStorage.setItem("appTheme", theme);
    },
  },
};
</script>


<style>
.darkmode {
  position: absolute;
  right: 10px;
}
</style>