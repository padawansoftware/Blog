import Router from 'vue-router';
import generatedRoutes from 'vue-auto-routing';

import PageNotFound from '@views/404.vue'
const myRoutes = [
    {
        name: 'not-found',
        path: "*",
        component: PageNotFound
    }
];

const routes = new Router({
    mode: 'history',
    routes: [...generatedRoutes, ...myRoutes]
});

export default routes;