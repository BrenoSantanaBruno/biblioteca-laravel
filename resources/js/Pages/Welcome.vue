<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

const route = (name) => `#${name}`; // Substitua com sua função de roteamento
</script>

<template>
    <Head title="Bem-vindo ao Laravel" />

    <div class="bg-gradient-to-r from-blue-200 to-blue-300 min-h-screen flex items-center justify-center">
        <div class="container mx-auto p-4 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-8">Bem-vindo ao Laravel</h1>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <template v-if="canLogin">
                    <template v-if="$page.props.auth.user">
                        <Link
                            :href="route('dashboard')"
                            class="px-6 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
                        >Dashboard</Link>
                    </template>
                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="px-6 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700"
                        >Login</Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="px-6 py-2 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-gray-100"
                        >Registrar</Link>
                    </template>
                </template>

                <!-- Substitua 'oauth.login' pelo caminho correto da sua autenticação OAuth2 -->
                <a href="{{ route('oauth.login') }}"
                   class="px-6 py-2 border border-transparent text-base font-medium rounded-md text-white bg-green-500 hover:bg-green-600">Login com OAuth2</a>
            </div>
        </div>
    </div>

    <div class="text-center mt-6">
        Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
    </div>
</template>

<style scoped>
</style>
