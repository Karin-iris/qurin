import { createApp } from 'vue';
import MySectionTableComponent from './components/MySectionTableComponent.vue';

const app = createApp({});
app.component('table-component', MySectionTableComponent);
app.mount('#my-section-table');
