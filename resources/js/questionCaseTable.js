import { createApp } from 'vue';
import QuestionCaseTableComponent from './components/QuestionCaseTableComponent.vue';
import QuestionCaseQuestionTableComponent from './components/QuestionCaseQuestionTableComponent.vue';

const app = createApp({});
app.component('table-component', QuestionCaseTableComponent);
app.component('table-question-component', QuestionCaseQuestionTableComponent);
app.mount('#question-case-table');
