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
            success: false,
            failure: false,
            response: '',
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
        onSuccess(msg){
            this.success = true;
            this.response = msg;
            window.setTimeout(this.close, 3);
        },
        onFailure(error){
            this.faiure = true;
            this.response = error;
        },
        reset(){
            this.success = false;
            this.faiure = false;
            this.response = '';
        },
        getOld(){

        }
    }
}
