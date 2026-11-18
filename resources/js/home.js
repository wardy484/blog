import './globals'
import 'bootstrap'
import 'vendor/highlight.min.js'
import select2 from 'select2'
import Vue from 'vue'
import VueI18n from 'vue-i18n'
import marked from 'marked'
import toastr from 'toastr'
import locales from 'lang/index'
import httpPlugin from 'plugins/http/index'
import Comment from 'home/components/Comment.vue'
import Parse from 'home/components/Parse.vue'
import Textarea from 'home/components/Textarea.vue'
import AvatarUpload from 'home/components/AvatarUpload.vue'
import socialShareUrl from 'social-share.js/dist/js/social-share.min.js?url'

select2(window, window.jQuery)

window.marked = marked
window.toastr = toastr

// social-share relies on sloppy-mode `this`, so it can't run as a module.
const socialShare = document.createElement('script')
socialShare.src = socialShareUrl
document.head.appendChild(socialShare)

Vue.use(VueI18n);
Vue.use(httpPlugin);

Vue.config.lang = window.Language;

const i18n = new VueI18n({
  locale: Vue.config.lang,
  messages: locales
})

Vue.component('comment', Comment);

Vue.component('parse', Parse);

Vue.component('parse-textarea', Textarea);

Vue.component('avatar', AvatarUpload);

new Vue({
  i18n: i18n,
}).$mount('#app');
