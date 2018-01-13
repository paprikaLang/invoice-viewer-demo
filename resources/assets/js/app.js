/**
 * Created by paprika on 2018/1/13.
 */
window.Vue = require('vue');
import App from './App.vue';
import router from './router';
const app = new Vue({
    el: '#root',
    render: h => h(App),
    router
})