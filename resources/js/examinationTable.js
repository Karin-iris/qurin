import { createApp } from 'vue';
import ExaminationTableComponent from './components/ExaminationTableComponent.vue';

const app = createApp({});
app.component('table-component', ExaminationTableComponent);
app.mount('#examination-table');
