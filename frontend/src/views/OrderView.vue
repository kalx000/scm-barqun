<template>
    <v-app>
        <LeftBar/>
        <Order/>
        <Footer/>
    </v-app>
</template>

<script>
import LeftBar from '@/components/LeftBar.vue'
import Order from '@/components/Order.vue'
import Footer from '@/components/Footer.vue'
export default {
    components:{
        LeftBar,
        Order,
        Footer,
    }
}
</script>

<style>

</style>