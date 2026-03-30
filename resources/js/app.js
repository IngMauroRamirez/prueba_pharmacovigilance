import './bootstrap';
import { createApp } from 'vue';
import LoginComponent from './components/LoginComponent.vue';
import SearchComponent from './components/SearchComponent.vue';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

const app = createApp({});

app.component('login-component', LoginComponent)
app.component('search-component', SearchComponent)

app.mount('#app');