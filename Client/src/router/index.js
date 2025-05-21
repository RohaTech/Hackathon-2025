import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/FinanceHomeView.vue'
import FinanceHomeView from '../views/FinanceHomeView.vue'
import WelcomePage from '@/views/WelcomePage.vue'
import FinanceEmployeePage from '@/views/Finance/FinanceEmployeePage.vue'
import FinancePaymentPage from '@/views/Finance/FinancePaymentPage.vue'
import LoginPage from '@/views/Auth/LoginPage.vue'
import { useAuthStore } from '@/stores/auth'
import HeadFinanceHomeView from '@/views/Head Finance/HeadFinanceHomeView.vue'
import HeadFinancePayrollHistory from '@/views/Head Finance/HeadFinancePayrollHistory.vue'
import HeadFinanceDashboard from '@/views/Head Finance/HeadFinanceDashboard.vue'
import HeadFinanceAllowance from '@/views/Head Finance/HeadFinanceAllowance.vue'
import FinanceAllowance from '@/views/Finance/FinanceAllowance.vue'



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
      path: '/finance/allowance',
      name: 'FinanceAllowance',
      component: FinanceAllowance,
      meta: { finance: true },

    },
    {
      path: '/head-finance',
      name: 'HeadFinanceHome',
      component: HeadFinanceHomeView,
      meta: { head_finance: true },

    },
    {
      path: '/head-finance/open-request',
      name: 'HeadFinancePayrollHistory',
      component: HeadFinancePayrollHistory,
      meta: { head_finance: true },

    },
    {
      path: '/head-finance/dashboard',
      name: 'HeadFinanceDashboard',
      component: HeadFinanceDashboard,
      meta: { head_finance: true },

    },
    {
      path: '/head-finance/allowance',
      name: 'HeadFinanceAllowance',
      component: HeadFinanceAllowance,
      meta: { head_finance: true },

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

  if (authStore.user?.role === "head_finance" && to.meta.welcome) {
    return { name: "HeadFinanceHome" };
  }
  if (authStore.user?.role === "head_finance" && to.meta.guest) {
    return { name: "HeadFinanceHome" };
  }
  if (authStore.user?.role === "head_finance" && to.meta.finance) {
    return { name: "HeadFinanceHome" };
  }


  if (authStore.user?.role === "finance" && to.meta.welcome) {
    return { name: "FinanceHome" };
  }
  if (authStore.user?.role === "finance" && to.meta.guest) {
    return { name: "FinanceHome" };
  }
  if (authStore.user?.role === "finance" && to.meta.head_finance) {
    return { name: "FinanceHome" };
  }


  if (authStore.user && to.meta.welcome) {
    return { name: "FinanceHome" };
  }
  if (!authStore.user && to.meta.finance) {
    return { name: "Welcome" };
  }
  if (!authStore.user && to.meta.head_finance) {
    return { name: "Welcome" };
  }

});



export default router
