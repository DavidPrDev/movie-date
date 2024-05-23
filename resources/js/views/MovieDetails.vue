<template>
    <h2>detalles pelicula</h2>

    <div>
      {{ movie.original_title }}
      <img
        class="img-movie"
        :src="imgValidator(movie)"
        :alt="'image the ' + movie.original_title + ' movie'"
        width="190"
        height="270"
      />
    </div>
    
</template>

<script setup>
  import state from '../states/globalState';
  import TheMovieDbService from '../services/TheMovieDbService';
  import {onMounted} from 'vue'

  const service=new TheMovieDbService;

  const movie=service.getMovie();

  onMounted( async()=>{
    try{

    await service.fetchOne()

    }catch(error){
      console.log(error);
    }
  })


</script>

<style scoped>

</style>