<template>
    <div class="w-25">
        <div class="mb-3">
            <input type="text" v-model="name_order" placeholder="name_order" class="form-control">
        </div>
        <div class="mb-3">
            <input type="text" v-model="description" placeholder="description" class="form-control">
        </div>
        <div class="mb-3">
            <input type="number" v-model="price" placeholder="price" class="form-control">
        </div>
        <div class="mb-3">
            <input type="text" v-model="image" placeholder="image" class="form-control">
        </div>
        <div class="mb-3">
            <input type="number" v-model="category_id" placeholder="category_id" class="form-control">
        </div>
        <div class="mb-3">
            <input @click.prevent="store" type="submit" value="Add" class="form-control">
        </div>
    </div>
</template>

<script>
export default {
    name: "Create",

    data() {
        return {
            name_order: null,
            description: null,
            price: null,
            image: null,
            category_id: null,
        }
    },

    methods: {
        store() {
            axios.order('/api/orders', { name_order: this.name_order,
                                            description: this.description,
                                            price: this.price,
                                            image: this.image,
                                            category_id: this.category_id})
                .then(res => {

                })
        }
    }
}
</script>

<style scoped>

</style>
