import './bootstrap'
import 'vendor/highlight.min.js'
import { createApp } from 'vue'
import httpPlugin from 'plugins/http/index'
import store from './vuex/store.js'
import { createI18n } from 'vue-i18n'
import 'vue-multiselect/dist/vue-multiselect.css'

import router from './router/index'
import locales from 'lang/index'

import App from './App.vue'
import permissionMixin from 'dashboard/runtime/mixins/index'
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

const i18n = createI18n({
    legacy: false,
    globalInjection: true,
    locale: window.Language,
    messages: locales
})

createApp(App)
    .use(httpPlugin)
    .use(i18n)
    .use(router)
    .use(store)
    .mixin(permissionMixin)
    .component('vue-table-pagination', TablePagination)
    .component('vue-table', Table)
    .component('vue-form', Form)
    .mount('#app')
