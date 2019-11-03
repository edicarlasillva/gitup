import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

const store = new Vuex.Store({
    plugins:[createPersistedState()],
    state:{
        projectData:''
    },
    mutations:{
        SetProjectData:function(state,payload){
            state.projectData = payload
        }
    },
    getters:{
        ProjectData: state=>{
            return state.projectData
        }
    }
})
export default store;