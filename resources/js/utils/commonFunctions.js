
  export const imgValidator = movie => {

    const baseUrlImg = 'https://image.tmdb.org/t/p/w500';

    const image = movie.poster_path || movie.backdrop_path;
    return image ? `${baseUrlImg}${image}` : '/images/notFound.jpg';
  };


  export const formatDate = movieRelease => {
    const movieSplit = movieRelease.split('-');
    return movieSplit[0] ? movieSplit[0] : 'Fecha no disponible';

  };