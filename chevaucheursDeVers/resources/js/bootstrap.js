import axios from 'axios';
import 'bootstrap';
import '@popperjs/core';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


