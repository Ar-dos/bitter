<script setup lang="ts">
const { user } = useRoute().params
const { data: posts_of_user } = await useApiFetch('/user/' + user)
</script>

<template>
<div>
  <div class="grid h-screen place-items-center">
    <div v-for="post in posts_of_user">
      <post v-if="post.user" :post = "post"/>
    </div>
  </div>
</div>
</template>

<style scoped>

</style>