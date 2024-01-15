import { createApp } from 'vue';
import ToggleTextComponent from './form_components/ToggleTextComponent.vue';

const app = createApp({});
app.component('toggle-text-component', ToggleTextComponent);
app.mount('#toggle-text-app');
