<template>
    <v-app>
        <LeftBar/>
        <Footer />
        <User/>
    </v-app>
</template>

<script>
import LeftBar from '@/components/LeftBar.vue'
import User from '@/components/User.vue'
import Footer from '@/components/Footer.vue'
export default {
    components:{
        LeftBar,
        User,
        Footer,
    }
}
</script>

<style>

</style>