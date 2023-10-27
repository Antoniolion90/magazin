<template>
    <div>
        <router-link :to="{ name: 'index' }" class="m-2">Главная</router-link>
        <router-link :to="{ name: 'products.create' }" class="m-2">Add</router-link>
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
