<template>
  <div class="container-results"></div>
  <h1>about</h1>
  <div v-for="movie in movies" :key="movie.id">

    <p>{{ movie.original_title }}</p>
  
  </div>


</template>

<script setup>
import { useRoute } from 'vue-router'
import {ref} from 'vue'

const route = useRoute()

const movies=ref("");
const apiKey= import.meta.env.VITE_API_KEY;

fetch("https://api.themoviedb.org/3/search/movie?query="+route.params.movie+"&api_key="+apiKey+"&language=es-ES")
.then(response=>response.json())
.then(data=>movies.value=data.results)
.then(data=>console.log(data))






</script>

<style scoped>
.container-results{
  overflow-y:scroll;

}
</style>