<template>
<v-app>
    <Leftbar />
    <Profile />
    <Footer />
</v-app>
</template>

<script>
import Leftbar from "../components/LeftBar.vue"
import Profile from "../components/Profile.vue"
import Footer from "../components/Footer.vue"
export default {
    components:{
        Leftbar,
        Profile,
        Footer
    }

}
</script>

<style>

</style>