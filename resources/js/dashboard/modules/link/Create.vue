<template>
  <vue-form :title="$t('form.create_link')">
    <template #buttons>
      <router-link :to="{ name: 'dashboard.link' }" class="btn btn-sm btn-secondary">{{ $t('form.back') }}</router-link>
    </template>
    <template #content>
      <link-form></link-form>
    </template>
  </vue-form>
</template>

<script>
import LinkForm from './Form'

export default {
  components: { LinkForm },
}
</script>
