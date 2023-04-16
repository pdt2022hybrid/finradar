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
      name: 'databazy',
      component: () => import('@/views/Databazy.vue')
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: () => import('@/views/UserDashboard.vue')
    },
    {
      path: '/company/:ico',
      name: 'company',
      component: () => import('@/views/CompanyPage.vue')
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('@/views/RegPage.vue')
    },
    {
      path: '/Pages',
      name: 'mapa_stranok',
      component: () => import('@/views/IndexOfPages.vue')
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('@/views/LoginPage.vue')
    }
    // dalsie dame potom co urobime fazu 1
  ]
})

export default router
