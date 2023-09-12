import {defineStore} from "pinia";

type User = {
    id: number;
    name: string;
    email: string;
}

type Credentials = {
    email: string;
    password: string;
}

type RegistrationInfo = {
    name: string;
    email: string;
    password: string;
    password_confirmation: string;
}

type MessageInfo = {
    body: string;
    user_id: number;
}

type Following = {
  following:  string[];
}

type FollowInfo = {
    following_user_id: number;
    followed_user_id: number;
};

export const useAuthStore = defineStore('auth', () => {
    const user = ref<User | null>(null);

    const followings = ref<Following | null>(null);

    const isLoggedIn = computed(()=> !!user.value)

    async function logout() {
        await useApiFetch('/logout',{method: "POST"});
        user.value = null;
        followings.value = null;
        navigateTo('/login');
    }

    async function fetchFollowings(){

        let url = '/user/ /followings';
        if (user.value)
            url = '/user/' + user.value.name + '/followings'

        const {data} =  await useApiFetch(url);

        followings.value = data.value as Following;
    }

    async function fetchUser(){
        const {data} = await useApiFetch('/user');


        user.value = data.value as User;
    }

    async function login(credentials: Credentials) {

        await useApiFetch('/csrf-cookie');

        const login =  await useApiFetch('/login', {method: 'POST',
            body: credentials});

        await fetchUser();
        await fetchFollowings();

        return login;
    }

    async function register(info: RegistrationInfo) {

        await useApiFetch('/csrf-cookie');

        const register =  await useApiFetch('/register', {method: 'POST',
            body: info});

        await fetchUser();
        await fetchFollowings();

        return register;
    }

    async function message(messinfo: MessageInfo) {

        await useApiFetch('/csrf-cookie');

        const message =  await useApiFetch('/posts', {method: 'POST',
            body: messinfo});


        return message;
    }

    async function follow(followInfo: FollowInfo) {

        await useApiFetch('/csrf-cookie');

        const follow =  await useApiFetch('/follows', {method: 'POST',
            body: followInfo});

        return follow;
    }

    async function unfollow(followInfo: FollowInfo) {

        await useApiFetch('/csrf-cookie');

        const unfollow =
            await useApiFetch('/follows',
                {method: 'DELETE',
            body: followInfo});

        return unfollow;
    }

    return { user, login, isLoggedIn, fetchUser, logout , register, message, followings, fetchFollowings, follow, unfollow}
})