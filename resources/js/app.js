import './bootstrap';

import { createApp } from 'vue';
import '../css/app.css';

import AuthForm from './components/AuthForm.vue';
import ProductGrid from './components/ProductGrid.vue';

const app = createApp({
    components: {
        AuthForm,
        ProductGrid,
    },
});

app.mount('#app');
