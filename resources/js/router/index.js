import { createRouter, createWebHistory } from 'vue-router'

import HomeView from '../views/HomeView.vue';
import Movie from '../views/Movie.vue'
import MovieDetails from '../views/MovieDetails.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/movie',
      name: 'movie',
      component: Movie
    },
    {
      path: '/movie-detail',
      name: 'movie-detail',
      component: MovieDetails
    }
  ]
})

export default router
