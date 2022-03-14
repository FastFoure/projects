import Vuex from 'vuex'

export default new Vuex.Store({
    state: {
        forms: JSON.parse(localStorage.getItem('forms') || '[]')
    },
    mutations: {
        getForm(state, forms) {
            state.forms.push(forms)
            localStorage.setItem('forms', JSON.stringify(state.forms))
        }
    },
    actions: {
        getForm({commit}, forms ) {
            commit('getForm', forms)
        }
    },
    getters: {
        forms: s => s.forms
    }
})