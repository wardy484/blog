---
name: migrate-vue-component
description: Move one Vue 2 single-file component to Vue 3 and delete the Vue 2 code it replaces. Use during the Vue 3 step.
---

# Migrate one Vue component

1. **Read it.** Note props, events, slots, filters, `$listeners`, `$on/$off/$once`, `v-model`,
   `.sync`, `Vue.set`, `this.$children`, and any Vue 2 only plugin it uses.
2. **Change only what Vue 3 needs.** Keep the Options API. Common moves:
   - filters → methods or plain functions
   - `v-model` on a component → `modelValue` and `update:modelValue`
   - `.sync` → `v-model:prop`
   - event bus (`$on`) → a small `mitt` emitter
   - `Vue.set` / `Vue.delete` → plain assignment
   - `beforeDestroy` / `destroyed` → `beforeUnmount` / `unmounted`
3. **Replace Vue 2 only plugins** with a maintained Vue 3 equivalent, or a few lines of local code.
4. **Delete the old code** the component no longer needs.
5. **Check it.** Build the assets and open the page that uses the component.
   Click the thing it does. No console errors.
