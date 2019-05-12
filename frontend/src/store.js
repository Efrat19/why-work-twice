import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    csrf: false,
    auth: {
      isSigned: false,
      userId: false,
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
    getCsrf(state){
      return state.csrf;
    },
    getUserId(state){
      return state.auth.userId;
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
    setCsrf(state, csrf){
      state.csrf = csrf;
    },
    setUserId(state, userId){
      state.auth.userId = userId;
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
    setCsrf({commit}, csrf){
      commit('setCsrf', csrf);
    },
    setUserId({commit}, userId){
      commit('setUserId', userId);
    },
    setIsSigned({commit}, isSigned){
      commit('setIsSigned', isSigned);
    },
  },
});
