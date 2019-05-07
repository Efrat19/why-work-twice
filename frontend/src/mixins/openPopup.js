import store from '../store';

export default {
    methods: {
        open(popup){
            store.dispatch('open', popup);
        }
    }
}