import { createApp } from 'vue';
import ImageUploadComponent from './components/ImageUploadComponent.vue';

const app = createApp({});
app.component('image-upload-component', ImageUploadComponent);
app.mount('#image-upload-app');
