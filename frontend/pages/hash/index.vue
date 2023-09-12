<script setup lang="ts">
const { data: tags } = await useApiFetch('/tags')
</script>

<template>
  <div class="tag-cloud flex justify-center flex-wrap gap-2  max-w-sm mx-auto">
    <button class="tag px-2 py-1 rounded bg-gray-200 text-gray-700 text-sm hover:bg-gray-300 transition duration-200 ease-in-out"
        v-for="tag in tags"
        :key="tag.title"
        @click="$router.push(`/hash/${tag.title}`)">
      #{{ tag.title }}
    </button>
  </div>
</template>

<style scoped>

</style>