import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    popupName: false,
    isOpen: false,
  },
  getters:{
    isOpen(state){
      return state.isOpen;
    },
    popupName(state){
      return state.popupName;
    },
  },
  mutations: {
    setPopupName(state, popup){
      state.popupName = popup;
    },
    togglePopup(state, isOpen){
      state.isOpen = isOpen;
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
  },
});
