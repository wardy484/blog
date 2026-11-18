<template>
  <vue-form :title="$t('form.create_article')">
    <template #buttons>
      <router-link :to="{ name: 'dashboard.article' }" class="btn btn-sm btn-secondary">{{ $t('form.back') }}</router-link>
    </template>
    <template #content>
      <article-form></article-form>
    </template>
  </vue-form>
</template>

<script>
import ArticleForm from './Form'

export default {
  components: { ArticleForm },
}
</script>
