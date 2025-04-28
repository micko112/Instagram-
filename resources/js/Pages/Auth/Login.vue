<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <img src="/insta-logo.png" class="mx-auto pt-10 pb-8" width="200">

        <form @submit.prevent="submit">
            <div>


                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">


                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    placeholder="Password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <PrimaryButton
                class="mt-4"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Log in
            </PrimaryButton>
            <div class="flex items-center mt-4">
                <span class="flex-grow border-t border-gray-400"></span>
                <span class="mx-2 text-gray-500 text-sm font-semibold">OR</span>
                <span class="flex-grow border-t border-gray-400"></span>
            </div>
            <div class="flex   justify-center pt-4 cursor-pointer">

                <div class="text-blue-600">Login with Facebook</div>

            </div>

            <div class="mt-4 flex items-center justify-center">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Forgot your password?
                </Link>
            </div>
            <div class="mt-4 flex items-center justify-center">
                Don't have an account?
                <Link
                    v-if="canResetPassword"
                    :href="route('register')"
                    class="rounded-md text-sm text-blue-600 underline pl-2 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Sign up
                </Link>
            </div>
        </form>
    </GuestLayout>
</template>
