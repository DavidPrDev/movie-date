<template>
    <nav>
      <RouterLink to="/" class="link">Inicio</RouterLink>
    </nav>

</template>

<script setup>
    import { RouterLink} from 'vue-router';
</script>

<style scoped>

  nav{
    display: flex;
    margin-left:auto;
    margin-right: 5%;
    gap:15px;
  }
  .link{
    text-decoration: none;
    color: white;
  }
</style>