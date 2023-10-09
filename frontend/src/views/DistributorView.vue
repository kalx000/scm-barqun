<template>
    <v-app>
        <LeftBar/>
        <Distributor/>
        <Footer/>
    </v-app>
</template>

<script>
import LeftBar from '@/components/LeftBar.vue'
import Distributor from '@/components/Distributor.vue'
import Footer from '@/components/Footer.vue'
export default {
    components:{
        LeftBar,
        Distributor,
        Footer
    }
}
</script>

<style>

</style>