import './bootstrap';
import { createApp } from 'vue';
import router from './router/index.js';
import App from './App.vue';
import axios from 'axios';
window.axios = axios;

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
library.add(fas, fab, far)


const app = createApp(App);
app.component('font-awesome-icon', FontAwesomeIcon);
app.use(router);
app.mount("#app");

// require('../css/app.css');