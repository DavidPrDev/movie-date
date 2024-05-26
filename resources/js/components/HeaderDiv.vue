<template>
    <div class="header">
        
        <h1 class="title">Movie <span class="date">Date</span> 📽️</h1>

        <MenuNav />
        
    </div>
</template>

<script setup>

    import MenuNav from './MenuNav.vue'

</script>

<style scoped>
    .header {
    display: flex;
    flex-direction: row;
    align-items: center;
    margin: auto;
    color: whitesmoke;
    width: 100%;
    background-color: #30323690;
    border-radius:0px ;
    top:10px;
    height:60px;
    
    
    }
    .title{
        margin-left: 5%;
    }
    .date {

     color:rgb(216, 216, 49)
    }

</style>