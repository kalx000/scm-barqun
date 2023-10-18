<template>
  <v-app>
    <v-main>
      <router-view/>
    </v-main>
  </v-app>
</template>

<script>
export default {
  name: 'App',
  data: () => ({
    //
  }),
};
</script>
<style>
html {
  overflow-y: auto;
}

html::-webkit-scrollbar {
  display: none;
}
</style>