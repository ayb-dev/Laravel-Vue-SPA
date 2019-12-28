<template>
    <main>
        
        <Header />

        <div id="wrapper">

            <!-- Sidebar -->
            <Sidebar />

            <div id="content-wrapper">

                <router-view></router-view>

                <Footer />

            </div>

        </div>

        <FlashMessage position="right top"></FlashMessage>
        
    </main>
</template>

<script>
import Header from './Header'
import Sidebar from './Sidebar'
import Footer from './Footer'

export default {
    components: {
        Header,
        Sidebar,
        Footer,
    }
}
</script>