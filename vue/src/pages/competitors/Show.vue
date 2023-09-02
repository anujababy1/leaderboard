<template>
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-4xl bg-white w-full rounded-lg shadow-xl">
            <div class="p-4 border-b">
                <h2 class="text-2xl">User Information</h2>
            </div>
            <div v-if="loader">
                <div
                    class="md:grid md:grid-cols-1 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                >
                    <p class="text-center">
                        <svg
                            aria-hidden="true"
                            role="status"
                            class="inline mr-3 w-4 h-4 text-violet-700 animate-spin"
                            viewBox="0 0 100 101"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="#E5E7EB"
                            ></path>
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentColor"
                            ></path>
                        </svg>
                        Loading ...
                    </p>
                </div>
            </div>
            <div v-else-if="error">
                <div
                    class="md:grid md:grid-cols-1 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                >
                    <p>{{ error }}</p>
                </div>
            </div>
            <div v-else>
                <div
                    class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                >
                    <p class="text-gray-600">Name</p>
                    <p>{{ competitor.name }}</p>
                </div>
                <div
                    class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                >
                    <p class="text-gray-600">Age</p>
                    <p>{{ competitor.age }}</p>
                </div>
                <div
                    class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                >
                    <p class="text-gray-600">Address</p>
                    <p>{{ competitor.address }}</p>
                </div>
                <div
                    class="md:grid md:grid-cols-2 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
                >
                    <p class="text-gray-600">Points</p>
                    <p>{{ competitor.points }}</p>
                </div>
            </div>
            <div
                class="md:grid md:grid-cols-1 hover:bg-gray-50 md:space-y-0 space-y-1 p-4 border-b"
            >
                <router-link
                    :to="{ name: 'Leaderboard' }"
                    class="w-20 text-center bg-neutral-600 text-white px-4 py-2 rounded-md hover:bg-neutral-700 focus:outline-none focus:ring focus:ring-neutral-500"
                >
                    Back
                </router-link>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ["id"],
    data() {
        return {
            loader: false,
            error: "",
        };
    },
    created() {
        if (this.id) {
            this.fetchCompetitor();
        }
    },

    computed: {
        competitor() {
            return this.$store.state.competitor;
        },
    },
    methods: {
        async fetchCompetitor() {
            const self = this;
            self.loader = true;
            const resp = await self.$store.dispatch("showCompetitors", {
                id: this.id,
            });
            if (!resp.status) {
                self.error =
                    resp.data.response.data.error ||
                    resp.data.response.data.message ||
                    "An error occurred while processing your request. Please try again later";
            }
            self.loader = false;
        },
    },
};
</script>
