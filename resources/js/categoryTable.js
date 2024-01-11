import { createApp } from 'vue';
import CategoryTableComponent from './components/CategoryTableComponent.vue';

const app = createApp({});
app.component('table-component', CategoryTableComponent);
app.mount('#category-table');
