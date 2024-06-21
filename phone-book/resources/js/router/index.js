import { createRouter, createWebHistory } from "vue-router";
import PhoneBookComponent from '../components/PhoneBookComponent.vue';

const routes = [
    {
        path: '/contacts',
        component: PhoneBookComponent
    },


];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;