require('./bootstrap');
window.Vue = require('vue');

Vue.component('qr-scanner', require('./component/QRScanner.vue').default);

const app = new Vue({
    el: '#app',
});
