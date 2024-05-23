import {ref} from 'vue';
import state from '../states/globalState';
const apiKey = import.meta.env.VITE_API_KEY;

export default class TheMovieDbService{


    constructor(){
        this.movies=ref([])
        this.movie=ref({})
    }

    getMovies(){return this.movies;}

    getMovie(){return this.movie;}


    async fetchAll(){

        try{

            const response = await fetch(`https://api.themoviedb.org/3/search/movie?query=${state.movie}&api_key=${apiKey}`);

            const json = await response.json();
            
            this.movies.value = await json.results;

        }catch(error){

            console.log(error);

        }
    }
    async fetchOne(){

        try{

            const response = await fetch(`https://api.themoviedb.org/3/movie/${state.movieId}?api_key=${apiKey}&language=es-ES`);

            const json = await response.json();

            this.movie.value = await json;

        }catch(error){

            console.log(error);

        }
    }
}