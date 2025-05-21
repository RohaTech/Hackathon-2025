import './assets/main.css'
import "flatpickr/dist/flatpickr.css";
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import ExportExcel from 'vue-3-export-excel'
import App from './App.vue'
import router from './router'

const app = createApp(App)

app.use(createPinia())
app.use(router)
app.use(ExportExcel)

app.mount('#app')
