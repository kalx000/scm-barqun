<template>
    <v-app>
        <LeftBar/>
        <Product/>
        <Footer />
    </v-app>
</template>


<script>
import LeftBar from '@/components/LeftBar.vue'
import Product from '@/components/Product.vue'
import Footer from '@/components/Footer.vue'
export default {
    components:{
        LeftBar,
        Product,
        Footer,
    }
}
</script>

<style>

</style>