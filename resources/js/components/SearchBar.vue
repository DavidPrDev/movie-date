<template>
    <div class="search-container">
      <h1 class="title">Movie <span class="date">date</span></h1>
      <p>Organiza tus peliculas en un formato agenda</p>
      <div class="search">
        <input v-model="movie" type="text" class="no-decoration input-search"  name="inputSearch" placeholder="Busca tu proxima peli">
        <button class="no-decoration btn-search" @click="handleSubmit()">🔍</button>
      </div>
    </div>
    
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import state from '../states/globalState';

const router = useRouter();

const movie = ref('');

const handleSubmit = () => {
  state.movie = movie.value;
  router.push({ name: 'movie'});

};
</script>

<style scoped>

    .search-container {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    z-index: 3;
    padding:20px;
    border-radius:10px;
    font-weight: bold;

    }

    .title{
    margin-bottom: 0;
    white-space: nowrap;
    }

    p{
      margin-top: 5px;
      margin-bottom: 15px;
    }
    .no-decoration{
      border:none;
      background-color: transparent;
    }

    .search{
      border: 2px solid rgba(255, 255, 255, 0.288);
      display: flex;
      align-items: center;
      width: 70%;
      height: 40px;
      font-size: 20px;
      border-radius: 15px;
      background-color: #1E2021;
    }

    .input-search{
      width: 100%;
      color:white ;
      font-size: 20px;
      padding-left: 10px;
    }

    .btn-search{
      margin-left: auto;
      font-size: 30px;
      margin-bottom: 4px;
      cursor: pointer;
    }

    input:focus {
    outline: none; 
    }
    .date {
    color:rgb(216, 216, 49)
    }
</style>