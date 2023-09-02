<template>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-3xl font-bold leading-tight mb-6">
                    Leaderboard
                </h2>
            </div>
            <div
                class="my-2 flex sm:flex-row flex-col justify-start gap-1 sm:gap-3"
            >
                <div class="relative mb-1 sm:mb-0">
                    <select
                        @change="getCompetitors"
                        v-model="sortBy"
                        class="appearance-none h-full rounded border block w-full bg-white border-gray-300 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-violet-500"
                    >
                        <option
                            v-for="option in sortOptions"
                            :value="option.value"
                            :key="option.value"
                        >
                            {{ option.label }}
                        </option>
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                    >
                        <svg
                            class="fill-current h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                            />
                        </svg>
                    </div>
                </div>

                <div class="block relative mb-1 sm:mb-0">
                    <span
                        class="h-full absolute inset-y-0 left-0 flex items-center pl-2"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            class="h-4 w-4 fill-current text-gray-500"
                        >
                            <path
                                d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"
                            ></path>
                        </svg>
                    </span>
                    <input
                        placeholder="Type a name and press Enter to search..."
                        v-model="searchName"
                        @keyup.enter="getCompetitors"
                        class="w-full sm:w-80 appearance-none rounded-r rounded-l sm:rounded-l border border-gray-300 border-b block pl-8 pr-6 py-2 bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none focus:border-violet-500"
                    />
                </div>

                <div class="relative mb-1 sm:mb-0 self-center">
                    <router-link
                        :to="{ name: 'CreateCompetitor' }"
                        class="text-sm bg-emerald-700 hover:bg-emerald-700 text-white font-semibold py-2 px-4 rounded"
                    >
                        Add User
                    </router-link>
                </div>
            </div>

            <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                <div
                    class="inline-block min-w-full shadow rounded-lg overflow-hidden"
                >
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-violet-700 bg-violet-700 text-left text-xs font-semibold text-white uppercase tracking-wider"
                                >
                                    User
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-violet-700 bg-violet-700 text-left text-xs font-semibold text-white uppercase tracking-wider"
                                >
                                    Points
                                </th>
                                <th
                                    class="sm:w-64 px-5 py-3 border-b-2 border-violet-700 bg-violet-700 text-left text-xs font-semibold text-white uppercase tracking-wider"
                                >
                                    Actions
                                </th>
                                <th
                                    class="sm:w-64 px-5 py-3 border-b-2 border-violet-700 bg-violet-700 text-left text-xs font-semibold text-white uppercase tracking-wider"
                                >
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody v-if="loading">
                            <tr class="h-10 text-center">
                                <td colspan="4" class="h-16">
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
                                    Loading...
                                </td>
                            </tr>
                        </tbody>
                        <tbody
                            v-else-if="
                                Object.keys(competitors).length &&
                                competitors.data.length
                            "
                        >
                            <Competitor
                                v-for="competitor in competitors.data"
                                :key="competitor.id"
                                :competitor="competitor"
                                @refreshLeaderboard="refreshLeaderboardHandler"
                            ></Competitor>
                        </tbody>
                        <tbody v-else>
                            <tr class="h-10 text-center">
                                <td colspan="4">No user found</td>
                            </tr>
                        </tbody>
                    </table>
                    <div
                        v-if="
                            !loading &&
                            Object.keys(competitors).length &&
                            competitors.data.length &&
                            competitors.last_page !== 1
                        "
                        class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between"
                    >
                        <span class="text-xs xs:text-sm text-gray-900">
                            Showing {{ competitors.from }} to
                            {{ competitors.to }} of
                            {{ competitors.total }} Entries
                        </span>
                        <div class="inline-flex mt-2 xs:mt-0">
                            <button
                                @click="prevPage"
                                class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l"
                            >
                                Prev
                            </button>
                            <button
                                @click="nextPage"
                                class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r"
                            >
                                Next
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Competitor from "../components/competitors/Competitor.vue";
export default {
    components: {
        Competitor,
    },
    data() {
        return {
            loading: false,
            searchName: "",
            sortBy: "points-desc",
            sortOptions: [
                {
                    value: "points-desc",
                    label: "Sort by: Points - High to low",
                },
                { value: "points-asc", label: "Sort by: Points - Low to high" },
                { value: "name-asc", label: "Sort by: Name - A-Z" },
                { value: "name-desc", label: "Sort by: Name - Z-A" },
            ],
        };
    },
    created() {
        this.getCompetitors();
    },
    computed: {
        competitors() {
            return this.$store.state.competitors;
        },
    },
    methods: {
        async getCompetitors(page = 1) {
            let self = this;
            self.loading = true;
            let data = {
                search_name: self.searchName,
                order_by: self.sortBy,
                page: page,
                per_page: 5,
            };
            const resp = await this.$store.dispatch("getCompetitors", data);
            if (!resp.status) {
                self.error =
                    resp.data.response.data.error ||
                    resp.data.response.data.message ||
                    "An error occurred while processing your request. Please try again later";
            }
            self.loading = false;
        },
        prevPage() {
            if (this.competitors.current_page <= 1) {
                return false;
            }
            this.getCompetitors(this.competitors.current_page - 1);
        },
        nextPage() {
            if (this.competitors.current_page >= this.competitors.last_page) {
                return false;
            }
            this.getCompetitors(this.competitors.current_page + 1);
        },
        refreshLeaderboardHandler() {
            this.getCompetitors();
        },
    },
};
</script>
