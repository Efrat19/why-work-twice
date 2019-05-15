import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    // auth: {
    //   token: '',
    //   isSigned: false,
    //   user: null,
    // },
    popup: {
      name: false,
      isOpen: false,
      payload: false,
    },
  },
  getters: {
    isOpen(state){
      return state.popup.isOpen;
    },
    popupName(state){
      return state.popup.name;
    },
    getPayload(state){
      return state.popup.payload;
    },
    // getUser(state){
    //   return state.auth.user;
    // },
    // getIsSigned(state){
    //   return state.auth.isSigned;
    // },
    // getToken(state){
    //   return state.auth.token;
    // },
  },
  mutations: {
    setPopupName(state, popup){
      state.popup.name = popup;
    },
    togglePopup(state, isOpen){
      state.popup.isOpen = isOpen;
    },
    // setUser(state, user){
    //   state.auth.user = user;
    // },
    setPayload(state, payload){
      state.popup.payload = payload;
    },
    // setIsSigned(state, isSigned){
    //   state.auth.isSigned = isSigned;
    // },
    // setToken(state, token){
    //   state.auth.token = token;
    // },
  },
  actions: {
    open({commit}, popup) {
      commit('setPopupName', popup);
      commit('togglePopup', true);
    },
    close({commit}){
      commit('togglePopup', false);
    },
    // setUser({commit}, user){
    //   commit('setUser', user);
    // },
    setPayload({commit}, payload){
      commit('setPayload', payload);
    },
    // setIsSigned({commit}, isSigned){
    //   commit('setIsSigned', isSigned);
    // },
    // setToken({commit}, token){
    //   commit('setToken', token);
    // },
  },
});
