import { createRouter, createWebHistory } from 'vue-router'
import beforeEach from './beforeEach'
import { routes as dashboard } from '../dashboard/index'

const AppRoute = {
  path: '/',
  component: () => import('../App.vue'),
  children: [...dashboard],
};

const routes = [AppRoute];

const router = createRouter({
  history: createWebHistory(),
  routes,
  linkActiveClass: 'active',
  linkExactActiveClass: 'active',
});

router.beforeEach(beforeEach);

export default router
