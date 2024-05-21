<template>

 <div class="overlay"></div>
  <div class="div-presentation">
   
    <BackgroundImages/>

    <SearchBar/>

  </div> 
</template>

<script setup>
  import BackgroundImages from '../components/BackgroundImages.vue';
  import SearchBar from '../components/SearchBar.vue';
</script>

<style scoped>

  .div-presentation {
  align-items: center;
  display: flex;
  flex-direction: column;
  font-size: 40px;
  padding-top: 5%;
  color: white;
  position: relative; 
  }

.overlay {
  position: fixed;
    width: 100%;
  height: 100%;

background-image:
  linear-gradient(
    to bottom,
    hsla(0, 0%, 0%, 0) 0%,
    hsla(0, 0%, 0%, 0.013) 0.4%,
    hsla(0, 0%, 0%, 0.049) 1.6%,
    hsla(0, 0%, 0%, 0.104) 3.7%,
    hsla(0, 0%, 0%, 0.175) 6.6%,
    hsla(0, 0%, 0%, 0.259) 10.4%,
    hsla(0, 0%, 0%, 0.352) 15%,
    hsla(0, 0%, 0%, 0.45) 20.6%,
    hsla(0, 0%, 0%, 0.55) 27.1%,
    hsla(0, 0%, 0%, 0.648) 34.6%,
    hsla(0, 0%, 0%, 0.741) 43%,
    hsla(0, 0%, 0%, 0.825) 52.3%,
    hsla(0, 0%, 0%, 0.896) 62.7%,
    hsla(0, 0%, 0%, 0.951) 74.1%,
    hsla(0, 0%, 0%, 0.987) 86.5%,
    hsl(0, 0%, 0%) 100%
  );


    z-index: 1;
}


</style>
