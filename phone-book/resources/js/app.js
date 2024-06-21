

import './bootstrap';
import { createApp } from 'vue';
import router from './router/index'

const app = createApp({});

import PhoneBookComponent from './components/PhoneBookComponent.vue';
app.component('phone-book-component', PhoneBookComponent);


app.use(router);
app.mount('#app');
