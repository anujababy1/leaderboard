<template>
    <div class="h-400 min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md p-4 bg-white shadow-md rounded-md">
            <h2 class="text-2xl mb-4">Create User</h2>

            <form @submit.prevent="createCompetitor">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 mb-2"
                        >Name</label
                    >
                    <input
                        type="text"
                        id="name"
                        v-model.trim="name"
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-violet-500 focus:outline-none focus:border-violet-500"
                    />
                    <span class="text-rose-500 text-xs" v-if="error.name">
                        {{ error.name }}
                    </span>
                </div>

                <div class="mb-4">
                    <label for="age" class="block text-gray-700 mb-2"
                        >Age</label
                    >
                    <input
                        type="number"
                        id="age"
                        v-model.number="age"
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-violet-500 focus:outline-none focus:border-violet-500"
                    />
                    <span class="text-rose-500 text-xs" v-if="error.age">
                        {{ error.age }}
                    </span>
                </div>

                <div class="mb-4">
                    <label for="address" class="block text-gray-700 mb-2"
                        >Address</label
                    >
                    <textarea
                        id="address"
                        v-model.trim="address"
                        rows="4"
                        class="w-full px-3 py-2 border rounded-md shadow-sm focus:ring-1 focus:ring-violet-500 focus:outline-none focus:border-violet-500"
                    ></textarea>
                    <span class="text-rose-500 text-xs" v-if="error.address">
                        {{ error.address }}
                    </span>
                </div>
                <div class="mb-4">
                    <div class="text-rose-500 text-xs mb-2" v-if="submitError">
                        {{ submitError }}
                    </div>
                </div>
                <div class="mt-6 flex gap-4">
                    <button
                        type="submit"
                        class="bg-violet-800 text-white px-4 py-2 rounded-md hover:bg-violet-900 focus:outline-none focus:ring focus:ring-violet-500"
                    >
                        <spsn v-if="loading">Creating... </spsn>
                        <spsn v-else>Create </spsn>
                    </button>
                    <router-link
                        :to="{ name: 'Leaderboard' }"
                        class="bg-neutral-600 text-white px-4 py-2 rounded-md hover:bg-neutral-700 focus:outline-none focus:ring focus:ring-neutral-500"
                    >
                        Cancel
                    </router-link>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            name: "",
            address: "",
            age: "",
            error: {
                name: null,
                age: null,
                address: null,
            },
            loading: false,
            submitError: "",
        };
    },
    methods: {
        async createCompetitor() {
            const self = this;
            if (this.loading) {
                return;
            }
            if (self.validation()) {
                self.loading = true;
                const resp = await this.$store.dispatch("createCompetitor", {
                    name: self.name,
                    age: self.age,
                    address: self.address,
                    points: 0,
                });
                if (resp.status) {
                    self.$router.push({ name: "Leaderboard" });
                } else {
                    self.submitError =
                        resp.data.response.data.error ||
                        resp.data.response.data.message ||
                        "Failed to create user, please try again later.";
                }
                self.loading = false;
            }
        },
        validation() {
            let valid = true;

            this.error.name = "";
            this.error.age = "";
            this.error.address = "";
            this.submitError = "";

            if (this.name === "") {
                this.error.name = "Name is required";
                valid = false;
            }

            if (this.age === "") {
                this.error.age = "Age is required";
                valid = false;
            } else if (isNaN(this.age) || this.age < 10 || this.age > 120) {
                this.error.age = "Enter a valid age";
                valid = false;
            }

            if (this.address === "") {
                this.error.address = "Address is required";
                valid = false;
            }

            return valid;
        },
    },
};
</script>
