<template>
    <tr>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">
                <router-link
                    class="hover:text-violet-700"
                    :to="{
                        name: 'ShowCompetitor',
                        params: { id: competitor.id },
                    }"
                >
                    {{ competitor.name }}
                </router-link>
            </p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">
                {{ competitor.points }} Points
            </p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <div class="flex items-center space-x-3">
                <button
                    @click="updatePoints('sub')"
                    class="inline-flex items-center justify-center p-1 text-sm font-medium h-6 w-6 text-orange-500 bg-white border border-orange-500 rounded-full focus:outline-none hover:bg-orange-100 focus:ring-4 focus:ring-orange-200 dark:bg-orange-800 dark:text-orange-400 dark:border-orange-600 dark:hover:bg-orange-700 dark:hover:border-orange-600 dark:focus:ring-orange-700"
                    type="button"
                >
                    <svg
                        class="w-3 h-3"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 18 2"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M1 1h16"
                        />
                    </svg>
                </button>
                <div></div>
                <button
                    @click="updatePoints()"
                    class="inline-flex items-center justify-center h-6 w-6 p-1 text-sm font-medium text-emerald-600 bg-white border border-emerald-600 rounded-full focus:outline-none hover:bg-emerald-100 focus:ring-4 focus:ring-emerald-200 dark:bg-emerald-800 dark:text-emerald-400 dark:border-emerald-600 dark:hover:bg-emerald-700 dark:hover:border-emerald-600 dark:focus:ring-emerald-700"
                    type="button"
                >
                    <span class="sr-only">Quantity button</span>
                    <svg
                        class="w-3 h-3"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 18 18"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 1v16M1 9h16"
                        />
                    </svg>
                </button>
            </div>
            <div class="text-rose-500 text-xs mt-4" v-if="updateError">
                {{ updateError }}
            </div>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <div class="flex items-center">
                <div class="ml-3">
                    <button
                        @click="deleteConfirmation"
                        class="inline-flex items-center justify-center h-6 w-6 p-1 text-sm font-medium text-rose-500 bg-white border border-rose-500 rounded-full focus:outline-none hover:bg-rose-100 focus:ring-4 focus:ring-rose-200 dark:bg-rose-800 dark:text-rose-400 dark:border-rose-600 dark:hover:bg-rose-700 dark:hover:border-rose-600 dark:focus:ring-rose-700"
                        type="button"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                            />
                        </svg>
                    </button>
                </div>
            </div>
            <div v-if="showDeleteConfirmationPopup">
                <DeleteConfirmationModal
                    @cancelDeleteHandler="cancelDelete"
                    @deleteHandler="deleteCompetitor"
                ></DeleteConfirmationModal>
            </div>
        </td>
    </tr>
</template>

<script>
import DeleteConfirmationModal from "../competitors/DeleteConfrmationModal.vue";
export default {
    data() {
        return {
            updateLoader: false,
            updateError: "",
            showDeleteConfirmationPopup: false,
            deleteError: "",
            deleteLoader: false,
        };
    },
    components: {
        DeleteConfirmationModal,
    },
    props: ["competitor"],
    emits: ["refreshLeaderboard"],
    methods: {
        async updatePoints(type = "add") {
            const self = this;
            self.updateError = null;
            if (self.updateLoader) {
                return;
            }
            if (self.competitor.points === 0 && type === "sub") {
                self.updateError = "Points cannot be negative.";
                return;
            }
            self.updateLoader = true;
            let point =
                type === "add"
                    ? self.competitor.points + 1
                    : self.competitor.points - 1;
            const data = {
                points: +point,
                id: self.competitor.id,
            };
            const resp = await self.$store.dispatch("updateCompetitor", data);
            if (resp.status) {
                self.$emit("refreshLeaderboard");
            } else {
                self.updateError =
                    resp.data.response.data.error ||
                    resp.data.response.data.message ||
                    "An error occurred while processing your request. Please try again later";
            }

            self.updateLoader = false;
        },
        deleteConfirmation() {
            this.showDeleteConfirmationPopup = true;
        },
        cancelDelete() {
            this.showDeleteConfirmationPopup = false;
        },
        async deleteCompetitor() {
            this.deleteError = null;
            const self = this;
            self.deleteLoader = true;
            const resp = await self.$store.dispatch("deleteCompetitor", {
                id: self.competitor.id,
            });
            if (!resp.status) {
                self.deleteError =
                    resp.data.response.data.error ||
                    resp.data.response.data.message ||
                    "An error occurred while processing your request. Please try again later";
            } else {
                self.$emit("refreshLeaderboard");
                this.showDeleteConfirmationPopup = false;
            }
            self.deleteLoader = false;
        },
    },
};
</script>
