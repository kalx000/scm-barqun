import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import Login from '../views/Login.vue'
import ProductView from '../views/ProductView.vue'
import Warehouse from '../views/Warehouse.vue'
import SupplierView from '../views/SupplierView.vue'
import CustomerView from '../views/CustomerView.vue'
import OrderView from '../views/OrderView.vue'
import UserView from '../views/UserView.vue'

Vue.use(VueRouter)

const routes = [
  {
    path: '/home',
    name: 'dashboard',
    component: HomeView
  },
  {
    path: '/',
    name: 'login',
    component: Login
  },
  {
    path: '/product',
    name: 'product',
    component: ProductView
  },
  {
    path: '/warehouse',
    name: 'warehouse',
    component: Warehouse
  },
  {
    path: '/supplier',
    name: 'supplier',
    component: SupplierView
  },
  {
    path: '/customers',
    name: 'customer',
    component: CustomerView
  },
  {
    path: '/order',
    name: 'order',
    component: OrderView
  },
  {
    path: '/user',
    name: 'user',
    component: UserView
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  // base: process.env.BASE_URL,
  routes
})

export default router
