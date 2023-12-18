import { createApp } from 'vue';
import CategoryComponent from './components/CategoryComponent.vue';

const app = createApp({});
app.component('category-component', CategoryComponent);
app.mount('#category-app');
