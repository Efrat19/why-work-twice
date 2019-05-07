import store from "../store";

export default {
    methods: {
        close(popup){
            store.dispatch('close', popup);
        }
    }
}