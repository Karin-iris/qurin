import { createApp } from 'vue';
import SectionSelectComponent from './form_components/SectionSelectComponent.vue';

const app = createApp({});
app.component('section-select-component', SectionSelectComponent);
app.mount('#section-select-app');
