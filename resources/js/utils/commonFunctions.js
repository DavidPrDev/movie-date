
  export const imgValidator = (movie) => {

    const baseUrlImg = 'https://image.tmdb.org/t/p/w500';

    const image = movie.poster_path || movie.backdrop_path;

    const imageValidated=!image ? '/images/notFound.jpg' :  `${baseUrlImg}${image}`

    return imageValidated;

  };

  export const formatYear = (movieRelease) => {
    const movieSplit = movieRelease.split('-');
    return movieSplit[0] ? movieSplit[0] : 'Año no disponible';

  };

  export function formatRuntime(minutes) {
    const hours = Math.floor(minutes / 60);
    const mins = minutes % 60;
    return `${hours}h ${mins}m`;
  }

  export function formatDate(date) {
   
    if(!date)return 'No disponible';

    const options = { year: 'numeric', month: 'long', day: 'numeric' };

    return new Date(date).toLocaleDateString('es-ES', options);
  }