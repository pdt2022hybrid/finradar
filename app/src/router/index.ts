import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      redirect: '/home'
    },
    {
      path: '/home',
      name: 'Home',
      component: () => import('@/views/HomePage.vue')
    },
    {
      path: '/databazy',
      name: 'Databazy',
      component: () => import('@/views/Databazy.vue')
    },
    {
      path: '/dashboard',
      name: 'Dashboard',
      component: () => import('@/views/UserDashboard.vue')
    },
    {
      path: '/company',
      name: 'Company',
      component: () => import('@/views/CompanyPage.vue')
    },
    {
      path: '/register',
      name: 'Register',
      component: () => import('@/views/RegPage.vue')
    }
  ]
})

export default router
