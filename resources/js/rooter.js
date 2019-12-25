import Vue from 'vue';
import Router from 'vue-router';
import Welcome from './components/views/Welcome';
import Categories from './components/views/Categories';

Vue.use(Router);

const routes = [
    {
        path: '/',
        name: 'welcome',
        component: Welcome,
    },
    {
        path: '/categories',
        name: Categories,
        component: () => import('./components/views/Categories')
    }
];

const router = new Router({
    routes: routes,
    linkActiveClass: 'active'
});

export default router;