import store from '../store';
import events from '../events';
import apiService from '../services/apiService';

export default {
  props: {
    payload: {
      type: Object,
      default: () => {},
    },
    popupName: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      store,
      events,
      apiService,
      editMode: false,
      success: false,
      failure: false,
      response: '',
    };
  },
  mounted() {
    this.editMode = this.payload.editMode;
    if (this.editMode) {
      this.getOld();
    }
  },
  methods: {
    close() {
      this.store.dispatch('close', this.popupName);
    },
    onSuccess(msg) {
      this.success = true;
      this.response = msg;
      window.setTimeout(this.close, 3);
    },
    onFailure(error) {
      console.log(error.response);
      let errorsArray = [];
      Object.keys(error.response.data.errors || []).forEach((field) => {
        const fieldError = error.response.data.errors[field];
        errorsArray = [...errorsArray, ...fieldError];
      });
      this.$emit('setErrors', errorsArray.length ? errorsArray : [error.response.data.message]);
      this.faiure = true;
      this.response = error;
    },
    reset() {
      this.$emit('setErrors', []);
      this.success = false;
      this.faiure = false;
      this.response = '';
    },
    getOld() {

    },
  },
};
