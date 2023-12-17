import { createApp } from 'vue'
import App from './App.vue';
import router from './router';
import store from "./store";
import PrimeVue from 'primevue/config';
import '../src/assets/plugins/fontawesome-free/css/all.min.css';
import './assets/dist/css/adminlte.min.css'
import "primevue/resources/themes/saga-blue/theme.css";
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";
import DataTable from 'primevue/datatable';

import './assets/plugins/jquery/jquery.min.js';
import './assets/plugins/bootstrap/js/bootstrap.bundle.min.js';
import './assets/dist/js/adminlte.min.js';
const app = createApp(App);

app.component('DataTable', DataTable)
app.use(router)
app.use(PrimeVue)
app.use(store)
app.mount('#app')
