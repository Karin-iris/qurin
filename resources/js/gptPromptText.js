import { createApp } from 'vue';

import GptPromptComponent from './form_components/GptPromptComponent.vue';

const app = createApp({});
app.component('gpt-prompt-component', GptPromptComponent);
app.mount('#gpt-prompt-app');
