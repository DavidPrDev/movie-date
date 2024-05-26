<template>
 <!--  <h1>Resultados búsqueda:</h1> -->
  <div v-if="movies.length===0 && loading==false">
    <h1>Sin resultados</h1>
  </div>
  <div v-else-if="movies.length>0 && loading==false" class="container-images">

    <button class="btn-ford" @click="backguardPosition()">

      <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512">
        <path fill="currentColor" d="M321.94 98L158.82 237.78a24 24 0 0 0 0 36.44L321.94 414c15.57 13.34 39.62 2.28 39.62-18.22v-279.6c0-20.5-24.05-31.56-39.62-18.18"></path>
      </svg>
    </button>
    <button class="btn-back" @click="forwardPosition()">

      <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512">
        <path fill="currentColor" d="M321.94 98L158.82 237.78a24 24 0 0 0 0 36.44L321.94 414c15.57 13.34 39.62 2.28 39.62-18.22v-279.6c0-20.5-24.05-31.56-39.62-18.18"></path>
      </svg>

    </button>
  <div class="container-movies">
    <div
      class="container-movie"
      v-for="movie in movies"
      :key="movie.id"
      @click="viewMovie(movie.id)"
      :style="{ transform: `translateX(${position}px)` }"
    >
      <img
        class="img-movie"
        :src="imgValidator(movie)"
        :alt="'image the ' + movie.original_title + ' movie'"
        width="210"
        height="290"
      />
      <div class="container-body-movie">
        <h4>{{ movie.title }} ({{ formatYear(movie.release_date) }})</h4>
      </div>
    </div>
  </div>
  </div>
  
</template>

<script setup>

import { ref, onUnmounted,onMounted } from 'vue';
import state from '../states/globalState';
import { useRouter } from 'vue-router';
import TheMovieDbService from '../services/TheMovieDbService';
import { imgValidator,formatYear} from '../utils/commonFunctions';


const position = ref(0);
const router = useRouter();
const loading = ref(true);

const service=new TheMovieDbService;
const movies=service.getMovies();

  onMounted(async()=>{

      try{

        await service.fetchAll()

      }finally{

        loading.value=false

        if(movies.value.length===1){viewMovie(movies.value[0].id)};

      }

  })


  const viewMovie = (movieId) => {
    state.movieId = movieId;
    router.push({ name: 'movie-detail' });
  }; 

  const forwardPosition = () => {
    if (position.value <= -200 * (movies.value.length +1)) return;
    position.value -= 215;
  };

  const backguardPosition = () => {
    if (position.value >= 0) return;
    position.value += 215;
  };

  onUnmounted(() => {
    state.movie = '';
  });
</script>

<style scoped>
  h1 {
    margin-bottom: 0;
    text-align: center;
    color: white;
  }
  .container-images{
    margin-top: 8%;
  }
  .container-movies {
    display: flex;
    color: white;
    margin-left: 10%;
    margin-right: 10%;
    overflow-x: hidden;
    margin-top: 50px;
  }
  .container-movie {
    display: flex;
    margin-bottom: 20px;
    border: 2px solid #303236;
    border-radius: 8px;
    flex-direction: column;
    margin: 10px;
    margin-right: 25px;
    transition: transform 0.3s ease;
    position: relative;
  }
  .img-movie {
    border-radius: 8px;
  }
  h4 {
    margin: auto;
    position: absolute;
    bottom: 0px;
    background-color: rgba(0, 0, 0, 0.638);
    width: 100%;
    padding: 5px;
    box-sizing: border-box;
    border-radius: 0px 0px 8px 8px;
  }
  .btn-ford,
  .btn-back {
    border: none;
    background-color: transparent;
    height: 100px;
    width: 40px;
    font-size: 60px;
    border-radius: 10px;
    position: absolute;
    z-index: 3;
    cursor: pointer;
    color: white;
  }
  .btn-ford {
    left: 30px;
    top: 42%;
  }
  .btn-back {
    right: 30px;
    top: 39.5%;
    transform: rotate(180deg);
  }
  @media screen and (max-width: 600px) {
  .btn-ford{
    left: 0;
    padding-left: 0;
  }
  .btn-back{
    right: 0;
    padding-right: 0;
  }
  .btn-ford, .btn-back{
    font-size: 70px;
  }

}
</style>
