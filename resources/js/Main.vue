<template>
 
   <div v-if="show==true" class="overlay">📽️</div>

    <HeaderDiv/>
    <main>
      <RouterView />
    </main>

</template>

<script setup>

  import {RouterView } from 'vue-router';
  
  import {ref} from 'vue'

  const show=ref(true);
  
  setTimeout(()=>{

    show.value=false;

  }, 1100);

  import HeaderDiv from './components/HeaderDiv.vue';


</script>

<style scoped>

.overlay{
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: black;
  margin-top:-10px;
  z-index: 4;
  justify-content: center;
  display: flex;
  align-items: center;
  font-size: 70px;
}

</style>