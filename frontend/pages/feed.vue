<script setup lang="ts">
const { data: posts } = await useApiFetch('/feed')
console.log(posts);
</script>

<template>
  <div>
    <div class="grid h-screen place-items-center">
      <div v-for="post in posts">
        <post v-if="post.user" :post = "post"/>
      </div>
    </div>
  </div>
</template>

<style scoped>

</style>