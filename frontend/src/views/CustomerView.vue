<template>
    <v-app>
        <LeftBar/>
        <Customers/>
        <Footer/>
    </v-app>
</template>

<script>
import LeftBar from '@/components/LeftBar.vue'
import Customers from '@/components/Customer.vue'
import Footer from '@/components/Footer.vue'
export default {
    components:{
        LeftBar,
        Customers,
        Footer
    }
}
</script>

<style>

</style>