import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/FinanceHomeView.vue'
import FinanceHomeView from '../views/FinanceHomeView.vue'
import WelcomePage from '@/views/WelcomePage.vue'
import FinanceEmployeePage from '@/views/Finance/FinanceEmployeePage.vue'
import FinancePaymentPage from '@/views/Finance/FinancePaymentPage.vue'
import LoginPage from '@/views/Auth/LoginPage.vue'



const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Welcome',
      component: WelcomePage,
    },
    {
      path: '/home',
      name: 'Home',
      component: FinanceHomeView,
    },
    {
      path: '/finance/home',
      name: 'FinanceHome',
      component: FinanceHomeView,
    },
    {
      path: '/finance/employees',
      name: 'FinanceEmployee',
      component: FinanceEmployeePage,
    },
    {
      path: '/finance/payment',
      name: 'FinancePayment',
      component: FinancePaymentPage,
    },
    {
      path: '/login',
      name: 'Login',
      component: LoginPage,
      meta: { guest: true },
    },

  ],
})

export default router
