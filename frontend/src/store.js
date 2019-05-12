import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    auth: {
      isSigned: false,
      user: {},
    },
    popup: {
      name: false,
      isOpen: false,
    },
  },
  getters:{
    isOpen(state){
      return state.popup.isOpen;
    },
    popupName(state){
      return state.popup.name;
    },
    getUser(state){
      return state.auth.user;
    },
    getIsSigned(state){
      return state.auth.isSigned;
    },
  },
  mutations: {
    setPopupName(state, popup){
      state.popup.name = popup;
    },
    togglePopup(state, isOpen){
      state.popup.isOpen = isOpen;
    },
    setUser(state, user){
      state.auth.user = user;
    },
    setIsSigned(state, isSigned){
      state.auth.isSigned = isSigned;
    },
  },
  actions: {
    open({commit}, popup) {
      commit('setPopupName', popup);
      commit('togglePopup', true);
    },
    close({commit}){
      commit('togglePopup', false);
    },
    setUser({commit}, user){
      commit('setUser', user);
    },
    setIsSigned({commit}, isSigned){
      commit('setIsSigned', isSigned);
    },
  },
});
