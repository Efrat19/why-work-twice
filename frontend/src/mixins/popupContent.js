import store from '../store';
import apiService from '../services/apiService';

export default {
    data() {
        return {
            store,
            apiService,
            success:false,
        }
    },
    methods: {
        close(popup){
            this.store.dispatch('close', popup);
        },
        onSuccess(){
            this.success = true;
            window.setTimeout(this.close, 1);
        }
    }
}