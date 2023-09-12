<script lang="ts" setup>

  import {useAuthStore} from "~/stores/useAuthStore";
  import {definePageMeta} from "#imports";

  definePageMeta({
    middleware:['auth']
  });

  const auth = useAuthStore();

  const form = ref({
    message: "",
  });

  async function message() {

  const {error} = await auth.message({body: document.getElementById("message").value, user_id: auth.user.id});

  console.log(error);

  if(!error.value){
    navigateTo('/');
  }

}


</script>

<template>
  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <div class="bg-white px-4 shadow sm:rounded-lg sm:px-10">
      <form @submit.prevent="message">
          <label for="message" class="block text-sm font-medium leading-5 text-gray-700">Message</label>
          <div class="mt-1 rounded-md shadow-sm">
            <textarea id="message" style="resize: none;" rows="6" maxlength="280" name="message" type="text" required="" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"></textarea>
          </div>

        <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
              Send
            </button>
          </span>
        </div>
      </form>

    </div>
  </div>
<!--  <div>-->
<!--    <form @submit.prevent="message">-->
<!--      <div>-->
<!--        <label>Message: </label>-->
<!--        <textarea-->
<!--            type="text"-->
<!--            v-model="form.message"-->
<!--            class="form-control"-->
<!--            placeholder="message"-->
<!--            required="required"-->
<!--        ></textarea>-->
<!--      </div>-->
<!--      <button type="submit">Submit</button>-->
<!--    </form>-->
<!--  </div>-->
</template>

<style scoped>

</style>