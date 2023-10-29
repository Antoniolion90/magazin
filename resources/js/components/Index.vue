<template>
    <div>
        <router-link :to="{ name: 'products.index' }" class="m-2">Главная</router-link>
        <router-link :to="{ name: 'cart.index' }" class="m-2">Корзина</router-link>
        <router-view></router-view>
    </div>
</template>

<script>

export default {
    name: "Index"
}
</script>

<style scoped>

</style>
