import { createApp } from 'vue';
import SectionTableComponent from './components/SectionTableComponent.vue';

const app = createApp({});
app.component('table-component', SectionTableComponent);
app.mount('#section-table');
