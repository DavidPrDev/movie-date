import './bootstrap';
import { createApp } from 'vue'
// import the root component App from a single-file component.
import Main from './Main.vue'

const app = createApp(Main)

app.mount('#app')