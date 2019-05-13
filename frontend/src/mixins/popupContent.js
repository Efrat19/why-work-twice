import store from '../store';
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
        }
    },
    data() {
        return {
            store,
            apiService,
            editMode: false,
        }
    },
    mounted() {
        this.editMode = this.payload.editMode;
        if(this.editMode) {
            this.getOld();
        }
    },
    methods: {
        close(){
            this.store.dispatch('close', this.popupName);
        },
        onSuccess(){
            this.success = true;
            window.setTimeout(this.close, 1);
        },
        getOld(){

        }
    }
}