import store from '../store';
import apiService from '../services/apiService'

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
          apiService,
            store,
            editMode: false,
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
        onSuccess(data){
            this.response = data;
            window.setTimeout(this.close, 3);
        },
        onFailure(data){
            this.response = data;
            window.setTimeout(() => this.response = '', 3);
        },
        getOld(){

        }
    }
}
