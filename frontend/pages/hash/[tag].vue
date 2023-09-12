<script setup lang="ts">
const  { tag }   = useRoute().params
const { data: posts_for_tag } = await useApiFetch('/tags/' + tag)
</script>

<template>
   <div class="grid h-screen place-items-center">
    <div v-for="post in posts_for_tag">
      <post :post = "post"/>
    </div>
  </div>
</template>

<style scoped>

</style>