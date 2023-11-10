import { createRouter, createWebHistory } from "vue-router"

const routeInfo = [
    {
        path : "/",
        component : () => import ('./components/product/Index.vue'),
        name: 'products.index'
    },
    {
        path : "/products/:id",
        component : () => import ('./components/product/Show.vue'),
        name: 'products.show',
        props: true
    },
    {
        path : "/cart",
        component : () => import ('./components/product/Cart.vue'),
        name: 'cart.index'
    },
    {
        path : "/address",
        component : () => import ('./components/product/Address.vue'),
        name: 'address.index'
    }
]

const router = createRouter({
    history : createWebHistory(process.env.BASE_URL),
    routes : routeInfo
})

export default router;
