<template>
  <vue-form :title="$t('form.create_tag')">
    <template #buttons>
      <router-link :to="{ name: 'dashboard.tag' }" class="btn btn-sm btn-secondary">{{ $t('form.back') }}</router-link>
    </template>
    <template #content>
      <tag-form></tag-form>
    </template>
  </vue-form>
</template>

<script>
import TagForm from './Form'

export default {
  components: { TagForm },
}
</script>
