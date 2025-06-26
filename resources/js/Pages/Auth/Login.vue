<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
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
        <Head title="Log in" />
            <div class="">
                <div class=" max-w-md">
                    <div class="text-center mb-8 lg:hidden">
                        <ApplicationLogo class="h-16 w-auto mx-auto mb-4" />
                        <h1 class="text-2xl font-bold text-gray-900">Sign in to your account</h1>
                    </div>

                    <div class="mb-6 text-center">
                        <p class="text-sm text-gray-600">
                            Not a member?
                            <Link href="/register" class="font-medium text-indigo-600 hover:text-indigo-500">
                                Start a free trial
                            </Link>
                        </p>
                    </div>

                    <div v-if="status" class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm text-center">
                        {{ status }}
                    </div>

                    <form @submit.prevent="submit" class="space-y-6 bg-white p-8 rounded-lg shadow-sm">
                        <div>
                            <InputLabel for="email" value="Email address" />
                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                            />
                            <InputError class="mt-1 text-sm text-red-600" :message="form.errors.email" />
                        </div>

                        <div>
                            <InputLabel for="password" value="Password" />
                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />
                            <InputError class="mt-1 text-sm text-red-600" :message="form.errors.password" />
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <Checkbox name="remember" v-model:checked="form.remember" />
                                <span class="ms-2 text-sm text-gray-600">Remember me</span>
                            </div>
                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="text-sm text-indigo-600 hover:text-indigo-500 hover:underline"
                            >
                                Forgot password?
                            </Link>
                        </div>

                        <div>
                            <PrimaryButton
                                class="w-full justify-center py-2 px-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow-sm transition"
                                :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                                :disabled="form.processing"
                            >
                                Sign in
                            </PrimaryButton>
                        </div>
                    </form>

                    <div class="mt-8">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center">
                                <span class="px-2 bg-white text-sm text-gray-500">Or continue with</span>
                            </div>
                        </div>

                        <div class="mt-6 grid grid-cols-2 gap-3">
                            <a href="/auth/google" class="flex items-center justify-center gap-2 px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50 transition">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                                </svg>
                                <span class="text-sm font-medium">Google</span>
                            </a>
                            <a href="/auth/github" class="flex items-center justify-center gap-2 px-4 py-2 bg-gray-800 hover:bg-gray-900 text-white rounded-md transition">
                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                                </svg>
                                <span class="text-sm font-medium">GitHub</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
    </GuestLayout>
</template>
