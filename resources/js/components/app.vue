<script setup>

    import HomeHeader from './pages/home/header.vue'
    import HomeFooter from './pages/home/footer.vue'

</script>

<template>
    <div class="main-wrapper">
    <home-header></home-header>

            <router-view></router-view>

    <home-footer></home-footer>
    </div>

</template>
