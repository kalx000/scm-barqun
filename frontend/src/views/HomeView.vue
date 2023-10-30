<template>
  <v-app>
    <NavBar/>
    <LeftBar/>
    <Dashboard />
    <Footer/>
  </v-app >
</template>

<script>
import LeftBar from "@/components/LeftBar.vue";
import NavBar from "@/components/NavBar.vue";
import Footer from "@/components/Footer.vue";
import Dashboard from "@/components/Dashboard.vue";

export default {
  name: "HomeView",

  components: {
    Footer,
    LeftBar,
    NavBar,
    Dashboard
  },
 
};
</script>

<style scoped>
.body::-webkit-scrollbar{
  display: none;
}
</style>