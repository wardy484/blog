<template>
  <vue-form :title="$t('form.create_discussion')">
    <template #buttons>
      <router-link :to="{ name: 'dashboard.discussion' }" class="btn btn-sm btn-secondary">{{ $t('form.back') }}</router-link>
    </template>
    <template #content>
      <discussion-form></discussion-form>
    </template>
  </vue-form>
</template>

<script>
import DiscussionForm from './Form'

export default {
  components: { DiscussionForm }
}
</script>
