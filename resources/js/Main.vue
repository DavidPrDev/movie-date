<template>
  
  <h1>Movie date!</h1>

  <nav>
    <RouterLink to="/">Inicio</RouterLink>
    <RouterLink to="/about">Tus peliculas</RouterLink>
  </nav>

  <main>
    <RouterView />
  </main>

</template>

<script setup>
import { RouterLink,RouterView } from 'vue-router';

</script>

<style scoped>

</style>