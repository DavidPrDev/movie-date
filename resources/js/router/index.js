import { createRouter, createWebHistory } from 'vue-router'

import HomeView from '../views/HomeView.vue';
import Movie from '../views/Movie.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/movie/:movie',
      name: 'movie',
      component: Movie
    }
  ]
})

export default router
