<script setup lang="ts">

import {useAuthStore} from "~/stores/useAuthStore";

const auth = useAuthStore();

async function logout() {
  await auth.logout();
}

</script>

<template>
  <div class="flex flex-col items-center justify-center mt-32">
    <div class="flex flex-col">
      <!-- Navbar -->
      <nav class="flex py-4 bg-white/80
            backdrop-blur-md shadow-md w-full
            fixed top-0 left-0 right-0 z-10">
        <div class="container">
        <!-- Logo Container -->
        <div class="flex items-center flex-shrink-0 space-x-8">
          <!-- Logo -->
          <NuxtLink to="/" class="cursor-pointer pl-8">
            <h3 class="text-2xl font-medium text-blue-500">
              <img class="h-10 object-cover"
                   src="/Bitter_Logo.svg" alt="Bitter Logo">
            </h3>
          </NuxtLink>
<!--        </div>-->

<!--        &lt;!&ndash; Links Section &ndash;&gt;-->
<!--        <div class="items-center hidden space-x-8 lg:flex">-->
          <NuxtLink to="/" class="flex text-gray-600 hover:text-blue-500
                    cursor-pointer transition-colors duration-300">
            Home
          </NuxtLink>

          <NuxtLink v-if="auth.isLoggedIn" to="/feed" class="flex text-gray-600 hover:text-blue-500
                    cursor-pointer transition-colors duration-300">
            Feed
          </NuxtLink>

          <NuxtLink to="/hash" class="flex text-gray-600 hover:text-blue-500
                    cursor-pointer transition-colors duration-300">
            Hashtags
          </NuxtLink>

          <NuxtLink v-if="auth.isLoggedIn" to="/add" class="flex text-gray-600 hover:text-blue-500
                    cursor-pointer transition-colors duration-300">
            Add
          </NuxtLink>

        </div>
        </div>

        <!-- Icon Menu Section -->
        <div class="flex items-center space-x-5 pr-8">
          <button v-if="auth.isLoggedIn"  @click="$router.push(`/${auth.user.name}`)" class="flex text-gray-600 hover:text-blue-500
                    cursor-pointer transition-colors duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" fill="currentColor" class="bi bi-person" viewBox="2 0 16 16">
              <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
            </svg>
            {{auth.user.name}}
          </button>
          <NuxtLink v-else to="/register" class="flex text-gray-600 hover:text-blue-500
                    cursor-pointer transition-colors duration-300">
            <svg class="fill-current h-5 w-5 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24"
                 viewBox="0 0 24 24">
              <path
                  d="M12 0L11.34 .03L15.15 3.84L16.5 2.5C19.75 4.07 22.09 7.24 22.45 11H23.95C23.44 4.84 18.29 0 12 0M12 4C10.07 4 8.5 5.57 8.5 7.5C8.5 9.43 10.07 11 12 11C13.93 11 15.5 9.43 15.5 7.5C15.5 5.57 13.93 4 12 4M12 6C12.83 6 13.5 6.67 13.5 7.5C13.5 8.33 12.83 9 12 9C11.17 9 10.5 8.33 10.5 7.5C10.5 6.67 11.17 6 12 6M.05 13C.56 19.16 5.71 24 12 24L12.66 23.97L8.85 20.16L7.5 21.5C4.25 19.94 1.91 16.76 1.55 13H.05M12 13C8.13 13 5 14.57 5 16.5V18H19V16.5C19 14.57 15.87 13 12 13M12 15C14.11 15 15.61 15.53 16.39 16H7.61C8.39 15.53 9.89 15 12 15Z" />
            </svg>
            Register
          </Nuxtlink>

          <!-- Login -->
          <button v-if="auth.isLoggedIn" @click="logout" class="flex text-gray-600
                    hover:text-blue-500
                    cursor-pointer transition-colors duration-300
                    font-semibold">
            <svg class="fill-current h-5 w-5 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24"
                 viewBox="0 0 24 24">
              <path
                  d="M10,17V14H3V10H10V7L15,12L10,17M10,2H19A2,2 0 0,1 21,4V20A2,2 0 0,1 19,22H10A2,2 0 0,1 8,20V18H10V20H19V4H10V6H8V4A2,2 0 0,1 10,2Z" />
            </svg>
            Logout
          </button>
          <button v-else @click="$router.push(`/login`)" class="flex text-gray-600
                    hover:text-blue-500
                    cursor-pointer transition-colors duration-300
                    font-semibold">
            <svg class="fill-current h-5 w-5 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="24" height="24"
                 viewBox="0 0 24 24">
              <path
                  d="M10,17V14H3V10H10V7L15,12L10,17M10,2H19A2,2 0 0,1 21,4V20A2,2 0 0,1 19,22H10A2,2 0 0,1 8,20V18H10V20H19V4H10V6H8V4A2,2 0 0,1 10,2Z" />
            </svg>
            Login
          </button>
        </div>
      </nav>
    </div>
  </div>
<!--  {{auth.user}}-->
<!--  {{auth.followings}}-->
  <slot />
</template>

<style scoped>

</style>