import { createApp } from 'vue';
import LevelCheckboxComponent from './form_components/LevelCheckboxComponent.vue';

const app = createApp({});
app.component('level-checkbox-component', LevelCheckboxComponent);
app.mount('#level-checkbox-app');
