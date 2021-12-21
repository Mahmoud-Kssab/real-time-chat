import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Messages from '../components/MessageComponent.vue';
import Chat from '../components/ChatsComponent.vue';


const routes = [

    {path: '/messages/:user_id', component: Messages, name: 'Messages'},
    {path: '/home', component: Chat, name: 'Chat'}


];

const router = new VueRouter({

    routes,hashbang:false,mode:'history'
})

export default router;
