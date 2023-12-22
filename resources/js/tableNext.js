import { createApp } from 'vue';
import TableNextComponent from './components/TablenextComponent.vue';

const app = createApp({});
app.component('table-next-component', TableNextComponent);
app.mount('#table-next-app');
