<template>
  <v-app>
    <LeftBar />
    <Supplier/>
    <Footer />
  </v-app>
</template>
<script>
import LeftBar from "@/components/LeftBar.vue";
import Supplier from "@/components/Supplier.vue";
import Footer from "@/components/Footer.vue";
export default {
  components: {
    LeftBar,
    Supplier,
    Footer,
  },
};
</script>

<style>
</style>
