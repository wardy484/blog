import './bootstrap'
import 'vendor/highlight.min.js'
import Vue from 'vue'
import httpPlugin from 'plugins/http/index'
import VueRouter from 'vue-router'
import store from './vuex/store.js'
import VueI18n from 'vue-i18n'
import 'vue-multiselect/dist/vue-multiselect.min.css'

import router from './router/index'
import locales from 'lang/index'

import App from './App.vue'
import 'dashboard/runtime/mixins/index'
import marked from 'marked'
import toastr from 'toastr'
import TablePagination from 'dashboard/components/TablePagination.vue'
import Table from 'dashboard/components/Table.vue'
import Form from 'dashboard/components/Form.vue'

window.marked = marked
window.toastr = toastr
window.innerHeight = 800

window.toastr.options = {
    positionClass: "toast-bottom-right",
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut"
}

Vue.use(httpPlugin)
Vue.use(VueI18n)
Vue.use(VueRouter)

Vue.config.lang = window.Language

const i18n = new VueI18n({
    locale: Vue.config.lang,
    messages: locales
})

Vue.component('vue-table-pagination', TablePagination)

Vue.component('vue-table', Table)

Vue.component('vue-form', Form)

new Vue({
    router,
    store,
    i18n,
    render: (h) => h(App)
}).$mount('#app')
