<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <img src="/insta-logo.png" class="mx-auto pt-10 pb-8" width="200">
        <div class="flex text-center font-extrabold text-gray-500">
            Sign up to see photos and videos from your friends.
        </div>

        <PrimaryButton
            class="mt-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
        >
            Log in with Facebook
        </PrimaryButton>

        <div class="flex items-center py-3">
            <span class="flex-grow text-gray-400 border-t border-t-gray-500"></span>
            <span class="text-gray-400 px-3" >OR</span>
            <span class="flex-grow text-gray-400 border-t border-t-gray-500"></span>
        </div>

        <form @submit.prevent="submit">
            <div>
                <div class="mt-4">
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full bg-gray-50 text-sm"
                        v-model="form.email"
                        required
                        autocomplete="username"
                        placeholder="Mobile Number or Email"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full bg-gray-50 text-sm "
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Full Name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>



            <div class="mt-4">
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full bg-gray-50  text-sm "
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                    placeholder="Password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full bg-gray-50 text-sm"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="Password Confirm"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>
            <PrimaryButton
                class="mt-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Sign up
            </PrimaryButton>
            <div class="text-center text-gray-500 pt-4">
                By signing up, you agree on Terms, Data Policy and Cookies Policy
            </div>
        </form>

        <!-- Login Link -->
        <div class="text-center text-sm">
            Already have an account?
            <Link :href="route('login')" class="text-blue-500 font-semibold hover:underline">
                Log in
            </Link>
        </div>
    </GuestLayout>

</template>
