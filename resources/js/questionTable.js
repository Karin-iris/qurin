import { createApp } from 'vue';
import QuestionTableComponent from './components/QuestionTableComponent.vue';

const app = createApp({});
app.component('table-component', QuestionTableComponent);
app.mount('#question-table');
