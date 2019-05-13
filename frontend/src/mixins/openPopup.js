import store from '../store';

export default {
    methods: {
        async open(popup, payload = {}){
            await store.dispatch('setPayload', payload);
            store.dispatch('open', popup);
        }
    }
}