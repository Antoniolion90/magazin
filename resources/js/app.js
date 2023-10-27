import './bootstrap';
import { createApp } from 'vue';
import Index from "@/components/Index.vue";
import router from "@/router.js";

const app = createApp({
    components:{
        'index': Index,
    }
});

app.use(router)
app.config.globalProperties.axios = axios

app.mount('#app');
