import { createApp } from 'vue';
import SearchIdQuestionComponent from './form_components/SearchIdQuestionComponent.vue';

const app = createApp({});
app.component('search-id-question-component', SearchIdQuestionComponent);
app.mount('#search-id-text-app');
