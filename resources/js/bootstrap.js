import axios from 'axios';
window.axios = axios;
import VueBarcodeReader from 'vue-barcode-reader';
Vue.use(VueQrcodeReader);
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';
