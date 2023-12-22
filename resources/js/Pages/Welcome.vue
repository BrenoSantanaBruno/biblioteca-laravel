<script setup>
import { Head, Link } from '@inertiajs/vue3';
import axios from 'axios';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

const route = (name) => `/` + name;

async function iniciarLoginOAuth2() {
    try {
        const response = await axios.get('/oauth/login'); // Redireciona para o provedor OAuth
    } catch (error) {
        console.log('Erro ao iniciar login OAuth2:', error);
    }
}

async function tratarCallback(code) {
    try {
        const response = await axios.post('/oauth/auth/callback', {
            code,
        });
        // Atualize o estado da aplicação de acordo com o resultado da autenticação
    } catch (error) {
        console.log('Erro ao tratar o callback OAuth2:', error);
    }
}
</script>

<template>
    <Head title="Bem-vindo ao Laravel" />

    <div class="bg-gradient-to-r from-blue-200 to-blue-300 min-h-screen flex items-center justify-center">
        <div class="container mx-auto p-4 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-8">Bem-vindo ao Laravel</h1>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <template v-if="canLogin">
                    <template v-if="$page.props.auth.user">
                        <Link :href="route('dashboard')"
                              class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700">
                            Dashboard
                        </Link>
                    </template>
                    <template v-else>
                        <Link :href="route('login')"
                              class="px-4 py-2 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-700">
                            Logar
                        </Link>

                        <Link v-if="canRegister" :href="route('register')"
                              class="px-4 py-2 bg-purple-500 text-white font-semibold rounded-lg shadow-md hover:bg-purple-700">
                            Registrar
                        </Link>

                        <button @click="iniciarLoginOAuth2"
                                class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700">
                            Login com OAuth2
                        </button>
                    </template>
                </template>
            </div>
        </div>

        <div class="text-center mt-6 text-gray-600">
            Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
        </div>
    </div>
</template>

<style scoped>
/* Estilos personalizados, se necessário */
</style>
