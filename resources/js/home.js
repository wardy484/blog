import './globals'
import 'bootstrap'
import 'vendor/highlight.min.js'
import select2 from 'select2'
import { createApp } from 'vue'
import { createI18n } from 'vue-i18n'
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

const i18n = createI18n({
  legacy: false,
  globalInjection: true,
  locale: window.Language,
  messages: locales
})

createApp({})
  .use(i18n)
  .use(httpPlugin)
  .component('comment', Comment)
  .component('parse', Parse)
  .component('parse-textarea', Textarea)
  .component('avatar', AvatarUpload)
  .mount('#app')
