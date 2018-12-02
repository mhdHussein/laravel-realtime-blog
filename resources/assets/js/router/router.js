import Vue from 'vue';
import VueRouter from 'vue-router';
import Login from '../components/login/Login';
import Signup from '../components/login/Signup';
import Logout from '../components/login/Logout';
import Forum from '../components/forum/Forum';
import SingleQuestion from '../components/forum/SingleQuestion';
import CreateQuestion from '../components/forum/CreateQuestion';
import CreateCategory from '../components/category/CreateCategory';
Vue.use(VueRouter);

const routes = [
    {path : '/login' , component : Login},
    {path : '/logout' , component : Logout},
    {path : '/signup' , component : Signup},
    {path : '/forum' , component : Forum , name : 'forum'},
    {path : '/category' , component : CreateCategory , name : 'category'},
    {path : '/question/:slug' , component : SingleQuestion , name : 'question'},
    {path : '/ask' , component : CreateQuestion },
];

const router = new VueRouter({
    routes,
    hashbang: false,
    mode: 'history'
});

export default router