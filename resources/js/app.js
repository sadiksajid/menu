require('./bootstrap');
import 'laravel-datatables-vite';

import { createApp, h } from 'vue'

import WallpapperShare from './components/Share/Index'
const app = createApp({})
app.component('Wallpapper', WallpapperShare)
app.mount('#app')


import Home from './components/Home'
const home_app = createApp({})

home_app.component('home_dev', Home)
home_app.mount('#home')