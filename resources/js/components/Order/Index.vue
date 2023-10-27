<template>
    <div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <div v-for="product in products" class="col">
                <div class="card shadow-sm">
                    <div class="position-relative overflow-hidden" style="height:15em; width:100%">
                        <img :src="product.image_url" alt="image" class="img-fluid position-absolute" style="height:100%; width:100%">
                    </div>
                    <div class="card-body row">
                        <div class="card-text col-md-8">{{ product.title }}</div>
                        <div class="card-text col-md-4"><span class="pull-right">{{ product.price }} руб.</span></div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="#" class="btn btn-sm btn-outline-secondary">Смотреть
                                </a>
                            </div>
                            <small class="text-body-secondary">{{ product.category.title }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index",

    mounted() {
        this.getProducts()
    },

    data() {
        return {
            products: []
        }
    },

    methods: {
        getProducts() {
            this.axios.get('/api/')
                .then(res => {
                    this.products = res.data.data;
                })
        }
    }
}
</script>

<style scoped>

</style>
