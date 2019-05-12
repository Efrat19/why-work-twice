import store from '../store';
import apiService from '../services/apiService';

export default {
    data() {
        return {
            store,
            apiService,
        }
    },
    methods: {
        close(popup){
            this.store.dispatch('close', popup);
        }
    }
}