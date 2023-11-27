<template>
  <v-app>
    <LeftBar/>
    <Dashboard />
    <Footer />
  </v-app >
</template>

<script>
import LeftBar from "@/components/LeftBar.vue";
import Dashboard from "@/components/Dashboard.vue";
import Footer from "../components/Footer.vue"
export default {
  name: "HomeView",

  components: {
    LeftBar,
    Dashboard,
    Footer
  },
 
};
</script>

<style scoped>
.body::-webkit-scrollbar{
  display: none;
}
</style>