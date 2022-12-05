import { createRouter, createWebHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';


const routes: Array<RouteRecordRaw> = [
  {
    path: '',
    redirect: '/',
    component : () => import('../views/HomePage.vue')
  },
  {
  path: '/',
  component : () => import('../views/HomePage.vue')
  },
  
  {
    path: '/products',
    component: () =>
    import('../views/productMgr.vue')
  },
  {
  path: '/storefront',
  component: () => import('../views/salesFront.vue')
  },
  {
    path: '/inventory',
    component: () =>
    import('../views/inventoryPage.vue')
  },
  {
    path: '/customers',
    component: () =>
    import('../views/customersMgr.vue')
  },


  {
    path: '/signup',
    component: () =>
    import('../views/Signup.vue')
  },

  {
    path: '/employees',
    component: () =>
    import('../views/employeesPage.vue')
  },


  {
    path: '/system_settings',
    component: () =>
    import('../views/systemConfig.vue')
  },

  
  {
    path: '/profile',
    component: () =>
    import('../views/myProfile.vue')
  }


  /* {
    path: '/login',
    component: () =>
    import('../views/Login.vue')
  },
  {
    path: '/signUp',
    component: () =>
    import('../views/Signup.vue')
  },
 */
]

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes
})

export default router
