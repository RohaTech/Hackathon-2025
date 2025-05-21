import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/FinanceHomeView.vue'
import FinanceHomeView from '../views/FinanceHomeView.vue'
import WelcomePage from '@/views/WelcomePage.vue'
import FinanceEmployeePage from '@/views/Finance/FinanceEmployeePage.vue'
import FinancePaymentPage from '@/views/Finance/FinancePaymentPage.vue'
import LoginPage from '@/views/Auth/LoginPage.vue'
import { useAuthStore } from '@/stores/auth'



const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Welcome',
      component: WelcomePage,
      meta: { welcome: true }
    },
    {
      path: '/finance/home',
      name: 'FinanceHome',
      component: FinanceHomeView,
      meta: { finance: true },

    },
    {
      path: '/finance/employees',
      name: 'FinanceEmployee',
      component: FinanceEmployeePage,
      meta: { finance: true },

    },
    {
      path: '/finance/payment',
      name: 'FinancePayment',
      component: FinancePaymentPage,
      meta: { finance: true },

    },
    {
      path: '/login',
      name: 'Login',
      component: LoginPage,
      meta: { guest: true },
    },

  ],
})


router.beforeEach(async (to, from) => {
  const authStore = useAuthStore();

  await authStore.getUser();
  // console.log(authStore.user);

  if (authStore.user?.role === "finance" && to.meta.welcome) {
    return { name: "FinanceHome" };
  }
  if (authStore.user?.role === "finance" && to.meta.guest) {
    return { name: "FinanceHome" };
  }
  if (authStore.user && to.meta.welcome) {
    return { name: "FinanceHome" };
  }
  if (!authStore.user && to.meta.FinanceHome) {
    return { name: "Welcome" };
  }

});



export default router
