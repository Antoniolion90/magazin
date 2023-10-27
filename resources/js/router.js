import { createRouter, createWebHistory } from "vue-router"

const routeInfo = [
    {
        path : "/",
        component : () => import ('./components/Order/Index.vue'),
        name: 'index'
    },
    {
        path : "/products/create",
        component : () => import ('./components/Order/Create.vue'),
        name: 'products.create'
    }
]

const router = createRouter({
    history : createWebHistory(),
    routes : routeInfo
})

export default router;
