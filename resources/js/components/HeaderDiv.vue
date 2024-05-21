<template>
    <div class="header">
        
        <h1 class="title">MD 📽️</h1>

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
    width: 90%;
    background-color: #303236;
    border-radius:10px ;
    top:10px;
    height:50px;
    margin-top: 10px
    
    
    }
    .title{
        margin-left: 5%;
    }

</style>