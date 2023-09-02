import { createStore } from "vuex";
import axios from "axios";

const store = createStore({
    state() {
        return {
            competitors: [],
            competitor: {},
        };
    },
    getters: {},
    mutations: {
        setCompetitors(state, obj) {
            state.competitors = obj;
        },
        setCompetitor(state, obj) {
            state.competitor = obj;
        },
    },
    actions: {
        async getCompetitors(context, obj) {
            try {
                const response = await axios.get(
                    `${import.meta.env.VITE_API_BASE_URL}/api/competitors`,
                    {
                        params: obj,
                        headers: {
                            Authorization: `Bearer ${
                                import.meta.env.VITE_API_TOKEN
                            }`,
                            Accept: "application/json",
                        },
                    }
                );

                context.commit("setCompetitors", response.data);
                return { status: true, data: response.data };
            } catch (err) {
                return { status: false, data: err };
            }
        },
        async showCompetitors(context, obj) {
            try {
                const response = await axios.get(
                    `${import.meta.env.VITE_API_BASE_URL}/api/competitors/${
                        obj.id
                    }`,
                    {
                        headers: {
                            Authorization: `Bearer ${
                                import.meta.env.VITE_API_TOKEN
                            }`,
                            Accept: "application/json",
                        },
                    }
                );

                console.log(response.data);
                context.commit("setCompetitor", response.data);
                return { status: true, data: response.data };
            } catch (err) {
                return { status: false, data: err };
            }
        },
        async createCompetitor(context, obj) {
            try {
                const response = await axios.post(
                    `${import.meta.env.VITE_API_BASE_URL}/api/competitors`,
                    obj,
                    {
                        headers: {
                            Authorization: `Bearer ${
                                import.meta.env.VITE_API_TOKEN
                            }`,
                            Accept: "application/json",
                        },
                    }
                );
                return { status: true, data: response.data };
            } catch (err) {
                return { status: false, data: err };
            }
        },
        async updateCompetitor(context, obj) {
            try {
                const response = await axios.put(
                    `${import.meta.env.VITE_API_BASE_URL}/api/competitors/${
                        obj.id
                    }`,
                    obj,
                    {
                        headers: {
                            Authorization: `Bearer ${
                                import.meta.env.VITE_API_TOKEN
                            }`,
                            Accept: "application/json",
                        },
                    }
                );
                return { status: true, data: response.data };
            } catch (err) {
                return { status: false, data: err };
            }
        },
        async deleteCompetitor(context, obj) {
            try {
                const response = await axios.delete(
                    `${import.meta.env.VITE_API_BASE_URL}/api/competitors/${
                        obj.id
                    }`,
                    {
                        headers: {
                            Authorization: `Bearer ${
                                import.meta.env.VITE_API_TOKEN
                            }`,
                            Accept: "application/json",
                        },
                    }
                );
                return { status: true };
            } catch (err) {
                return { status: false, data: err };
            }
        },
    },
});

export default store;
