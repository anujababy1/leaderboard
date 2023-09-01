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
                        class="appearance-none h-full rounded border block w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    >
                        <option>Sory by name ASC</option>
                        <option>10</option>
                        <option>20</option>
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
                        placeholder="Search"
                        class="appearance-none rounded-r rounded-l sm:rounded-l border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none"
                    />
                </div>

                <div class="block relative">
                    <button
                        class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded"
                    >
                        Add User
                    </button>
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
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                >
                                    User
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                >
                                    Points
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                >
                                    Actions
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                                >
                                    Delete
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                                >
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        Vera Carpenter
                                    </p>
                                </td>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                                >
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        Admin
                                    </p>
                                </td>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                                >
                                    <!-- <p class="text-gray-900 whitespace-no-wrap">
                                        Jan 21, 2020
                                    </p> -->
                                    <div class="flex items-center space-x-3">
                                        <button
                                            class="inline-flex items-center justify-center p-1 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                            type="button"
                                        >
                                            <span class="sr-only"
                                                >Quantity button</span
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
                                        <div>
                                            <!-- <input
                                                type="number"
                                                id="first_product"
                                                class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="1"
                                                required
                                            /> -->
                                        </div>
                                        <button
                                            class="inline-flex items-center justify-center h-6 w-6 p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                            type="button"
                                        >
                                            <span class="sr-only"
                                                >Quantity button</span
                                            >
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
                                </td>
                                <td
                                    class="px-5 py-5 border-b border-gray-200 bg-white text-sm"
                                >
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <button
                                                class="inline-flex items-center justify-center h-6 w-6 p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                                type="button"
                                            >
                                                <span class="sr-only"
                                                    >Quantity button</span
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
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script></script>
