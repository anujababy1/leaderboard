<template>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div class="flex flex-col items-center h-screen gap-y-3.5 mt-32">
                <h2 class="text-2xl text-gray-900 font-bold md:text-4xl">
                    Leaderboard Application
                </h2>
                <p class="text-gray-600 text-center">
                    Track and showcase the top performers in our community.
                    Discover who's leading the way!
                </p>

                <router-link
                    :to="{ name: 'Leaderboard' }"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-full mt-4"
                >
                    Get Started
                </router-link>
            </div>
        </div>
    </div>
</template>
<script></script>
