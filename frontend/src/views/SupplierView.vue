<template>
  <v-app>
    <Navbar />
    <LeftBar />
    <Supplier/>
    <Footer />
  </v-app>
</template>
<script>
import LeftBar from "@/components/LeftBar.vue";
import Supplier from "@/components/Supplier.vue";
import Footer from "@/components/Footer.vue";
import Navbar from "@/components/NavBar.vue"
export default {
  components: {
    LeftBar,
    Supplier,
    Footer,
    Navbar
  },
};
</script>

<style>
</style>
