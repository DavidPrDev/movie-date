<template>
<!--     <h2 class="title">Detalles de la pelicula</h2>
 -->
      <div v-if="lodaded==true" class="row">
        <img
        class="img-movie"
        :src="imgValidator(movie)"
        :alt="'image of the ' + movie.original_title + ' movie'"
        width="240"
        height="350"
      />
        <div class="col">
          
            <h3 class="title-movie">{{ movie.title }} <span class="votes">⭐ {{movie.vote_average}}</span></h3>
            <p>{{ movie.overview }}</p>
            <p>Estreno : <span class="bold">{{ formatDate(movie.release_date) }}</span></p>
            <p>Duracion : <span class="bold">{{ formatRuntime(movie.runtime) }}</span></p>
          
          <div class="row-btn">

            <button class="btn-no-decoration btn-add-fav">Añadir a favoritos</button>
            <button class="btn-no-decoration btn-add-date" >Añadir a tu cartelera</button>

          </div>
          

         </div>
        
      </div>

</template>

<script setup>

  import TheMovieDbService from '../services/TheMovieDbService';
  import {onMounted} from 'vue'
  import { imgValidator,formatRuntime,formatDate  } from '../utils/commonFunctions';
  import {ref} from 'vue'

  const service=new TheMovieDbService;

  const movie=service.getMovie();
  const lodaded=ref(false)

  onMounted( async()=>{
    try{

    await service.fetchOne()

    }catch(error){
      console.log(error);
    }finally{
      lodaded.value=true
      console.log("data pelicula", movie)
      
    }
  })


</script>

<style scoped>

  .row{
    flex-direction: row;
    display: flex;
    width: 80%;
    margin: auto;
    background-color: #3032365f;
    padding: 10px;
    border-radius: 15px;
    margin-top: 3%;
  }
  .bold{
    font-weight: bold
  }
  .row-btn{
    flex-direction: row;
    display: flex;
    justify-content: center;
   }

  .col{
    flex-direction: column;
    margin-left: 10px;
    color: whitesmoke;
    display: flex;
  }
  .title{
    text-align: center;
    color: whitesmoke;
  }

  .img-movie{
    border-radius:10px ;
    margin: 10px;
  }
  .votes{
    font-size: 15px;
  }

  .btn-no-decoration{
    border: none;
    height: auto;
    width: auto;
    padding: 15px;
    margin-left: 20px;
    border-radius: 7px;
    font-weight: bold;
    cursor: pointer;
    
  }
  .btn-add-fav{
    background-color: aqua;
  }

  .btn-add-date{
    background-color: yellow;
  }

  @media screen and (max-width: 755px) {
  
    .row{
    flex-direction: column;
    }
    .img-movie{
    margin:auto ;
    margin-top: 10px;
    }
    .title-movie{
    text-align: center;
    font-size: 30px;
    margin: 0;
  }

  .btn-no-decoration{
    padding: 7px;
    margin: 5px;
  }

}
</style>