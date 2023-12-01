<template>
    <v-app>
        <LeftBar/>
        <Customers/>
    </v-app>
</template>

<script>
import LeftBar from '@/components/LeftBar.vue'
import Customers from '@/views/pages/customer/Index.vue'
import Footer from '@/components/Footer.vue'
export default {
    components:{
        LeftBar,
        Customers,
        Footer,

    }
}
</script>

<style>

</style>